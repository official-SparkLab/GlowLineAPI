<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bank_Details_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Bank_Details_Controller extends Controller
{
   
    // Add Employee BankDetails Method

    public function addBankDetails (Request $request)
    {
        $BankDetails = new Bank_Details_Model;

        $BankDetails->account_no = $request->input("account_no");
        $BankDetails->ifsc = $request->input("ifsc");
        $BankDetails->bank_name = $request->input("bank_name");
        $BankDetails->branch = $request->input("branch");

        $BankDetails->save();

        return response()->json(["message" => "Data saved successfully","status" => "success"],201);
    }

    // Fetch All BankDetails data
    public function fetchAllBankDetails()
    {
        $BankDetails = DB::select("SELECT * FROM tbl_coompany_bankdetails where status = 1");
    
        if ($BankDetails) {
            return response()->json(["data" => $BankDetails], 200);
        } else {
            return response()->json(["message" => "No data found"], 404);
        }
    }


    // Fetch BankDetails by Id

    public function fetchById($bank_id)
    {
        $BankDetails = DB::select("select * from tbl_coompany_bankdetails where bank_id = $bank_id and status = 1");

        if ($BankDetails) {
            return response()->json(["data" => $BankDetails], 200);
        } else {
            return response()->json(["message" => "No data found"], 404);
        }
    }

    // Delete  BankDetails entry

    public function deleteBankDetails($bank_id)
    {
        $BankDetails = Bank_Details_Model::find($bank_id);

    if ($BankDetails) {
        $BankDetails->status = 0;
        $BankDetails->save();

        return response()->json(["message" => "Record deleted successfully"], 200);
    } else {
        return response()->json(["message" => "Record not found"], 404);
    }
    }


    //  Update a BankDetails record

    public function updateBankDetails(Request $request,$bank_id)
    {
        $BankDetails = Bank_Details_Model::find($bank_id);

        if ($BankDetails) {

       
            $BankDetails->account_no = $request->input("account_no");
            $BankDetails->ifsc = $request->input("ifsc");
            $BankDetails->bank_name = $request->input("bank_name");
            $BankDetails->branch = $request->input("branch");
    
            $BankDetails->save();
         
    
            return response()->json(["message" => "Record updated successfully"], 200);
        } else {
            return response()->json(["message" => "Record not found"], 404);
        }
    }
}
