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
        $query = DB::table('tbl_sales_details')
            ->select('date', 'invoice_no', DB::raw('0 AS sub_total'), 'total')
            ->where('date', '>=', $date1)
            ->where('date', '<=', $date2)
            ->where('cust_id', $cust_id);

        $query->unionAll(
            DB::table('tbl_sale_payable')
                ->select('date', 'cust_name', 'paid_amount', DB::raw('0 AS total'))
                ->where('date', '>=', $date1)
                ->where('date', '<=', $date2)
                ->where('cust_id', $cust_id)
        );

        $query->orderBy('date');

        $results = $query->get();

        return response()->json([
            "data" => $results
        ]);
    }



    public function supplierLedger($sup_id, $date1, $date2)
    {
        $query = DB::table('tbl_raw_purchase')
            ->select('date', 'invoice_no', 'total', DB::raw('0 AS sub_total'))
            ->whereBetween('date', [$date1, $date2])
            ->where('sup_id', $sup_id);

        $query->unionAll(
            DB::table('tbl_purchase_payble')
                ->select('date', 'sup_name', DB::raw('0 AS total'), 'paid_amount')
                ->whereBetween('date', [$date1, $date2])
                ->where('sup_id', $sup_id)
        );

        $query->orderBy('date');

        $results = $query->get();

        return response()->json([
            "data" => $results
        ]);
    }


    // Joining Table for product_name

    public function SalesProduct($invoice_no)
    {
        $product = DB::select("
    SELECT tbl_sales_product.hsn, tbl_sales_product.qty, tbl_sales_product.weight, tbl_sales_product.rate, tbl_sales_product.total ,tbl_sales_product.gp_id,tbl_all_products.prod_name
FROM tbl_sales_product
LEFT JOIN tbl_all_products
ON tbl_sales_product.gp_id = tbl_all_products.p_id
WHERE tbl_sales_product.invoice_no = $invoice_no;
    ");

    return response()->json(['data'=>$product],200);
    }
}
