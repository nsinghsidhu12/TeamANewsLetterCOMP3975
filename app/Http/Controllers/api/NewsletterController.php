<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsletterController extends Controller
{
    /**
    * @OA\Get(
    * path="/api/newsletters/lastfive",
    * tags={"Newsletters"},
    * summary="Get the last five active newsletters",
    * description="Get the last five active newsletters",
    * operationId="lastFiveNewsletters",
    * @OA\Response(
    * response=200,
    * description="successful operation"
    * ),
    * @OA\Response(
    * response=400,
    * description="Invalid status value"
    * )
    * )
    */
    public function lastFiveNewsletters() {
        // Get the 5 latest newsletters. Distinct as joins will cause multiple NewsletterIDs to appear and count for the take query.
        $distinctNewsletters = DB::table('newsletters')
            ->join('articles', 'newsletters.NewsletterID', '=', 'articles.NewsletterID')
            ->select('newsletters.NewsletterID')
            ->where('IsActive', '=', 1)
            ->orderBy('newsletters.NewsletterID', 'desc')
            ->distinct()
            ->take(5)
            ->get()->toArray();

        $myArray = array();

        for ($i = 0; $i < count($distinctNewsletters); $i++) {
            array_push($myArray, $distinctNewsletters[$i]->NewsletterID);
        }

        return DB::table('newsletters')
            ->join('articles', 'newsletters.NewsletterID', '=', 'articles.NewsletterID')
            ->select(
                'newsletters.NewsletterID',
                'newsletters.Title as NewsletterTitle',
                'newsletters.Date',
                'newsletters.Logo',
                'articles.Title as ArticleTitle',
                'articles.Description',
                'articles.Image',
                'articles.ImagePlacement'
            )
            ->whereIn('newsletters.NewsletterID', $myArray)
            ->orderBy('newsletters.NewsletterID', 'desc')
            ->get();
    }
}
