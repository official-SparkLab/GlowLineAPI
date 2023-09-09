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
        $post = DB::select("
            SELECT date, invoice_no, sub_total as 0, total
            FROM tbl_sales_details 
            WHERE date BETWEEN '" . $date1 . "' AND '" . $date2 . "'

            AND cust_id = '" . $cust_id . "'
    
            UNION ALL
    
            SELECT date, cust_name, paid_amount, '0'
            FROM tbl_sale_payable 
            WHERE date BETWEEN '" . $date1 . "' AND '" . $date2 . "'
            AND cust_id = '" . $cust_id . "'
    
            ORDER BY date;
        ");

        return response()->json([
            "data" => $post
        ]);
    }


      public function supplierLedger($sup_id, $date1, $date2)
    {
        $post = DB::select("
            SELECT date, invoice_no, sub_total as 0, total
            FROM tbl_raw_purchase 
            WHERE date BETWEEN '" . $date1 . "' AND '" . $date2 . "'

            AND sup_id = '" . $sup_id . "'
    
            UNION ALL
    
            SELECT date, sup_name, paid_amount, '0'
            FROM tbl_purchase_payble 
            WHERE date BETWEEN '" . $date1 . "' AND '" . $date2 . "'
            AND sup_id = '" . $sup_id . "'
    
            ORDER BY date;
        ");

        return response()->json([
            "data" => $post
        ]);
    }
    
}
