<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Damage_Material_Model extends Model
{
    use HasFactory;

    protected $table  = "tbl_damage_material";
    protected $primaryKey = "dam_id";

    protected $fillable = [
        "p_id",
        "prod_name",
        "date",
        "hsn",
        "total_weight",
        "type",
        "status"
    ];

    public $timestamps = false;
}
