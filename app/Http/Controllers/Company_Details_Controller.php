<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company_Details_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Company_Details_Controller extends Controller
{
    //

      // Add Company Details Method

      public function addCompanyDetails (Request $request)
      {
          $Company = new Company_Details_Model;
  
          $Company->com_name = $request->input("com_name");
          $Company->contact = $request->input("contact");
          $Company->email = $request->input("email");
          $Company->city = $request->input("city");
          $Company->state = $request->input("state");
          $Company->address = $request->input("address");
          $Company->gst = $request->input("gst");
          $Company->company_code = $request->input("company_code");

  
          $Company->save();
  
          return response()->json(["message" => "Data saved successfully","status" => "success"],201);
      }
  
      // Fetch All Company data
      public function fetchAllCompany()
      {
          $Company = DB::select("SELECT * FROM tbl_company_details where status = 1");
      
          if ($Company) {
              return response()->json(["data" => $Company], 200);
          } else {
              return response()->json(["message" => "No data found"], 404);
          }
      }
  
  
      // Fetch Company by Id
  
      public function fetchById($com_id)
      {
          $Company = DB::select("select * from tbl_company_details where com_id = $com_id and status = 1");
  
          if ($Company) {
              return response()->json(["data" => $Company], 200);
          } else {
              return response()->json(["message" => "No data found"], 404);
          }
      }
  
      // Delete  Company entry
  
      public function deleteCompany($com_id)
      {
          $Company = Company_Details_Model::find($com_id);
  
      if ($Company) {
          $Company->status = 0;
          $Company->save();
  
          return response()->json(["message" => "Record deleted successfully"], 200);
      } else {
          return response()->json(["message" => "Record not found"], 404);
      }
      }
  
  
      //  Update a Company record
  
      public function updateCompany(Request $request,$com_id)
      {
          $Company = Company_Details_Model::find($com_id);
  
          if ($Company) {
  
            $Company->com_name = $request->input("com_name");
            $Company->contact = $request->input("contact");
            $Company->email = $request->input("email");
            $Company->city = $request->input("city");
            $Company->state = $request->input("state");
            $Company->address = $request->input("address");
            $Company->gst = $request->input("gst");
            $Company->company_code = $request->input("company_code");
  
    
            $Company->save();
      
              return response()->json(["message" => "Record updated successfully"], 200);
          } else {
              return response()->json(["message" => "Record not found"], 404);
          }
      }
}
