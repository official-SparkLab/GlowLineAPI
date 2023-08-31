<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company_Details_Model extends Model
{
    use HasFactory;

    protected $table  = "tbl_company_details";

    protected $primaryKey = "com_id";

    protected $fillable = [
        "com_name",
        "contact",
        "email",
        "city",
        "state",
        "address",
        "gst",
        "company_code"
    ];

    public $timestamps = false;
}
