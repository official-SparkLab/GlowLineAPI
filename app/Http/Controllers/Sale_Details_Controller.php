<?php

namespace App\Http\Controllers;

use App\Models\Sale_Details_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Sale_Details_Controller extends Controller
{
    //

    // Add Products Method

    public function addSaleEntry(Request $request)
    {
        $product = new Sale_Details_Model;

        $product->invoice_no = $request->input("invoice_no");
        $product->date = $request->input("date");
        $product->cust_id = $request->input("cust_id");
        $product->cust_name = $request->input("cust_name");
        $product->mobile = $request->input("mobile");
        $product->gstin = $request->input("gstin");
        $product->address = $request->input("address");
        $product->place_of_supply = $request->input("place_of_supply");
        $product->dispatch_no = $request->input("dispatch_no");
        $product->destination = $request->input("destination");
        $product->trans_amt = $request->input("trans_amt");
        $product->hamali = $request->input("hamali");
        $product->driver_name = $request->input("driver_name");
        $product->vehicle_no = $request->input("vehicle_no");
        $product->cgst = $request->input("cgst");
        $product->cgst_amt = $request->input("cgst_amt");
        $product->sgat = $request->input("sgat");
        $product->sgat_amt = $request->input("sgat_amt");
        $product->igst = $request->input("igst");
        $product->igst_amt = $request->input("igst_amt");
        $product->sub_total = $request->input("sub_total");
        $product->total = $request->input("total");
        $product->com_id = $request->input("com_id");


        $product->save();

        return response()->json(["message" => "Data saved successfully", "status" => "success"], 201);
    }


    // Fetch All Product data
    public function fetchAllProducts()
    {
        $product = DB::select("SELECT * FROM tbl_sales_details where status = 1");

        if ($product) {
            return response()->json(["data" => $product], 200);
        } else {
            return response()->json(["message" => "No data found"], 404);
        }
    }


    // Fetch product by Id

    public function fetchById($date, $invoice_no)
    {
        try {
            $product = DB::table('tbl_sales_details')
                ->where('date', '=', $date)
                ->where('invoice_no', '=', $invoice_no)
                ->first();

            if ($product) {
                return response()->json(["data" => $product], 200);
            } else {
                return response()->json(["message" => "No data found"], 404);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(["error" => "An error occurred"], 500);
        }
    }


    public function fetchByCustId($cust_id)
    {
        try {
            $product = DB::table('tbl_sales_details')
                ->where('cust_id', '=', $cust_id)
                ->get();

            if ($product) {
                return response()->json(["data" => $product], 200);
            } else {
                return response()->json(["message" => "No data found"], 404);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(["error" => "An error occurred"], 500);
        }
    }

    // Delete Sale Details 
    public function deleteSaleDetails($sales_id)
    {
        try {
            $deletedRows = DB::table('tbl_sales_details')
                ->where('sales_id', '=', $sales_id)
                ->delete();

            if ($deletedRows === 0) {
                return response()->json(["message" => "No data found"], 404);
            } else {
                return response()->json(["message" => "Data deleted successfully", "status" => "success"], 200);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(["error" => "An error occurred"], 500);
        }
    }
    // Update Sale Details

    public function updateSaleDetails(Request $request, $date, $invoice_no)
    {
        $affectedRows = DB::table('tbl_sales_details')
            ->where('date', '=', $date)
            ->where('invoice_no', '=', $invoice_no)
            ->update([
                'cust_id' => $request->input("cust_id"),
                'cust_name' => $request->input("cust_name"),
                'mobile' => $request->input("mobile"),
                'gstin' => $request->input("gstin"),
                'address' => $request->input("address"),
                'place_of_supply' => $request->input("place_of_supply"),
                'dispatch_no' => $request->input("dispatch_no"),
                'destination' => $request->input("destination"),
                'trans_amt' => $request->input("trans_amt"),
                'hamali' => $request->input("hamali"),
                'driver_name' => $request->input("driver_name"),
                'vehicle_no' => $request->input("vehicle_no"),
                'cgst' => $request->input("cgst"),
                'cgst_amt' => $request->input("cgst_amt"),
                'sgat' => $request->input("sgat"),
                'sgat_amt' => $request->input("sgat_amt"),
                'igst' => $request->input("igst"),
                'igst_amt' => $request->input("igst_amt"),
                'sub_total' => $request->input("sub_total"),
                'total' => $request->input("total"),
            ]);
    
        if ($affectedRows === 0) {
            return response()->json(["message" => "No data found"]);
        } else {
            return response()->json(["message" => "Data updated successfully", "status" => "success"], 201);
        }
    }
    
    
}
