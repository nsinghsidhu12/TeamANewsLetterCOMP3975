<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

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
}
