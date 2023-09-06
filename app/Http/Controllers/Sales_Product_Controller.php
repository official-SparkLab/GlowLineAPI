<?php

namespace App\Http\Controllers;

use App\Models\Sales_Product_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Sales_Product_Controller extends Controller
{
    //
     // Add Products Method

     public function addProduct (Request $request)
     {
         $product = new Sales_Product_Model;
         $product->sales_prod_id = $request->input("sales_prod_id");
         $product->invoice_no = $request->input("invoice_no");
         $product->s_date = $request->input("s_date");
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
         $product = DB::select("SELECT * FROM tbl_sales_product");
     
         if ($product) {
             return response()->json(["data" => $product], 200);
         } else {
             return response()->json(["message" => "No data found"], 404);
         }
     }
 
 
     // Fetch product by Id
 
     public function fetchById($invoice_no)
     {
    
         try {
            $product = DB::table('tbl_sales_product')
                ->where('invoice_no', '=', $invoice_no)
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

      public function deleteSaleProduct($sp_id)
    {
        try {
            $product = Sales_Product_Model::where('sp_id', $sp_id)
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
