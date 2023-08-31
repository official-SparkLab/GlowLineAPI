<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee_Details_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Employee_Details_Controller extends Controller
{
    //Add Employee_Details
    public function addEmployee (Request $request)
    {
        $employee = new Employee_Details_Model;

        $employee->emp_name = $request->input("emp_name");
        $employee->birth_date = $request->input("birth_date");
        $employee->address = $request->input("address");
        $employee->mobile_no = $request->input("mobile_no");
        $employee->join_date = $request->input("join_date");
        $employee->emp_type = $request->input("emp_type");
        $employee->designation = $request->input("designation");
        $employee->salary = $request->input("salary");
        $employee->bank_name = $request->input("bank_name");
        $employee->ifsc = $request->input("ifsc");
        $employee->account_no = $request->input("account_no");


        $employee->save();

        return response()->json(["message" => "Data saved successfully","status" => "success"],201);
    }

       // Fetch All Employee data
       public function fetchAllEmployee()
       {
           $employee = DB::select("SELECT * FROM tbl_emp_details where status = 1");
       
           if ($employee) {
               return response()->json(["data" => $employee], 200);
           } else {
               return response()->json(["message" => "No data found"], 404);
           }
       }

        // Fetch Employee by Id

    public function fetchById($emp_id)
    {
        $employee = DB::select("select * from tbl_emp_details where emp_id = $emp_id and status = 1");

        if ($employee) {
            return response()->json(["data" => $employee], 200);
        } else {
            return response()->json(["message" => "No data found"], 404);
        }
    }


     // Delete  Employee entry

     public function deleteEmployee($emp_id)
     {
         $employee = Employee_Details_Model::find($emp_id);
 
     if ($employee) {
         $employee->status = 0;
         $employee->save();
 
         return response()->json(["message" => "Record deleted successfully"], 200);
     } else {
         return response()->json(["message" => "Record not found"], 404);
     }
     }


      //  Update a Employee record

    public function updateCustomer(Request $request,$emp_id)
    {
        $employee = Employee_Details_Model::find($emp_id);

        if ($employee) {

            $employee->emp_name = $request->input("emp_name");
            $employee->birth_date = $request->input("birth_date");
            $employee->address = $request->input("address");
            $employee->mobile_no = $request->input("mobile_no");
            $employee->join_date = $request->input("join_date");
            $employee->emp_type = $request->input("emp_type");
            $employee->designation = $request->input("designation");
            $employee->salary = $request->input("salary");
            $employee->bank_name = $request->input("bank_name");
            $employee->ifsc = $request->input("ifsc");
            $employee->account_no = $request->input("account_no");
    
    
            $employee->save();
    
            return response()->json(["message" => "Record updated successfully"], 200);
        } else {
            return response()->json(["message" => "Record not found"], 404);
        }
    }
}
