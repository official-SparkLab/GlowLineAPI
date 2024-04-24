<?php

namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Models\Customer_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Customer_Controller extends Controller
{
    //Add Customer
    public function addCustomer (Request $request)
    {
        $customer = new Customer_Model;

        $customer->cust_name = $request->input("cust_name");
        $customer->mobile = $request->input("mobile");
        $customer->email = $request->input("email");
        $customer->country = $request->input("country");
        $customer->state = $request->input("state");
        $customer->address = $request->input("address");
        $customer->bank_name = $request->input("bank_name");
        $customer->ifsc = $request->input("ifsc");
        $customer->acc_no = $request->input("acc_no");
        $customer->gstin = $request->input("gstin");

        $customer->save();

        return response()->json(["message" => "Data saved successfully","status" => "success"],201);
    }

       // Fetch All Customer data
       public function fetchAllCustomer()
       {
           $customer = DB::select("SELECT * FROM tbl_customer_details where status = 1");
       
           if ($customer) {
               return response()->json(["data" => $customer], 200);
           } else {
               return response()->json(["message" => "No data found"], 404);
           }
       }

        // Fetch Customer by Id

    public function fetchById($cust_id)
    {
        $customer = DB::select("select * from tbl_customer_details where cust_id = $cust_id and status = 1");

        if ($customer) {
            return response()->json(["data" => $customer], 200);
        } else {
            return response()->json(["message" => "No data found"], 404);
        }
    }


     // Delete  Customer entry

     public function deleteCustomer($cust_id)
     {
         $customer = Customer_Model::find($cust_id);
 
     if ($customer) {
         $customer->status = 0;
         $customer->save();
 
         return response()->json(["message" => "Record deleted successfully"], 200);
     } else {
         return response()->json(["message" => "Record not found"], 404);
     }
     }


      //  Update a Customer record

    public function updateCustomer(Request $request,$cust_id)
    {
        $customer = Customer_Model::find($cust_id);

        if ($customer) {

            $customer->cust_name = $request->input("cust_name");
            $customer->mobile = $request->input("mobile");
            $customer->email = $request->input("email");
            $customer->country = $request->input("country");
            $customer->state = $request->input("state");
            $customer->address = $request->input("address");
            $customer->bank_name = $request->input("bank_name");
            $customer->ifsc = $request->input("ifsc");
            $customer->acc_no = $request->input("acc_no");
            $customer->gstin = $request->input("gstin");
    
            $customer->save();

    
            return response()->json(["message" => "Record updated successfully"], 200);
        } else {
            return response()->json(["message" => "Record not found"], 404);
        }
    }
}
