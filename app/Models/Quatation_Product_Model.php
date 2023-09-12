<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quatation_Product_Model extends Model
{
    use HasFactory;


    protected $table  = "tbl_quatation_product";
    protected $primaryKey = "qp_id";

    protected $fillable = [
        "q_prod_id",
        "voucher_no",
        "q_date",
        "gp_id",
        "prod_name",
        "hsn",
        "weight",
        "qty",
        "rate",
        "total",
        "type"
    ];

    public $timestamps = false;
}
