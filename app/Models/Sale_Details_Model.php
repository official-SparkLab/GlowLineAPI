<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale_Details_Model extends Model
{
    use HasFactory;

    protected $table  = "tbl_sales_details";

    protected $primaryKey = "sales_id ";

    protected $fillable = [
        "invoice_no",
        "date",
        "cust_id",
        "cust_name",
        "mobile",
        "gstin",
        "address",
        "place_of_supply",
        "dispatch_no",
        "destination",
        "trans_amt",
        "hamali",
        "driver_name",
        "vehicle_no",
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
