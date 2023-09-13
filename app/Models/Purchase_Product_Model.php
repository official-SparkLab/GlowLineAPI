<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_Product_Model extends Model
{
    use HasFactory;

    protected $table  = "tbl_raw_purchase_product";
    protected $primaryKey = "row_p_id";

    protected $fillable = [
        "pur_prod_id",
        "invoice_no",
        "p_date",
        "p_id",
        "prod_name",
        "weight",
        "qty",
        "rate",
        "total",
        "hsn",
        "type"
    ];

    public $timestamps = false;
}
