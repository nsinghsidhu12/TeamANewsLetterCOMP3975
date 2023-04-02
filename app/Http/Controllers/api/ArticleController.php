<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
     /**
     * @OA\Get(
     * path="/api/articles",
     * tags={"Articles"},
     * summary="Get all the articles",
     * description="Get all the articles in the database",
     * operationId="articlesIndex",
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
    public function articlesIndex()
    {
        return Article::all();
    }

    /**
     * @OA\Get(
     * path="/api/articles/{ArticleID}",
     * operationId="articlesShow",
     * tags={"Articles"},
     * summary="Get an article's information",
     * description="Get an article's information from the database",
     * @OA\Parameter(
     * name="ArticleID",
     * description="The ID of an article",
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
    public function articlesShow($id)
    {
        return Article::findOrFail($id);
    }

    /**
     * @OA\Post(
     * path="/api/articles",
     * operationId="articlesStore",
     * tags={"Articles"},
     * summary="Add an article",
     * description="Add an article to the database",
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(ref="#/components/schemas/Article")
     * ),
     * @OA\Response(
     * response=201,
     * description="Successful operation",
     * @OA\JsonContent(ref="#/components/schemas/Article")
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
    public function articlesStore(Request $request)
    {
        request()->validate([
            'Title' => 'required',
            'Description' => 'required',
        ]);

        return Article::create([
            'NewsletterID' => request('NewsletterID'),
            'Title' => request('Title'),
            'Description' => request('Description'),
            'Image' => request('Image'),
            'ImagePlacement' => request('ImagePlacement'),
        ]);
    }

    /**
     * @OA\Put(
     * path="/api/articles/{ArticleID}",
     * operationId="articlesUpdate",
     * tags={"Articles"},
     * summary="Update an existing articles's information",
     * description="Update an existing article's information in the database",
     * @OA\Parameter(
     * name="ArticleID",
     * description="The ID of a article",
     * required=true,
     * in="path",
     * @OA\Schema(
     * type="integer"
     * )
     * ),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(ref="#/components/schemas/Article")
     * ),
     * @OA\Response(
     * response=202,
     * description="Successful operation",
     * @OA\JsonContent(ref="#/components/schemas/Article")
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
    public function articlesUpdate(Request $request, $id)
    {
        request()->validate([
            'Title' => 'required',
            'Description' => 'required',
        ]);

        $article = Article::find($id);

        $isSuccess = $article->update([
            'NewsletterID' => request('NewsletterID'),
            'Title' => request('Title'),
            'Description' => request('Description'),
            'Image' => request('Image'),
            'ImagePlacement' => request('ImagePlacement'),
        ]);

        return [
            'success' => $isSuccess
        ];
    }

    /**
     * @OA\Delete(
     * path="/api/articles/{ArticleID}",
     * operationId="articlesDelete",
     * tags={"Articles"},
     * summary="Delete an existing article",
     * description="Deletes an existing article in the database",
     * @OA\Parameter(
     * name="ArticleID",
     * description="The ID of a article",
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
    public function articlesDelete($id, Article $article)
    {
        $article = Article::find($id);

        if ($article) {
            $isSuccess = $article->delete();
        } else {
            $isSuccess = False;
        }

        return [
            'success' => $isSuccess
        ];
    }
}
