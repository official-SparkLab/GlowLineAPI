<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense_Model extends Model
{
    use HasFactory;
    protected $table  = "tbl_expenses";

    protected $primaryKey = "exp_id";

    protected $fillable = [
        "exp_name",
        "exp_details",
        "date",
        "exp_amt",
        "paid_status",
        "note",
        "status"
    ];

    public $timestamps = false;
}
