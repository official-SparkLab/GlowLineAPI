<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_Model extends Model
{
    use HasFactory;
    protected $table  = "tbl_customer_details";

    protected $primaryKey = "cust_id";

    protected $fillable = [
        "cust_name",
        "mobile",
        "email",
        "country",
        "state",
        "address",
        "bank_name",
        "ifsc",
        "acc_no",
        "gstin",
        "status"
    ];

    public $timestamps = false;
}
