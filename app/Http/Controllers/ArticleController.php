<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ArticleController extends Controller
{
    /**
    * @OA\Get(
    * path="/articles",
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
    * )
    */
    public function index()
    {
        $data = Article::all();
        return view("articles.index", ['articles' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * @OA\post(
     * path="/articles/store",
     * tags={"Articles"},
     * summary="Create a new article",
     * description="Create a new article",
     * operationId="store",
     * @OA\RequestBody(
     * required=true,
     * description="Pass article data",
     * @OA\JsonContent(
     * required={"title", "description", "image_placement"},
     * @OA\Property(property="title", type="string", format="text", example="Article Title"),
     * @OA\Property(property="description", type="string", format="text", example="Article Description"),
     * @OA\Property(property="image_placement", type="string", format="text", example="left"),
     * @OA\Property(property="image", type="string", format="binary", example="image.jpg"),
     * ),
     * ),
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
    public function store(Request $request)
    {
        $article = new Article();
        $article->Title = $request->input('title');
        $article->Description = $request->input('description');
        $article->ImagePlacement = $request->input('image_placement');
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $article->Image = Storage::url($imagePath);
        }
    
        $article->NewsletterID = 1; // Set a value for the NewsletterID field
    
        $article->save();
    
        return redirect()->route('articles.index')->with('success', 'Article was created successfully.');
    }

    /**
     * @OA\Get(
     * path="/articles/show/{ArticleID}",
     * tags={"Articles"},
     * summary="Get article by id",
     * description="Read article by id",
     * operationId="show",
     * @OA\Parameter(
     * name="ArticleID",
     * in="path",
     * description="ID of article to return",
     * required=true,
     * @OA\Schema(
     * type="integer",
     * format="int64"
     * )
     * ),
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
    public function show($id)
    {
        return view('articles.show', [
            'article' => Article::findOrFail($id)
        ]);
    }

    /**
     * @OA\Get(
     * path="/articles/edit/{ArticleID}",
     * tags={"Articles"},
     * summary="Get article by id",
     * description="Read article by id",
     * operationId="edit",
     * @OA\Parameter(
     * name="ArticleID",
     * in="path",
     * description="ID of article to return",
     * required=true,
     * @OA\Schema(
     * type="integer",
     * format="int64"
     * )
     * ),
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
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }
    

    /**
     * @OA\Put(
     * path="/articles/update/{ArticleID}",
     * tags={"Articles"},
     * summary="Update article by id",
     * description="Update article by id",
     * operationId="update",
     * @OA\Parameter(
     * name="ArticleID",
     * in="path",
     * description="ID of article to return",
     * required=true,
     * @OA\Schema(
     * type="integer",
     * format="int64"
     * )
     * ),
     * @OA\RequestBody(
     * required=true,
     * description="Pass article data",
     * @OA\JsonContent(
     * required={"title", "description", "image_placement"},
     * @OA\Property(property="title", type="string", format="text", example="Article Title"),
     * @OA\Property(property="description", type="string", format="text", example="Article Description"),
     * @OA\Property(property="image_placement", type="string", format="text", example="left"),
     * @OA\Property(property="image", type="string", format="binary", example="image.jpg"),
     * ),
     * ),
     * @OA\Response(
     * response=200,
     * description="successful operation"
     * ),
     * @OA\Response(
     * response=400,
     * description="Invalid status value"
     * )
     * )
     * @param Request $request Request
     * @param $id ArticleID
     * @return RedirectResponse RedirectResponse object with redirect to articles.index
     * 
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        $article->Title = $request->input('title');
        $article->Description = $request->input('description');
        $article->ImagePlacement = $request->input('image_placement');
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $article->Image = Storage::url($imagePath);
        }
    
    
        $article->save();
    
        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    /**
     * @OA\get(
     * path="/articles/destroy/{ArticleID}",
     * tags={"Articles"},
     * summary="Delete article by id",
     * description="Delete article by id",
     * operationId="destroy",
     * @OA\Parameter(
     * name="ArticleID",
     * in="path",
     * description="ID of article to return",
     * required=true,
     * @OA\Schema(
     * type="integer",
     * format="int64"
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="successful operation"
     * ),
     * @OA\Response(
     * response=400,
     * description="Invalid status value"
     * )
     * )
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $article = Article::find($id); // find article by id(article id)
        $article -> delete(); //implemented delete function

        // redirect to articles list
        return redirect() -> route('articles.index')
        -> with('success','Articles was deleted successfully');
    }
}
