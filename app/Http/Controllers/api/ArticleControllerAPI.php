<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ArticleControllerAPI extends Controller
{
    /**
     * @OA\Get(
     * path="/api/articles/apiindex",
     * tags={"Articles"},
     * summary="Get all articles",
     * description="Read all the articles in the database",
     * operationId="index",
     * @OA\Response(
     * response=200,
     * description="successful operation"
     * ),
     * @OA\Response(
     * response=400,
     * description="Invalid status value"
     * )
     * )s
     */
    public function articlesindexapi()
    {
        // Get all articles and return them as a json object
        $articles = DB::table('articles')
            ->select(
                'articles.ArticleID',
                'articles.Title',
                'articles.Description',
                'articles.Image',
                'articles.ImagePlacement',
                'articles.NewsletterID',
                'articles.CreatedAt',
                'articles.UpdatedAt'
            )
            ->get();
        return $articles;
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $Article)
    {
        return $Article;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $Article)
    {
        // delete an article
        $Article = $Article->delete();
        if ($isSuccess) {
            return response()->json([
                'message' => 'Article deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Article not deleted'
            ], 400);
        }
    }
}
