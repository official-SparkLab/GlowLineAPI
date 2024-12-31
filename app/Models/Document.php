<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'tbl_einvoice_details';

    // Primary key
    protected $primaryKey = 'doc_id';

    // Mass assignable attributes
    protected $fillable = [
        'document_no',
        'document_date',
        'irn',
    ];

    
}