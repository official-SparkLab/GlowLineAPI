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
         $product->cust_id = $request->input("cust_id");
         $product->s_date = $request->input("s_date");
         $product->p_id = $request->input("p_id");
         $product->prod_name = $request->input("prod_name");
         $product->hsn = $request->input("hsn");
         $product->total_weight = $request->input("total_weight");
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
 
     public function fetchById($date,$invoice_no)
     {
    
         try {
            $product = DB::table('tbl_sales_product')
                ->where('s_date', '=', $date)
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
 
    public function updateSaleProduct(Request $request, $sales_prod_id, $invoice_no)
{
    $product = Sales_Product_Model::where('sales_prod_id', $sales_prod_id)
        ->where('invoice_no', $invoice_no)
        ->first();

    if (!$product) {
        return response()->json(["message" => "Product not found"], 404);
    } else {
        $product->s_date = $request->input("s_date");
        $product->p_id = $request->input("p_id");
        $product->prod_name = $request->input("prod_name");
        $product->hsn = $request->input("hsn");
        $product->total_weight = $request->input("total_weight");
        $product->qty = $request->input("qty");
        $product->rate = $request->input("rate");
        $product->total = $request->input("total");
        $product->type = $request->input("type");
        $product->save();

        return response()->json(["message" => "Data updated successfully", "status" => "success"], 201);
    }
}

    
}
