<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 *
 * @OA\Schema(
 * required={"ArticleID", "Title", "Description"},
 * @OA\Xml(name="Article"),
 * @OA\Property(
 * property="ArticleID",
 * type="integer",
 * description="The ID of an article",
 * readOnly="true",
 * example="1"
 * ),
 * @OA\Property(
 * property="NewsletterID",
 * type="integer",
 * description="The ID of a newsletter that an article is assigned to",
 * example="1"
 * ),
 * @OA\Property(
 * property="Title",
 * type="string",
 * description="The title of an article",
 * example="The Great Article"
 * ),
 * @OA\Property(
 * property="Description",
 * type="string",
 * description="The description of an article",
 * example="Just a simple description of an article"
 * ),
 * @OA\Property(
 * property="Image",
 * type="string",
 * description="The URL of an article's image",
 * example="https://via.placeholder.com/640x480.png/000055?text=est"
 * ),
 * @OA\Property(
 * property="ImagePlacement",
 * type="string",
 * description="The placement for an article's image",
 * example="Left"
 * ),
 * )
 */
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
            'Description' => $this->Description
        ];
    }
}
