<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class ArticleController extends Controller
{

    public function index()
    {
        $data = Article::paginate(5);
        return view("articles.index", ['articles' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $article = new Article();
        $article->Title = $request->input('title');
        $article->Description = $request->input('description');
        $article->Image = $request->input('Image');
        $article->ImagePlacement = $request->input('image_placement');
        $article->NewsletterID = 1; // Set a value for the NewsletterID field
        $article->save();
    
        return redirect()->route('articles.index')->with('success', 'Article was created successfully.');
    }

    
    public function show($id)
    {
        return view('articles.show', [
            'article' => Article::findOrFail($id)
        ]);
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        $article->Title = $request->input('title');
        $article->Description = $request->input('description');
        $article->ImagePlacement = $request->input('image_placement');
        $article->Image = $request->input('Image');
        $article->save();
    
        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    public function destroy($id): RedirectResponse
    {
        $article = Article::find($id); // find article by id(article id)
        $article -> delete(); //implemented delete function

        // redirect to articles list
        return redirect() -> route('articles.index')
        -> with('success','Articles was deleted successfully');
    }
}
