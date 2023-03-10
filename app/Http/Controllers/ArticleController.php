<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('articles.show', [
            'article' => Article::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
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
