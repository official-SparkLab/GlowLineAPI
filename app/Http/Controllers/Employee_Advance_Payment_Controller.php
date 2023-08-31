<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee_Advance_Payment_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Employee_Advance_Payment_Controller extends Controller
{
    //
     // Add Adv Payment Details Method

     public function addEmployeeAdvPayment (Request $request)
     {
         $payment = new Employee_Advance_Payment_Model;
 
         $payment->emp_name = $request->input("emp_name");
         $payment->adv_amount = $request->input("adv_amount");
         $payment->payment_type = $request->input("payment_type");
         $payment->date = $request->input("date");
         $payment->discription = $request->input("discription");
 
         $payment->save();
 
         return response()->json(["message" => "Data saved successfully","status" => "success"],201);
     }
 
     // Fetch All Payment data
     public function fetchAllEmployeeAdvPayment()
     {
         $payment = DB::select("SELECT * FROM tbl_emp_advpayment where status = 1");
     
         if ($payment) {
             return response()->json(["data" => $payment], 200);
         } else {
             return response()->json(["message" => "No data found"], 404);
         }
     }
 
 
     // Fetch Payment by Id
 
     public function fetchById($emp_id)
     {
         $payment = DB::select("select * from tbl_emp_advpayment where emp_id = $emp_id and status = 1");
 
         if ($payment) {
             return response()->json(["data" => $payment], 200);
         } else {
             return response()->json(["message" => "No data found"], 404);
         }
     }
 
     // Delete  Payment entry
 
     public function deleteEmployeeAdvPayment($emp_id)
     {
         $payment = Employee_Advance_Payment_Model::find($emp_id);
 
     if ($payment) {
         $payment->status = 0;
         $payment->save();
 
         return response()->json(["message" => "Record deleted successfully"], 200);
     } else {
         return response()->json(["message" => "Record not found"], 404);
     }
     }
 
 
     //  Update a Payment record
 
     public function updateCustomerAdvPayment(Request $request,$emp_id)
     {
         $payment = Employee_Advance_Payment_Model::find($emp_id);
 
         if ($payment) {
 
           
            $payment->emp_name = $request->input("emp_name");
            $payment->adv_amount = $request->input("adv_amount");
            $payment->payment_type = $request->input("payment_type");
            $payment->date = $request->input("date");
            $payment->discription = $request->input("discription");
    
            $payment->save();
     
             return response()->json(["message" => "Record updated successfully"], 200);
         } else {
             return response()->json(["message" => "Record not found"], 404);
         }
     }
}
