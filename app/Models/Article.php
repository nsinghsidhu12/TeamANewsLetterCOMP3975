<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 *
 * @OA\Schema(
 * required={"ArticleID", "NewsletterID", "Title", "Description", "Image", "ImagePlacement"},
 * @OA\Xml(name="Article"),
 * @OA\Property(
 * property="ArticleID",
 * type="integer",
 * format="int64",
 * description="Article ID.",
 * example="1"
 * ),
 * @OA\Property(
 * property="NewsletterID",
 * type="integer",
 * format="int64",
 * description="Newsletter ID.",
 * example="1"
 * ),
 * @OA\Property(
 * property="Title",
 * type="string",
 * description="Article title.",
 * example="Article title"
 * ),
 * @OA\Property(
 * property="Description",
 * type="string",
 * description="Article description.",
 * example="Article description"
 * ),
 * @OA\Property(
 * property="Image",
 * type="string",
 * description="Article image.",
 * example="image.jpg"
 * ),
 * @OA\Property(
 * property="ImagePlacement",
 * type="string",
 * description="Article image placement.",
 * example="left"
 * ),
 * @OA\Property(
 * property="deleted_at",
 * readOnly="true",
 * format="datetime",
 * description="Deleted at.",
 * example="2022-05-18 07:50:45"
 * ),
 * @OA\Property(
 * property="created_at",
 * readOnly="true",
 * format="datetime",
 * description="Created at.",
 * example="2022-05-18 07:50:45"
 * ),
 * @OA\Property(
 * property="updated_at",
 * readOnly="true",
 * format="datetime",
 * description="Updated at.",
 * example="2022-06-11 06:15:25"
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
