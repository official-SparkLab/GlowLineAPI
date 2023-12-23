<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Jointable_Controller extends Controller
{
    //

    public function fetchAmountForPurchasePayable($sup_id)
    {
        $totalAmt = DB::select("SELECT SUM(total) as totalSum from tbl_raw_purchase where sup_id = $sup_id")[0]->totalSum;

        $totalPaidamt = DB::select("SELECT SUM(paid_amount) as totalSum from tbl_purchase_payble where sup_id = $sup_id")[0]->totalSum;
        return response()->json(["totalAmt" => $totalAmt - $totalPaidamt]);
    }

    public function fetchAmountForSalePayable($cust_id)
    {
        $totalAmt = DB::select("SELECT SUM(total) as totalSum from tbl_sales_details where cust_id = $cust_id")[0]->totalSum;

        $totalPaidamt = DB::select("SELECT SUM(paid_amount) as totalSum from tbl_sale_payable where cust_id = $cust_id")[0]->totalSum;
        return response()->json(["totalAmt" => $totalAmt - $totalPaidamt]);
    }

    public function allCustomerPendingAmount()
    {
        $pendingAmounts = DB::select("
            SELECT 
                c.cust_id,
                c.cust_name,
                c.mobile,
                c.gstin,
                COALESCE(sd.total, 0) - COALESCE(sp.paid_amount, 0) as pendingAmount
            FROM 
                tbl_customer_details c
            LEFT JOIN (
                SELECT cust_id, COALESCE(SUM(total), 0) as total
                FROM tbl_sales_details
                GROUP BY cust_id
            ) sd ON c.cust_id = sd.cust_id
            LEFT JOIN (
                SELECT cust_id, COALESCE(SUM(paid_amount), 0) as paid_amount
                FROM tbl_sale_payable
                GROUP BY cust_id
            ) sp ON c.cust_id = sp.cust_id
        ");
    
        return response()->json([
            "data" => $pendingAmounts
        ]);
    }
    
    

    public function CustomerLedger($cust_id, $date1, $date2)
    {
        $query = DB::select("
                SELECT date, 'Sales Outside' As sales_id, invoice_no, 'Sales' As cust_name, 0 AS sub_total,total
                FROM tbl_sales_details 
                where cust_id = '" . $cust_id . "' and date between '" . $date1 . "' and '" . $date2 . "'
        
                UNION ALL
        
                SELECT date,cust_name, sale_pay_id, 'Receipt', paid_amount, '0' 
                FROM tbl_sale_payable 
                where cust_id = '" . $cust_id . "' and date between '" . $date1 . "' and '" . $date2 . "'");

        return response()->json([
            "data" => $query
        ]);
    }



    public function supplierLedger($sup_id, $date1, $date2)
    {
        $query = DB::select("SELECT date,'Purchase Inside' As rawp_id, invoice_no, 'Purchase' AS sup_name, total, '0' As sub_total
        FROM tbl_raw_purchase
        where sup_id = '" . $sup_id . "' and date between '" . $date1 . "' and '" . $date2 . "'

        UNION ALL

        SELECT date, sup_name,pur_pay_id, 'Receipt', '0', paid_amount 
        FROM tbl_purchase_payble
        where sup_id = '" . $sup_id . "' and date between '" . $date1 . "' and '" . $date2 . "'");

        return response()->json([
            "data" => $query
        ]);
    }


    // Joining Table for product_name

    public function SalesProduct($date, $invoice_no)
    {
        $product = DB::table('tbl_sales_product')
            ->select(
                'tbl_sales_product.sp_id',
                'tbl_sales_product.hsn',
                'tbl_sales_product.qty',
                'tbl_sales_product.total_weight',
                'tbl_sales_product.rate',
                'tbl_sales_product.total',
                'tbl_sales_product.p_id',
                'tbl_all_products.prod_name',
                'tbl_sales_product.sales_prod_id',
                'tbl_sales_product.type'


            )
            ->leftJoin('tbl_all_products', 'tbl_sales_product.p_id', '=', 'tbl_all_products.p_id')
            ->where('tbl_sales_product.invoice_no', $invoice_no)
            ->where('tbl_sales_product.s_date', $date)
            ->get();

        return response()->json(['data' => $product], 200);
    }


    public function PurchaseProduct($date,$invoice_no)
    {
        $product = DB::table('tbl_raw_purchase_product')
            ->select(
                'tbl_raw_purchase_product.hsn',
                'tbl_raw_purchase_product.row_p_id',
                'tbl_raw_purchase_product.pur_prod_id',
                'tbl_raw_purchase_product.qty',
                'tbl_raw_purchase_product.total_weight',
                'tbl_raw_purchase_product.rate',
                'tbl_raw_purchase_product.total',
                'tbl_raw_purchase_product.p_id',
                'tbl_raw_purchase_product.type',
                'tbl_all_products.prod_name'
            )
            ->leftJoin('tbl_all_products', 'tbl_raw_purchase_product.p_id', '=', 'tbl_all_products.p_id')
            ->where('tbl_raw_purchase_product.invoice_no', $invoice_no)
            ->where('tbl_raw_purchase_product.p_date', $date)
            ->get();

        return response()->json(['data' => $product], 200);
    }


    // Genereal Ledger APi

    public function GeneralLedger($date1, $date2)
    {
        $post = DB::select("
                SELECT date,'Sales Outside' As sales_id, invoice_no, 'Sales' As cust_name, 0 AS sub_total,total
                FROM tbl_sales_details 
                where date between '" . $date1 . "' and '" . $date2 . "'
        
                UNION ALL
        
                SELECT date, cust_name, sale_pay_id, 'Receipt', paid_amount, '0' 
                FROM tbl_sale_payable 
                where date between '" . $date1 . "' and '" . $date2 . "'
        
                UNION ALL
        
                SELECT date,'Purchase Inside' As rawp_id, invoice_no, 'Purchase', total, '0' 
                FROM tbl_raw_purchase
                where date between '" . $date1 . "' and '" . $date2 . "'
        
                UNION ALL
        
                SELECT date, sup_name,pur_pay_id, 'Receipt', '0', paid_amount 
                FROM tbl_purchase_payble
                where date between '" . $date1 . "' and '" . $date2 . "'
        
                UNION ALL
        
                SELECT date, exp_name,exp_id, 'Expense', '0', exp_amt 
                FROM tbl_expenses
                where date between '" . $date1 . "' and '" . $date2 . "'
        
        
                ORDER BY date; 
                
                ");

        return response()->json([

            "data" => $post

        ]);
    }

    public function TotalWeightOfOrdersByCustomer($cust_id, $date1, $date2)
    {
        $total = DB::select("
        SELECT SUM(tbl_sales_product.total_weight) AS total
        FROM tbl_sales_product
        LEFT JOIN tbl_customer_details ON tbl_sales_product.cust_id = tbl_customer_details.cust_id
        WHERE tbl_customer_details.cust_id = '" . $cust_id . "' AND tbl_sales_product.hsn = '39111010'
        AND tbl_sales_product.s_date BETWEEN '" . $date1 . "' and '" . $date2 . "';
        ");

        return response()->json(["data" => $total]);
    }


    public function goodsStock()
    {
        $combinedData = DB::select("
        SELECT 
            prod_name,
            SUM(SalesWeight) AS TotalSalesWeight,
            SUM(DamageWeight) AS TotalDamageWeight,
            SUM(ProductionWeight) AS TotalProductionWeight
        FROM (
            SELECT 
                tbl_all_products.prod_name AS prod_name,
                SUM(tbl_sales_product.total_weight) AS SalesWeight,
                0 AS DamageWeight,
                0 AS ProductionWeight
            FROM 
                tbl_sales_product
            LEFT JOIN
                tbl_all_products ON tbl_sales_product.p_id = tbl_all_products.p_id
            WHERE 
                tbl_sales_product.type = 'Goods'
            GROUP BY tbl_all_products.prod_name
    
            UNION ALL
    
            SELECT 
                tbl_all_products.prod_name AS prod_name,
                0 AS SalesWeight,
                SUM(tbl_damage_material.total_weight) AS DamageWeight,
                0 AS ProductionWeight
            FROM 
                tbl_damage_material
            LEFT JOIN
                tbl_all_products ON tbl_damage_material.p_id = tbl_all_products.p_id
            WHERE 
                tbl_damage_material.type = 'Goods'
            GROUP BY tbl_all_products.prod_name
    
            UNION ALL
    
            SELECT 
                tbl_all_products.prod_name AS prod_name,
                0 AS SalesWeight,
                0 AS DamageWeight,
                SUM(tbl_goods_usage.total_weight) AS ProductionWeight
            FROM 
                tbl_goods_usage
            LEFT JOIN
                tbl_all_products ON tbl_goods_usage.p_id = tbl_all_products.p_id
            WHERE 
                tbl_goods_usage.type = 'Goods'
            GROUP BY tbl_all_products.prod_name
        ) AS CombinedData
        GROUP BY prod_name;
    ");

    return response()->json(["data"=>$combinedData]);
    
    
    }
    


    public function retailStock()
    {
        $combinedData = DB::select(
            "
            SELECT 
            prod_name,
            SUM(SalesWeight) AS TotalSalesWeight,
            SUM(DamageWeight) AS TotalDamageWeight,
            SUM(PurchaseWeight) AS TotalPurchaseWeight
        FROM (
            SELECT 
                tbl_all_products.prod_name AS prod_name,
                SUM(tbl_sales_product.total_weight) AS SalesWeight,
                0 AS DamageWeight,
                0 AS PurchaseWeight
            FROM 
                tbl_sales_product
            LEFT JOIN
                tbl_all_products ON tbl_sales_product.p_id = tbl_all_products.p_id
            WHERE 
                tbl_sales_product.type = 'Retail'
            GROUP BY tbl_all_products.prod_name
    
            UNION ALL
    
            SELECT 
                tbl_all_products.prod_name AS prod_name,
                0 AS SalesWeight,
                SUM(tbl_damage_material.total_weight) AS DamageWeight,
                0 AS PurchaseWeight
            FROM 
                tbl_damage_material
            LEFT JOIN
                tbl_all_products ON tbl_damage_material.p_id = tbl_all_products.p_id
            WHERE 
                tbl_damage_material.type = 'Retail'
            GROUP BY tbl_all_products.prod_name
    
            UNION ALL
    
            SELECT 
                tbl_all_products.prod_name AS prod_name,
                0 AS SalesWeight,
                0 AS DamageWeight,
                SUM(tbl_raw_purchase_product.total_weight) AS PurchaseWeight
            FROM 
                tbl_raw_purchase_product
            LEFT JOIN
                tbl_all_products ON tbl_raw_purchase_product.p_id = tbl_all_products.p_id
            WHERE 
                tbl_raw_purchase_product.type = 'Retail'
            GROUP BY tbl_all_products.prod_name
        ) AS CombinedData
        GROUP BY prod_name;
            "
        );

    return response()->json(["data"=>$combinedData]);

    }


    public function rawStock()
    {
       $combineData = DB::select(
       "
       SELECT 
            prod_name,
            SUM(PurchaseWeight) AS TotalPurchaseWeight,
            SUM(DamageWeight) AS TotalDamageWeight,
            SUM(UsageWeight) AS TotalUsageWeight
        FROM (
            SELECT 
                tbl_all_products.prod_name AS prod_name,
                SUM(tbl_raw_purchase_product.total_weight) AS PurchaseWeight,
                0 AS DamageWeight,
                0 AS UsageWeight
            FROM 
            tbl_raw_purchase_product
            LEFT JOIN
                tbl_all_products ON tbl_raw_purchase_product.p_id = tbl_all_products.p_id
            WHERE 
            tbl_raw_purchase_product.type = 'Raw'
            GROUP BY tbl_all_products.prod_name
    

            UNION ALL
    

            SELECT 
                tbl_all_products.prod_name AS prod_name,
                0 AS PurchaseWeight,
                SUM(tbl_damage_material.total_weight) AS DamageWeight,
                0 AS UsageWeight
            FROM 
                tbl_damage_material
            LEFT JOIN
                tbl_all_products ON tbl_damage_material.p_id = tbl_all_products.p_id
            WHERE 
                tbl_damage_material.type = 'Raw'
            GROUP BY tbl_all_products.prod_name
    

            UNION ALL

    
            SELECT 
                tbl_all_products.prod_name AS prod_name,
                0 AS PurchaseWeight,
                0 AS DamageWeight,
                SUM(tbl_raw_usage.total_weight) AS UsageWeight
            FROM 
            tbl_raw_usage
            LEFT JOIN
                tbl_all_products ON tbl_raw_usage.p_id = tbl_all_products.p_id
            WHERE 
        tbl_raw_usage.type = 'Raw'
            GROUP BY tbl_all_products.prod_name
        ) AS CombinedData
        GROUP BY prod_name;
       "
       );

    return response()->json(["data"=>$combineData]);

    }
}
