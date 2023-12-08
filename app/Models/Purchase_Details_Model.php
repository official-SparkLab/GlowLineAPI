<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_Details_Model extends Model
{
    use HasFactory;

    protected $table  = "tbl_raw_purchase";

    protected $primaryKey = "rawp_id  ";

    protected $fillable = [
        "invoice_no",
        "date",
        "sup_id",
        "sup_name",
        "mobile_no",
        "gstin",
        "address",
        "place_of_supply",
        "dispatch_no",
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
        "com_id",
        "status"
    ];

    public $timestamps = false;
}
