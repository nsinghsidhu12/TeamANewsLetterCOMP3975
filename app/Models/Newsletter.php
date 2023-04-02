<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 *
 * @OA\Schema(
 * required={"NewsletterID", "Logo", "Date", "Title", "IsActive"},
 * @OA\Xml(name="Newsletter"),
 * @OA\Property(
 * property="NewsletterID",
 * type="integer",
 * description="The ID of a newsletter",
 * readOnly="true",
 * example="1"
 * ),
 * @OA\Property(
 * property="Logo",
 * type="string",
 * description="The URL of a newsletter's logo",
 * example="https://via.placeholder.com/640x480.png/00ee44?text=sed"
 * ),
 * @OA\Property(
 * property="Date",
 * type="string",
 * description="The date of a newsletter",
 * example="2020-01-01"
 * ),
 * @OA\Property(
 * property="Title",
 * type="string",
 * description="The title of a newsletter",
 * example="The Great Newsletter"
 * ),
 * @OA\Property(
 * property="IsActive",
 * type="integer",
 * description="Determines if a newsletter is active",
 * example="1"
 * ),
 * )
 */
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
