<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'tbl_document';

    // Primary key
    protected $primaryKey = 'doc_id';

    // Mass assignable attributes
    protected $fillable = [
        'document_no',
        'document_date',
        'irn',
    ];

    // Disable timestamps if not used in the table
    public $timestamps = false;

    // Cast attributes to specific types (optional)
    protected $casts = [
        'document_date' => 'date',
    ];
}