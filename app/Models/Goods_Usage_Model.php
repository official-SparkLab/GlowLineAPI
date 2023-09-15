<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods_Usage_Model extends Model
{
    use HasFactory;

    protected $table  = "tbl_goods_usage";
    protected $primaryKey = "g_id";

    protected $fillable = [
        "p_id",
        "prod_name",
        "date",
        "hsn",
        "qty",
        "total_weight",
        "type",
        "status"
    ];

    public $timestamps = false;
}
