<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_Details_Model extends Model
{
    use HasFactory;
    protected $table  = "tbl_emp_details";

    protected $primaryKey = "emp_id";

    protected $fillable = [
        "emp_name",
        "birth_date",
        "address",
        "mobile_no",
        "join_date",
        "emp_type",
        "designation",
        "salary",
        "bank_name",
        "ifsc",
        "account_no",
        "status"
    ];

    public $timestamps = false;
}
