<?php

namespace App\Http\Controllers;

use App\Models\Purchase_Product_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Purchase_Product_Controller extends Controller
{
    //

    // Add Products Method

    public function addProduct(Request $request)
    {
        $product = new Purchase_Product_Model();
        $product->pur_prod_id = $request->input("pur_prod_id");
        $product->invoice_no = $request->input("invoice_no");
        $product->p_date = $request->input("p_date");
        $product->p_id = $request->input("p_id");
        $product->prod_name = $request->input("prod_name");
        $product->total_weight = $request->input("total_weight");
        $product->qty = $request->input("qty");
        $product->rate = $request->input("rate");
        $product->total = $request->input("total");
        $product->hsn = $request->input("hsn");
        $product->type = $request->input("type");
        $product->save();

        return response()->json(["message" => "Data saved successfully", "status" => "success"], 201);
    }


    // Fetch All Product data
    public function fetchAllProducts()
    {
        $product = DB::select("SELECT * FROM tbl_raw_purchase_product");

        if ($product) {
            return response()->json(["data" => $product], 200);
        } else {
            return response()->json(["message" => "No data found"], 404);
        }
    }


    // Fetch product by Id

    public function fetchById($date, $invoice_no)
    {

        try {
            $product = DB::table('tbl_raw_purchase_product')
                ->where('p_date', '=', $date)
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

    public function deleteSaleProduct($row_p_id)
    {
        try {
            $product = Purchase_Product_Model::where('row_p_id', $row_p_id)
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


    public function updatePurchaseProduct(Request $request, $pur_prod_id, $invoice_no)
    {
        $product = Purchase_Product_Model::where('pur_prod_id', $pur_prod_id)
            ->where('invoice_no', $invoice_no)
            ->first();
    
        if (!$product) {
            return response()->json(["message" => "Product not found"], 404);
        } else {
            $product->p_date = $request->input("p_date");
            $product->p_id = $request->input("p_id");
            $product->prod_name = $request->input("prod_name");
            $product->total_weight = $request->input("total_weight");
            $product->qty = $request->input("qty");
            $product->rate = $request->input("rate");
            $product->total = $request->input("total");
            $product->hsn = $request->input("hsn");
            $product->type = $request->input("type");
            $product->save();
    
            return response()->json(["message" => "Data updated successfully", "status" => "success"], 201);
        }
    }
}
