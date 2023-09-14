<?php

namespace App\Http\Controllers;

use App\Models\Goods_Usage_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Goods_Usage_Controller extends Controller
{
    //

    public function addProduct (Request $request)
    {
        $product = new Goods_Usage_Model();
        $product->prod_id = $request->input("prod_id");
        $product->prod_name = $request->input("prod_name");
        $product->date = $request->input("date");
        $product->hsn = $request->input("hsn");
        $product->qty = $request->input("qty");
        $product->weight = $request->input("weight");
        $product->total_weight = $request->input("total_weight");
        $product->type = $request->input("type");

       
        $product->save();

        return response()->json(["message" => "Data saved successfully","status" => "success"],201);
    }


    // Fetch All Product data
    public function fetchAllProducts()
    {
        $product = DB::select("SELECT * FROM tbl_goods_usage");
    
        if ($product) {
            return response()->json(["data" => $product], 200);
        } else {
            return response()->json(["message" => "No data found"], 404);
        }
    }

    public function deleteGoodsUsage($g_id)
    {
        try {
            $product = Goods_Usage_Model::where('g_id', $g_id)
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
