<?php

namespace App\Http\Controllers;

use App\Models\Damage_Material_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Damage_Material_Controller extends Controller
{
    //

    
    public function addProduct (Request $request)
    {
        $product = new Damage_Material_Model();
        $product->prod_id = $request->input("prod_id");
        $product->prod_name = $request->input("prod_name");
        $product->date = $request->input("date");
        $product->hsn = $request->input("hsn");
        $product->qty = $request->input("qty");
        $product->type = $request->input("type");

       
        $product->save();

        return response()->json(["message" => "Data saved successfully","status" => "success"],201);
    }


    // Fetch All Product data
    public function fetchAllProducts()
    {
        $product = DB::select("SELECT * FROM tbl_damage_material");
    
        if ($product) {
            return response()->json(["data" => $product], 200);
        } else {
            return response()->json(["message" => "No data found"], 404);
        }
    }

    public function deleteMaterialDamage($dam_id)
    {
        try {
            $product = Damage_Material_Model::where('dam_id', $dam_id)
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
