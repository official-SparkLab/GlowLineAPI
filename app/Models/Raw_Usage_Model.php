<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raw_Usage_Model extends Model
{
    use HasFactory;

    protected $table  = "tbl_raw_usage";
    protected $primaryKey = "raw_id";

    protected $fillable = [
        "prod_id",
        "prod_name",
        "date",
        "hsn",
        "qty",
        "weight",
        "total_weight",
        "status"
    ];

    public $timestamps = false;
}
