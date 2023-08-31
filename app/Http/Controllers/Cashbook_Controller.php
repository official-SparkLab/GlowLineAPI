<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cashbook_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Cashbook_Controller extends Controller
{
    // Add CashBook Details Method

    public function addCashbookDetails (Request $request)
    {
        $cashbook = new Cashbook_Model;

        $cashbook->entry_name = $request->input("entry_name");
        $cashbook->date = $request->input("date");
        $cashbook->credit_amt = $request->input("credit_amt");
        $cashbook->debit_amt = $request->input("debit_amt");
        $cashbook->paid_by = $request->input("paid_by");
        $cashbook->note = $request->input("note");

        $cashbook->save();

        return response()->json(["message" => "Data saved successfully","status" => "success"],201);
    }

    // Fetch All Cashbook data
    public function fetchAllCashbook()
    {
        $cashbook = DB::select("SELECT * FROM tbl_cashbook where status = 1");
    
        if ($cashbook) {
            return response()->json(["data" => $cashbook], 200);
        } else {
            return response()->json(["message" => "No data found"], 404);
        }
    }


    // Fetch Cashbook by Id

    public function fetchById($cb_id)
    {
        $cashbook = DB::select("select * from tbl_cashbook where cb_id = $cb_id and status = 1");

        if ($cashbook) {
            return response()->json(["data" => $cashbook], 200);
        } else {
            return response()->json(["message" => "No data found"], 404);
        }
    }

    // Delete  Cashbook entry

    public function deleteCashBook($cb_id)
    {
        $cashbook = Cashbook_Model::find($cb_id);

    if ($cashbook) {
        $cashbook->status = 0;
        $cashbook->save();

        return response()->json(["message" => "Record deleted successfully"], 200);
    } else {
        return response()->json(["message" => "Record not found"], 404);
    }
    }


    //  Update a cashbook record

    public function updateCashbook(Request $request,$cb_id)
    {
        $cashbook = Cashbook_Model::find($cb_id);

        if ($cashbook) {

        $cashbook->entry_name = $request->input("entry_name");
        $cashbook->date = $request->input("date");
        $cashbook->credit_amt = $request->input("credit_amt");
        $cashbook->debit_amt = $request->input("debit_amt");
        $cashbook->paid_by = $request->input("paid_by");
        $cashbook->note = $request->input("note");

        $cashbook->save();

    
            return response()->json(["message" => "Record updated successfully"], 200);
        } else {
            return response()->json(["message" => "Record not found"], 404);
        }
    }
    
}
