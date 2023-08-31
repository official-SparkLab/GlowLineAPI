<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashbook_Model extends Model
{
    use HasFactory;
    protected $table  = "tbl_cashbook";

    protected $primaryKey = "cb_id";

    protected $fillable = [
        "entry_name",
        "date",
        "credit_amt",
        "debit_amt",
        "paid_by",
        "note",
        "status"
    ];

    public $timestamps = false;
}
