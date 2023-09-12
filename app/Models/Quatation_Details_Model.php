<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quatation_Details_Model extends Model
{
    use HasFactory;

    protected $table  = "tbl_quatation_details";

    protected $primaryKey = "q_id ";

    protected $fillable = [
        "voucher_no",
        "date",
        "order_no",
        "destination",
        "trans_amt",
        "hamali",
        "cgst",
        "cgst_amt",
        "sgat",
        "sgat_amt",
        "igst",
        "igst_amt",
        "sub_total",
        "total",
        "status"
    ];

    public $timestamps = false;
}
