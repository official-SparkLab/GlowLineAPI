<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\All_Products_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class All_Products_Controller extends Controller
{
    // 
     // Add Products Method

     public function addProduct (Request $request)
     {
         $product = new All_Products_Model;
 
         $product->prod_name = $request->input("prod_name");
         $product->rate = $request->input("rate");
         $product->gst = $request->input("gst");
         $product->hsn = $request->input("hsn");
         $product->description = $request->input("description");
         $product->type = $request->input("type");


         $product->save();
 
         return response()->json(["message" => "Data saved successfully","status" => "success"],201);
     }
 

     // Fetch All Product data
     public function fetchAllProducts()
     {
         $product = DB::select("SELECT * FROM tbl_all_products where status = 1");
     
         if ($product) {
             return response()->json(["data" => $product], 200);
         } else {
             return response()->json(["message" => "No data found"], 404);
         }
     }
 
 
     // Fetch product by Id
 
     public function fetchById($p_id)
     {
         $product = DB::select("select * from tbl_all_products where p_id = $p_id and status = 1");
 
         if ($product) {
             return response()->json(["data" => $product], 200);
         } else {
             return response()->json(["message" => "No data found"], 404);
         }
     }
 
     // Delete  product entry
 
     public function deleteProduct($p_id)
     {
         $product = All_Products_Model::find($p_id);
 
     if ($product) {
         $product->status = 0;
         $product->save();
 
         return response()->json(["message" => "Record deleted successfully"], 200);
     } else {
         return response()->json(["message" => "Record not found"], 404);
     }
     }
 
 
     //  Update a products record
 
     public function updateProduct(Request $request,$p_id)
     {
         $product = All_Products_Model::find($p_id);
 
         if ($product) {
 
        
            $product->prod_name = $request->input("prod_name");
         $product->rate = $request->input("rate");
         $product->gst = $request->input("gst");
         $product->hsn = $request->input("hsn");
         $product->description = $request->input("description");
         $product->type = $request->input("type");


         $product->save();
          
     
             return response()->json(["message" => "Record updated successfully"], 200);
         } else {
             return response()->json(["message" => "Record not found"], 404);
         }
     }


     public function fetchProductForSale()
     {
         $products = DB::table('tbl_all_products')
             ->where('type', 'Goods') // Corrected the SQL condition
             ->orWhere('type', 'Retail') // Added an OR condition
             ->get();
     
         if ($products->count() > 0) {
             return response()->json(["data" => $products], 200);
         } else {
             return response()->json(["message" => "No data found"], 404);
         }
     }


     public function fetchProductForPurchase()
     {
         $products = DB::table('tbl_all_products')
             ->where('type', 'Raw') // Corrected the SQL condition
             ->orWhere('type', 'Retail') // Added an OR condition
             ->get();
     
         if ($products->count() > 0) {
             return response()->json(["data" => $products], 200);
         } else {
             return response()->json(["message" => "No data found"], 404);
         }
     }


     public function fetchProductForUsage()
     {
         $products = DB::table('tbl_all_products')
             ->where('type', 'Raw') // Corrected the SQL condition
             ->get();
     
         if ($products->count() > 0) {
             return response()->json(["data" => $products], 200);
         } else {
             return response()->json(["message" => "No data found"], 404);
         }
     }


     public function fetchProductForGoodsUsage()
     {
         $products = DB::table('tbl_all_products')
             ->where('type', 'Goods') // Corrected the SQL condition
             ->get();
     
         if ($products->count() > 0) {
             return response()->json(["data" => $products], 200);
         } else {
             return response()->json(["message" => "No data found"], 404);
         }
     }
     
}
