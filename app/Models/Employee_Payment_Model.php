<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_Payment_Model extends Model
{
    use HasFactory;
    protected $table  = "tbl_emp_payment";

    protected $primaryKey = "emp_id";

    protected $fillable = [
        "emp_name",
        "date",
        "salary_type",
        "salary_amount",
        "deduction",
        "description",
        "status"
    ];

    public $timestamps = false;
}
