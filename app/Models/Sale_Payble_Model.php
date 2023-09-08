<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale_Payble_Model extends Model
{
    use HasFactory;

    protected $table  = "tbl_sale_payable";
    protected $primaryKey = "sale_pay_id";

    protected $fillable = [
        "cust_id",
        "cust_name",
        "date",
        "mobile",
        "gstin",
        "pending_amt",
        "paid_amount",
        "available_bal",
        "payment_mode",
        "trx_no",
        "status"
    ];

    public $timestamps = false;
}
