<?php

namespace App\Http\Controllers;

use App\Models\Sale_Payble_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Sale_Payable_Controller extends Controller
{
    //

    public function addPayable (Request $request)
    {
        $product = new Sale_Payble_Model();
        $product->cust_id = $request->input("cust_id");
        $product->cust_name = $request->input("cust_name");
        $product->date = $request->input("date");
        $product->mobile = $request->input("mobile");
        $product->gstin = $request->input("gstin");
        $product->pending_amt = $request->input("pending_amt");
        $product->paid_amount = $request->input("paid_amount");
        $product->available_bal = $request->input("available_bal");
        $product->payment_mode = $request->input("payment_mode");
        $product->trx_no = $request->input("trx_no");
        $product->save();

        return response()->json(["message" => "Data saved successfully","status" => "success"],201);
    }


    // Fetch All Product data
    public function fetchAllPayable()
    {
        $product = DB::select("SELECT * FROM tbl_sale_payable");
    
        if ($product) {
            return response()->json(["data" => $product], 200);
        } else {
            return response()->json(["message" => "No data found"], 404);
        }
    }


    public function deleteSalePayable($sale_pay_id)
    {
        try {
            $product = Sale_Payble_Model::where('sale_pay_id', $sale_pay_id)
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

    public function updateSalePayable(Request $request, $sale_pay_id)
    {
        try {
            $product = Sale_Payble_Model::where('sale_pay_id', $sale_pay_id)->first();
    
            if (!$product) {
                return response()->json(['Message' => 'Product not found']);
            }
    
            $product->update([
                'cust_id' => $request->input('cust_id'),
                'cust_name' => $request->input('cust_name'),
                'date' => $request->input('date'),
                'mobile' => $request->input('mobile'),
                'gstin' => $request->input('gstin'),
                'pending_amt' => $request->input('pending_amt'),
                'paid_amount' => $request->input('paid_amount'),
                'available_bal' => $request->input('available_bal'),
                'payment_mode' => $request->input('payment_mode'),
                'trx_no' => $request->input('trx_no'),
            ]);
    
            return response()->json(['Message' => 'Record updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['Message' => 'Error: ' . $e->getMessage()]);
        }
    }
    
}
