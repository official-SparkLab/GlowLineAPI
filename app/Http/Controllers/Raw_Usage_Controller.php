<?php

namespace App\Http\Controllers;

use App\Models\Raw_Usage_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Raw_Usage_Controller extends Controller
{
    //

    public function addProduct (Request $request)
    {
        $product = new Raw_Usage_Model();
        $product->p_id = $request->input("p_id");
        $product->prod_name = $request->input("prod_name");
        $product->date = $request->input("date");
        $product->hsn = $request->input("hsn");
        $product->qty = $request->input("qty");
        $product->total_weight = $request->input("total_weight");
        $product->type = $request->input("type");

       
        $product->save();

        return response()->json(["message" => "Data saved successfully","status" => "success"],201);
    }


    // Fetch All Product data
    public function fetchAllProducts()
    {
        $product = DB::select("SELECT * FROM tbl_raw_usage");
    
        if ($product) {
            return response()->json(["data" => $product], 200);
        } else {
            return response()->json(["message" => "No data found"], 404);
        }
    }


    public function deleteRawUsage($raw_id)
    {
        try {
            $product = Raw_Usage_Model::where('raw_id', $raw_id)
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
