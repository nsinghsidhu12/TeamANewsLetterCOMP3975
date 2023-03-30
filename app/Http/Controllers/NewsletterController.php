<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/**
 * @OA\Info(title="Newsletter API", 
 *          version="1.0",
 *         description="Newsletter API Documentation")
 */
class NewsletterController extends Controller
{
    /**
     * @OA\Get(
     *      path="/newsletters",
     *      operationId="getNewslettersList",
     *      tags={"Newsletters"},
     *      summary="Get list of newsletters",
     *      @OA\Response(
     *          response=200,
     *          description="List of newsletters",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Newsletter"))
     *      )
     * )
     */
    public function index()
    {
        $data = Newsletter::paginate(5);
        return view("newsletters.index", ['newsletters' => $data]);
    }

    /**
     * @OA\Post(
     *      path="/newsletters",
     *      operationId="createNewsletter",
     *      tags={"Newsletters"},
     *      summary="Create new newsletter",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Newsletter")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Newsletter created successfully",
     *          @OA\JsonContent(ref="#/components/schemas/Newsletter")
     *      )
     * )
     */
    public function create()
    {
        return view('newsletters.create');
    }


    /**
     * @OA\Get(
     *      path="/newsletters/{id}",
     *      operationId="getNewsletterById",
     *      tags={"Newsletters"},
     *      summary="Get newsletter by ID",
     *      @OA\Parameter(
     *          name="id",
     *          description="Newsletter ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Found newsletter",
     *          @OA\JsonContent(ref="#/components/schemas/Newsletter")
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Newsletter not found"
     *      )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'Title' => 'required',
            'Date' => 'required',
            'Active' => 'required',
        ]);

        $newsletter = new Newsletter([
            'title' => $request->get('Title'),
            'date' => $request->get('Date'),
            'active' => $request->get('Active'),
            'logo' => $request->get('Logo'),
        ]);

        // Newsletter::create($request->all());
        $newsletter->save();
        return redirect('/newsletters')->with('success', 'Newsletter saved!');
    }




/**
 * @OA\Get(
 *     path="/newsletters/{id}",
 *     summary="Get a specific newsletter",
 *     tags={"Newsletters"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the newsletter to retrieve",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/Newsletter")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Newsletter not found"
 *     )
 * )
 */
    public function show($id)
    {
        $data = DB::table('newsletters')
            ->join('articles', 'newsletters.NewsletterID', '=', 'articles.NewsletterID', 'left')
            ->select('newsletters.NewsletterID', 'newsletters.Title as NewsletterTitle', 'newsletters.Date', 'newsletters.Logo', 
            'articles.Title as ArticleTitle', 'articles.Description', 'articles.Image', 'articles.ImagePlacement')
            ->where('newsletters.NewsletterID', '=', $id)
            ->get();

        return view("newsletters.show", ['newsletters' => $data]);
    }



/**
 * @OA\Get(
 *     path="/newsletters/{id}/edit",
 *     summary="Show the form for editing a newsletter",
 *     tags={"Newsletters"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the newsletter to edit",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/Newsletter")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Newsletter not found"
 *     )
 * )
 */
    public function edit(Newsletter $id)
    {
        return view('newsletters.edit', ['newsletter'=> $id]);
    }


/**
 * @OA\Put(
 *     path="/newsletters/{newsletter}",
 *     summary="Update a newsletter",
 *     tags={"Newsletters"},
 *     @OA\Parameter(
 *         name="newsletter",
 *         in="path",
 *         description="ID of the newsletter to update",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/NewsletterUpdateRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Newsletter updated",
 *         @OA\JsonContent(ref="#/components/schemas/Newsletter")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Newsletter not found"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error"
 *     )
 * )
 */

    public function update(Request $request, Newsletter $newsletter)
{
    $request-> validate([
        'Title' => 'required',
        'Date' => 'required | date_format:Y-m-d',
        'IsActive' => 'required',
    ]);


        $newsletter->Title = $request->get('Title');
        $newsletter->Date = $request->get('Date');
        $newsletter->IsActive = $request->get('IsActive'); // this is getting interger value, 0 or 1
        $newsletter->Logo = $request->get('Logo');
        $newsletter -> save();

        return redirect('/newsletters')->with('success', 'Newsletter updated!');
    }


/**
 * @OA\Delete(
 *     path="/newsletters/{NewsletterID}",
 *     summary="Delete a newsletter",
 *     tags={"Newsletters"},
 *     @OA\Parameter(
 *         name="NewsletterID",
 *         in="path",
 *         description="ID of the newsletter to delete",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Newsletter deleted",
 *         @OA\JsonContent(ref="#/components/schemas/Newsletter")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Newsletter not found"
 *     )
 * )
 */
    public function destroy(Newsletter $NewsletterID)
    {
        //delete the newsletter
        $NewsletterID->delete();
        return redirect('/newsletters')->with('success', 'Newsletter deleted!');
    }
}
