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
     * path="/api/newsletters",
     * tags={"Newsletters"},
     * summary="Get all the newsletters without their articles",
     * description="Get all the newsletters without their articles in the database",
     * operationId="newslettersIndex",
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
    public function newslettersIndex()
    {
        return Newsletter::all();
    }

    /**
     * @OA\Get(
     * path="/api/newsletters/{NewsletterID}",
     * operationId="newslettersShow",
     * tags={"Newsletters"},
     * summary="Get a newsletter's information without the articles",
     * description="Get a newsletter's information without the articles from the database",
     * @OA\Parameter(
     * name="NewsletterID",
     * description="The ID of a newsletter",
     * required=true,
     * in="path",
     * @OA\Schema(
     * type="integer"
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Successful operation",
     * ),
     * @OA\Response(
     * response=400,
     * description="Bad Request"
     * ),
     * @OA\Response(
     * response=401,
     * description="Unauthenticated",
     * ),
     * @OA\Response(
     * response=403,
     * description="Forbidden"
     * )
     * )
     */
    public function newslettersShow($id)
    {
        return Newsletter::findOrFail($id);
    }

    /**
     * @OA\Get(
     * path="/api/newsletters/lastfive",
     * tags={"Newsletters"},
     * summary="Get the last five active newsletters with their articles",
     * description="Get the last five active newsletters with their articles from the database",
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
    public function lastFiveNewsletters()
    {
        // Get the 5 latest newsletters. Distinct as joins will cause multiple NewsletterIDs to appear and count for the take query.
        $distinctNewsletters = DB::table('newsletters')
            ->join('articles', 'newsletters.NewsletterID', '=', 'articles.NewsletterID')
            ->select('newsletters.NewsletterID')
            ->where('IsActive', '=', 1)
            ->orderBy('newsletters.Date', 'desc')
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
            ->orderBy('newsletters.Date', 'desc')
            ->get();
    }

    /**
     * @OA\Post(
     * path="/api/newsletters",
     * operationId="newslettersStore",
     * tags={"Newsletters"},
     * summary="Add a newsletter",
     * description="Add a newsletter to the database",
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(ref="#/components/schemas/Newsletter")
     * ),
     * @OA\Response(
     * response=201,
     * description="Successful operation",
     * @OA\JsonContent(ref="#/components/schemas/Newsletter")
     * ),
     * @OA\Response(
     * response=400,
     * description="Bad Request"
     * ),
     * @OA\Response(
     * response=401,
     * description="Unauthenticated",
     * ),
     * @OA\Response(
     * response=403,
     * description="Forbidden"
     * )
     * )
     */
    public function newslettersStore(Request $request)
    {
        request()->validate([
            'Logo' => 'required',
            'Date' => 'required',
            'Title' => 'required',
            'IsActive' => 'required',
        ]);

        return Newsletter::create([
            'Logo' => request('Logo'),
            'Date' => request('Date'),
            'Title' => request('Title'),
            'IsActive' => request('IsActive'),
        ]);
    }

    /**
     * @OA\Put(
     * path="/api/newsletters/{NewsletterID}",
     * operationId="newslettersUpdate",
     * tags={"Newsletters"},
     * summary="Update an existing newsletter's basic information",
     * description="Update an existing newsletter's basic information in the database",
     * @OA\Parameter(
     * name="NewsletterID",
     * description="The ID of a newsletter",
     * required=true,
     * in="path",
     * @OA\Schema(
     * type="integer"
     * )
     * ),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(ref="#/components/schemas/Newsletter")
     * ),
     * @OA\Response(
     * response=202,
     * description="Successful operation",
     * @OA\JsonContent(ref="#/components/schemas/Newsletter")
     * ),
     * @OA\Response(
     * response=400,
     * description="Bad Request"
     * ),
     * @OA\Response(
     * response=401,
     * description="Unauthenticated",
     * ),
     * @OA\Response(
     * response=403,
     * description="Forbidden"
     * ),
     * @OA\Response(
     * response=404,
     * description="Resource Not Found"
     * )
     * )
     */
    public function newslettersUpdate(Request $request, $id)
    {
        request()->validate([
            'Logo' => 'required',
            'Date' => 'required',
            'Title' => 'required',
            'IsActive' => 'required',
        ]);

        $newsletter = Newsletter::find($id);

        $isSuccess = $newsletter->update([
            'Logo' => request('Logo'),
            'Date' => request('Date'),
            'Title' => request('Title'),
            'IsActive' => request('IsActive'),
        ]);

        return [
            'success' => $isSuccess
        ];
    }

    /**
     * @OA\Delete(
     * path="/api/newsletters/{NewsletterID}",
     * operationId="newslettersDelete",
     * tags={"Newsletters"},
     * summary="Delete an existing newsletter",
     * description="Deletes an existing newsletter in the database",
     * @OA\Parameter(
     * name="NewsletterID",
     * description="The ID of a newsletter",
     * required=true,
     * in="path",
     * @OA\Schema(
     * type="integer"
     * )
     * ),
     * @OA\Response(
     * response=204,
     * description="Successful operation",
     * @OA\JsonContent()
     * ),
     * @OA\Response(
     * response=401,
     * description="Unauthenticated",
     * ),
     * @OA\Response(
     * response=403,
     * description="Forbidden"
     * ),
     * @OA\Response(
     * response=404,
     * description="Resource Not Found"
     * )
     * )
     */
    public function newslettersDelete($id, Newsletter $newsletter)
    {
        $newsletter = Newsletter::find($id);

        if ($newsletter) {
            DB::table('articles')
            ->where('NewsletterID', '=', $id)
            ->update(['NewsletterID' => null]);
            
            $isSuccess = $newsletter->delete();
        } else {
            $isSuccess = False;
        }
        

        return [
            'success' => $isSuccess
        ];
    }
}
