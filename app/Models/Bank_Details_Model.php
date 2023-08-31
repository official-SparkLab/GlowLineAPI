<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank_Details_Model extends Model
{
    use HasFactory;
    protected $table  = "tbl_coompany_bankdetails";

    protected $primaryKey = "bank_id";

    protected $fillable = [
        "account_no",
        "ifsc",
        "bank_name",
        "branch",
        "status"
    ];

    public $timestamps = false;
}
