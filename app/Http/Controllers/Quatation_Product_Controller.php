<?php

namespace App\Http\Controllers;

use App\Models\Quatation_Product_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Quatation_Product_Controller extends Controller
{
    //

     // Add Products Method

     public function addProduct (Request $request)
     {
         $product = new Quatation_Product_Model();
         $product->q_prod_id = $request->input("q_prod_id");
         $product->voucher_no = $request->input("voucher_no");
         $product->q_date = $request->input("q_date");
         $product->gp_id = $request->input("gp_id");
         $product->prod_name = $request->input("prod_name");
         $product->hsn = $request->input("hsn");
         $product->weight = $request->input("weight");
         $product->qty = $request->input("qty");
         $product->rate = $request->input("rate");
         $product->total = $request->input("total");
         $product->type = $request->input("type");
         $product->save();
 
         return response()->json(["message" => "Data saved successfully","status" => "success"],201);
     }
 

     // Fetch All Product data
     public function fetchAllProducts()
     {
         $product = DB::select("SELECT * FROM tbl_quatation_product");
     
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
            $product = DB::table('tbl_quatation_product')
                ->where('voucher_no', '=', $voucher_no)
                ->get();
        
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

      public function deleteSaleProduct($qp_id)
    {
        try {
            $product = Quatation_Product_Model::where('qp_id', $qp_id)
                ->first();

            if ($product) {
                $product->delete();
                return response()->json(['Message' => 'Product deleted successfully']);
            } else {
                return response()->json(['Message' => 'Product not found']);
            }
        } catch (\Exception $e) {
            return response()->json(['Message' => 'Error: ' . $e->getMessage()]);
        }
    }
 
}
