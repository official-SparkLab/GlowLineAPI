<?php

namespace App\Http\Controllers;

use App\Models\Purchase_Payable_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Purchase_Payable_Controller extends Controller
{
    //

     // Add Products Method

     public function addPayable (Request $request)
     {
         $product = new Purchase_Payable_Model();
         $product->sup_id = $request->input("sup_id");
         $product->sup_name = $request->input("sup_name");
         $product->date = $request->input("date");
         $product->mobile_no = $request->input("mobile_no");
         $product->gstin = $request->input("gstin");
         $product->pending_amt = $request->input("pending_amt");
         $product->paid_amount = $request->input("paid_amount");
         $product->available_bal = $request->input("available_bal");
         $product->payment_mode = $request->input("payment_mode");
         $product->trx_no = $request->input("trx_no");
         $product->save();
 
         return response()->json(["message" => "Data saved successfully","status" => "success"],201);
     }
 

     // Fetch All Product data
     public function fetchAllPayable()
     {
         $product = DB::select("SELECT * FROM tbl_purchase_payble");
     
         if ($product) {
             return response()->json(["data" => $product], 200);
         } else {
             return response()->json(["message" => "No data found"], 404);
         }
     }


     public function deletePurchasePayable($pur_pay_id)
     {
         try {
             $product = Purchase_Payable_Model::where('pur_pay_id', $pur_pay_id)
                 ->first();
 
             if ($product) {
                 $product->delete();
                 return response()->json(['Message' => 'Record deleted successfully']);
             } else {
                 return response()->json(['Message' => 'Product not found']);
             }
         } catch (\Exception $e) {
             return response()->json(['Message' => 'Error: ' . $e->getMessage()]);
         }
     }
}
