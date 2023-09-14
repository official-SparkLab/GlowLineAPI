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


    public function CustomerLedger($cust_id, $date1, $date2)
    {
        $query = DB::select("
                SELECT date, invoice_no, 'Sales' As cust_name, 0 AS sub_total,total
                FROM tbl_sales_details 
                where cust_id = '".$cust_id."' and date between '" . $date1 . "' and '" . $date2 . "'
        
                UNION ALL
        
                SELECT date, cust_name, 'Receipt', paid_amount, '0' 
                FROM tbl_sale_payable 
                where cust_id = '".$cust_id."' and date between '" . $date1 . "' and '" . $date2 . "'");

        return response()->json([
            "data" => $query
        ]);
    }



    public function supplierLedger($sup_id, $date1, $date2)
    {
        $query = DB::select("SELECT date, invoice_no, 'Purchase' AS sup_name, total, '0' As sub_total
        FROM tbl_raw_purchase
        where sup_id = '".$sup_id."' and date between '" . $date1 . "' and '" . $date2 . "'

        UNION ALL

        SELECT date, sup_name, 'Receipt', '0', paid_amount 
        FROM tbl_purchase_payble
        where sup_id = '".$sup_id."' and date between '" . $date1 . "' and '" . $date2 . "'");

        return response()->json([
            "data" => $query
        ]);
    }


    // Joining Table for product_name

    public function SalesProduct($date, $invoice_no)
    {
        $product = DB::table('tbl_sales_product')
            ->select(
                'tbl_sales_product.hsn',
                'tbl_sales_product.qty',
                'tbl_sales_product.weight',
                'tbl_sales_product.rate',
                'tbl_sales_product.total',
                'tbl_sales_product.p_id',
                'tbl_all_products.prod_name'
            )
            ->leftJoin('tbl_all_products', 'tbl_sales_product.p_id', '=', 'tbl_all_products.p_id')
            ->where('tbl_sales_product.invoice_no', $invoice_no)
            ->where('tbl_sales_product.s_date', $date)
            ->get();

        return response()->json(['data' => $product], 200);
    }


    public function PurchaseProduct($invoice_no)
    {
        $product = DB::table('tbl_raw_purchase_product')
            ->select(
                'tbl_raw_purchase_product.hsn',
                'tbl_raw_purchase_product.qty',
                'tbl_raw_purchase_product.weight',
                'tbl_raw_purchase_product.rate',
                'tbl_raw_purchase_product.total',
                'tbl_raw_purchase_product.p_id',
                'tbl_all_products.prod_name'
            )
            ->leftJoin('tbl_all_products', 'tbl_raw_purchase_product.p_id', '=', 'tbl_all_products.p_id')
            ->where('tbl_raw_purchase_product.invoice_no', $invoice_no)
            ->get();

        return response()->json(['data' => $product], 200);
    }


    // Genereal Ledger APi

    public function GeneralLedger($date1, $date2)
    {
        $post = DB::select("
                SELECT date, invoice_no, 'Sales' As cust_name, 0 AS sub_total,total
                FROM tbl_sales_details 
                where date between '" . $date1 . "' and '" . $date2 . "'
        
                UNION ALL
        
                SELECT date, cust_name, 'Receipt', paid_amount, '0' 
                FROM tbl_sale_payable 
                where date between '" . $date1 . "' and '" . $date2 . "'
        
                UNION ALL
        
                SELECT date, invoice_no, 'Purchase', total, '0' 
                FROM tbl_raw_purchase
                where date between '" . $date1 . "' and '" . $date2 . "'
        
                UNION ALL
        
                SELECT date, sup_name, 'Receipt', '0', paid_amount 
                FROM tbl_purchase_payble
                where date between '" . $date1 . "' and '" . $date2 . "'
        
                UNION ALL
        
                SELECT date, exp_name, 'Expense', '0', exp_amt 
                FROM tbl_expenses
                where date between '" . $date1 . "' and '" . $date2 . "'
        
        
                ORDER BY date; 
                
                ");

        return response()->json([

            "data" => $post

        ]);
    }
}
