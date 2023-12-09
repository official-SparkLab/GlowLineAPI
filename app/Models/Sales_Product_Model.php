<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_Product_Model extends Model
{
    use HasFactory;
    protected $table  = "tbl_sales_product";
    protected $primaryKey = "sp_id";

    protected $fillable = [
        "sales_prod_id",
        "invoice_no",
        "cust_id",
        "s_date",
        "p_id",
        "prod_name",
        "hsn",
        "total_weight",
        "qty",
        "rate",
        "total",
        "type"
    ];

    public $timestamps = false;
}
