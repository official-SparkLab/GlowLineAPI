<?php

namespace App\Http\Controllers;

use App\Models\Quatation_Details_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Quatation_Details_Controller extends Controller
{
    //

     // Add Products Method

     public function addSaleEntry (Request $request)
     {
         $product = new Quatation_Details_Model();
 
         $product->voucher_no = $request->input("voucher_no");
         $product->date = $request->input("date");
         $product->order_no = $request->input("order_no");
         $product->destination = $request->input("destination");
         $product->trans_amt = $request->input("trans_amt");
         $product->hamali = $request->input("hamali");
         $product->cgst = $request->input("cgst");
         $product->cgst_amt = $request->input("cgst_amt");
         $product->sgat = $request->input("sgat");
         $product->sgat_amt = $request->input("sgat_amt");
         $product->igst = $request->input("igst");
         $product->igst_amt = $request->input("igst_amt");
         $product->sub_total = $request->input("sub_total");
         $product->total = $request->input("total");

         $product->save();
 
         return response()->json(["message" => "Data saved successfully","status" => "success"],201);
     }
 

     // Fetch All Product data
     public function fetchAllProducts()
     {
         $product = DB::select("SELECT * FROM tbl_quatation_details where status = 1");
     
         if ($product) {
             return response()->json(["data" => $product], 200);
         } else {
             return response()->json(["message" => "No data found"], 404);
         }
     }
 
 
     // Fetch product by Id
 
     public function fetchById($voucher_no)
     {
        try {
            $product = DB::table('tbl_quatation_details')
                ->where('voucher_no', '=', $voucher_no)
                ->first();
        
            if ($product) {
                return response()->json(["data" => $product], 200);
            } else {
                return response()->json(["message" => "No data found"], 404);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(["error" => "An error occurred"], 500);
        }
     }
}
