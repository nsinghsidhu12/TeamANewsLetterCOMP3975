<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use HasFactory, Searchable;

    // Disabling the created_at and updated_at columns for Article
    public $timestamps = false;

    protected $primaryKey = 'ArticleID';

    // Columns to use when mass assigning data to Article
    protected $fillable = [
        'ArticleID',
        'NewsletterID',
        'Title',
        'Description',
        'Image',
        'ImagePlacement'
    ];

    public function newsletter()
    {
        return $this->belongsTo(Newsletter::class, 'NewsletterID');
    }

    public function toSearchableArray()
    {
        return [
            'ArticleID' => (int) $this->ArticleID,
            'NewsletterID' => (int) $this->NewsletterID,
            'Title' =>  $this->Title,
            'IsActive' => (bool) $this->IsActive
        ];
    }
}
