<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_Attendence_Model extends Model
{
    use HasFactory;
    protected $table  = "tbl_emp_attendance";

    protected $primaryKey = "emp_id";

    protected $fillable = [
        "emp_name",
        "date",
        "attendance",
        "discription",
        "status"
    ];

    public $timestamps = false;
}
