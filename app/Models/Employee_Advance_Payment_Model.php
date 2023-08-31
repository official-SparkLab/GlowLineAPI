<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_Advance_Payment_Model extends Model
{
    use HasFactory;

    protected $table  = "tbl_emp_advpayment";

    protected $primaryKey = "emp_id";

    protected $fillable = [
        "emp_name",
        "adv_amount",
        "payment_type",
        "date",
        "discription",
        "status"
    ];

    public $timestamps = false;
}
