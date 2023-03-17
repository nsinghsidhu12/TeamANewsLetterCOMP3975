<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Newsletter extends Model
{
    use HasFactory, Searchable;

    // Disabling the created_at and updated_at columns for Newsletter
    public $timestamps = false;

    /*Laravel assumes that the primary key for a table is an auto-incrementing integer column named `id`. 
    If the table's primary key column has a different name, we need to explicitly specify it in its model.*/
    protected $primaryKey = 'NewsletterID';

    // Columns to use when mass assigning data to Newsletter
    protected $fillable = [
        'Logo',
        'Date',
        'Title',
        'IsActive'
    ];

    public function toSearchableArray()
    {
        return [
            'NewsletterID' => (int) $this->NewsletterID,
            'Date' => $this->Date,
            'Title' =>  $this->Title,
            'IsActive' => (bool) $this->IsActive
        ];
    }
}
