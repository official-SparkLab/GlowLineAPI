<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_Payable_Model extends Model
{
    use HasFactory;

    protected $table  = "tbl_purchase_payble";
    protected $primaryKey = "pur_pay_id";

    protected $fillable = [
        "sup_id",
        "sup_name",
        "date",
        "mobile_no",
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
