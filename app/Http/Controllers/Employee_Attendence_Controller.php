<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee_Attendence_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Employee_Attendence_Controller extends Controller
{
    //
    // Add Employee Attendence Method

    public function addEmployeeAttendence (Request $request)
    {
        $attendence = new Employee_Attendence_Model;

        $attendence->emp_name = $request->input("emp_name");
        $attendence->date = $request->input("date");
        $attendence->attendance = $request->input("attendance");
        $attendence->description = $request->input("description");

        $attendence->save();

        return response()->json(["message" => "Data saved successfully","status" => "success"],201);
    }

    // Fetch All attendence data
    public function fetchAllEmployeeAttendence()
    {
        $attendence = DB::select("SELECT * FROM tbl_emp_attendance where status = 1");
    
        if ($attendence) {
            return response()->json(["data" => $attendence], 200);
        } else {
            return response()->json(["message" => "No data found"], 404);
        }
    }


    // Fetch attendence by Id

    public function fetchById($emp_id)
    {
        $attendence = DB::select("select * from tbl_emp_attendance where emp_id = $emp_id and status = 1");

        if ($attendence) {
            return response()->json(["data" => $attendence], 200);
        } else {
            return response()->json(["message" => "No data found"], 404);
        }
    }

    // Delete  attendence entry

    public function deleteEmployeeAttendence($emp_id)
    {
        $attendence = Employee_Attendence_Model::find($emp_id);

    if ($attendence) {
        $attendence->status = 0;
        $attendence->save();

        return response()->json(["message" => "Record deleted successfully"], 200);
    } else {
        return response()->json(["message" => "Record not found"], 404);
    }
    }


    //  Update a attendence record

    public function updateCustomerAttendence(Request $request,$emp_id)
    {
        $attendence = Employee_Attendence_Model::find($emp_id);

        if ($attendence) {

            $attendence->emp_name = $request->input("emp_name");
            $attendence->date = $request->input("date");
            $attendence->attendance = $request->input("attendance");
            $attendence->description = $request->input("description");
    
            $attendence->save();
         
    
            return response()->json(["message" => "Record updated successfully"], 200);
        } else {
            return response()->json(["message" => "Record not found"], 404);
        }
    }
}
