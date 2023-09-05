<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class All_Products_Model extends Model
{
    use HasFactory;
    protected $table  = "tbl_all_products";

    protected $primaryKey = "p_id";

    protected $fillable = [
        "prod_name",
        "rate",
        "gst",
        "hsn",
        "description",
        "type",
        "status"
    ];

    public $timestamps = false;
}
