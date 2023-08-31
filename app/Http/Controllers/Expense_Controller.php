<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Expense_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Expense_Controller extends Controller
{
      // Add CashBook Details Method

      public function addExpenseDetails (Request $request)
      {
          $cashbook = new Expense_Model;
  
          $cashbook->exp_name = $request->input("exp_name");
          $cashbook->exp_details = $request->input("exp_details");
          $cashbook->date = $request->input("date");
          $cashbook->exp_amt = $request->input("exp_amt");
          $cashbook->paid_status = $request->input("paid_status");
          $cashbook->note = $request->input("note");
  
          $cashbook->save();
  
          return response()->json(["message" => "Data saved successfully","status" => "success"],201);
      }
  
      // Fetch All Cashbook data
      public function fetchAllExpense()
      {
          $cashbook = DB::select("SELECT * FROM tbl_expenses where status = 1");
      
          if ($cashbook) {
              return response()->json(["data" => $cashbook], 200);
          } else {
              return response()->json(["message" => "No data found"], 404);
          }
      }
  
  
      // Fetch Cashbook by Id
  
      public function fetchById($exp_id)
      {
          $cashbook = DB::select("select * from tbl_expenses where exp_id = $exp_id and status = 1");
  
          if ($cashbook) {
              return response()->json(["data" => $cashbook], 200);
          } else {
              return response()->json(["message" => "No data found"], 404);
          }
      }
  
      // Delete  Cashbook entry
  
      public function deleteExpense($exp_id)
      {
          $cashbook = Expense_Model::find($exp_id);
  
      if ($cashbook) {
          $cashbook->status = 0;
          $cashbook->save();
  
          return response()->json(["message" => "Record deleted successfully"], 200);
      } else {
          return response()->json(["message" => "Record not found"], 404);
      }
      }
  
  
      //  Update a cashbook record
  
      public function updateExpense(Request $request,$exp_id)
      {
          $cashbook = Expense_Model::find($exp_id);
  
          if ($cashbook) {
  
            $cashbook->exp_name = $request->input("exp_name");
            $cashbook->exp_details = $request->input("exp_details");
            $cashbook->date = $request->input("date");
            $cashbook->exp_amt = $request->input("exp_amt");
            $cashbook->paid_status = $request->input("paid_status");
            $cashbook->note = $request->input("note");
    
            $cashbook->save();
        
  
          $cashbook->save();
  
      
              return response()->json(["message" => "Record updated successfully"], 200);
          } else {
              return response()->json(["message" => "Record not found"], 404);
          }
      }
}
