<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    // Disabling the created_at and updated_at columns for Newsletter
    public $timestamps = false;

    // Columns to use when mass assigning data to Newsletter
    protected $fillable = [
        'Logo',
        'Number',
        'Date',
        'Title',
        'IsActive'
    ];
}
