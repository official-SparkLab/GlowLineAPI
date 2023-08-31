<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Supplier_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Supplier_Controller extends Controller
{
    // Add Supplier
    public function addSupplier (Request $request)
    {
        $supplier = new Supplier_Model;

        $supplier->sup_name = $request->input("sup_name");
        $supplier->gstin = $request->input("gstin");
        $supplier->address = $request->input("address");
        $supplier->city = $request->input("city");
        $supplier->state = $request->input("state");
        $supplier->office_contact = $request->input("office_contact");
        $supplier->mobile_no = $request->input("mobile_no");
        $supplier->email = $request->input("email");
        $supplier->bank_name = $request->input("bank_name");
        $supplier->ifsc = $request->input("ifsc");
        $supplier->acc_no = $request->input("acc_no");
        $supplier->description = $request->input("description");

        $supplier->save();

        return response()->json(["message" => "Data saved successfully","status" => "success"],201);
    }

       // Fetch All Supplier data
       public function fetchAllSupplier()
       {
           $supplier = DB::select("SELECT * FROM tbl_raw_supplier where status = 1");
       
           if ($supplier) {
               return response()->json(["data" => $supplier], 200);
           } else {
               return response()->json(["message" => "No data found"], 404);
           }
       }

        // Fetch Supplier by Id

    public function fetchById($sup_id)
    {
        $supplier = DB::select("select * from tbl_raw_supplier where sup_id = $sup_id and status = 1");

        if ($supplier) {
            return response()->json(["data" => $supplier], 200);
        } else {
            return response()->json(["message" => "No data found"], 404);
        }
    }

    // Fetch Supplier by name

    public function fetchByName($sup_name)
    {
        $supplier = Supplier_Model::where("sup_name",$sup_name)->where("status","1")->get();

        if ($supplier) {
            return response()->json(["data" => $supplier], 200);
        } else {
            return response()->json(["message" => "No data found"], 404);
        }
    }


     // Delete  Supplier entry

     public function deleteSupplier($sup_id)
     {
         $Supplier = Supplier_Model::find($sup_id);
 
     if ($Supplier) {
         $Supplier->status = 0;
         $Supplier->save();
 
         return response()->json(["message" => "Record deleted successfully"], 200);
     } else {
         return response()->json(["message" => "Record not found"], 404);
     }
     }


      //  Update a Supplier record

    public function updatesupplier(Request $request,$sup_id)
    {
        $supplier = Supplier_Model::find($sup_id);

        if ($supplier) {

            $supplier->sup_name = $request->input("sup_name");
            $supplier->gstin = $request->input("gstin");
            $supplier->address = $request->input("address");
            $supplier->city = $request->input("city");
            $supplier->state = $request->input("state");
            $supplier->office_contact = $request->input("office_contact");
            $supplier->mobile_no = $request->input("mobile_no");
            $supplier->email = $request->input("email");
            $supplier->bank_name = $request->input("bank_name");
            $supplier->ifsc = $request->input("ifsc");
            $supplier->acc_no = $request->input("acc_no");
            $supplier->description = $request->input("description");
    
            $supplier->save();

    
            return response()->json(["message" => "Record updated successfully"], 200);
        } else {
            return response()->json(["message" => "Record not found"], 404);
        }
    }

}
