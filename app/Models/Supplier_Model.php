<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier_Model extends Model
{
    use HasFactory;
    protected $table  = "tbl_raw_supplier";

    protected $primaryKey = "sup_id";

    protected $fillable = [
        "sup_name",
        "gstin",
        "address",
        "city",
        "state",
        "office_contact",
        "mobile_no",
        "email",
        "bank_name",
        "ifsc",
        "acc_no",
        "description",
        "status"
    ];

    public $timestamps = false;
}
