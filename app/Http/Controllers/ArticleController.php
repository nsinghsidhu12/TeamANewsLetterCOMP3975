<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Newsletter;

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
        $newsletters = Newsletter::all(['NewsletterID', 'Title']);
        return view('articles.create', compact('newsletters'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required_if:image_placement,Left,Right',
        ]);

        $article = new Article();
        $article->Title = $request->input('title');
        $article->Description = $request->input('description');
        $article->Image = $request->input('image');

        if ($request->input('image') && $request->input('image_placement') === 'None') {
            $article->ImagePlacement = 'Left';
        }

        $article->ImagePlacement = $request->input('image_placement');

        $article->NewsletterID = $request->input('newsletter_id'); // Retrieve the selected NewsletterID
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
        $newsletters = Newsletter::all(['NewsletterID', 'Title']);
        $url= url()->previous();
        return view('articles.edit', ["article" => $article, "newsletters" => $newsletters, "url" => $url]);
    }

    public function update(Request $request, $id)
{

    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'image' => 'required_if:image_placement,Left,Right',
    ]);


    $article = Article::findOrFail($id);
    $article->Title = $request->input('title');
    $article->Description = $request->input('description');
    $article->Image = $request->input('image');
    $article->ImagePlacement = $request->input('image_placement');

    if ($request->input('image') && $request->input('image_placement') === 'None') {
        $article->ImagePlacement = 'Left';
    }

    $article->NewsletterID = $request->input('newsletter_id');
    $article->save();

    if ($request->input('url') && str_contains($request->input('url'), "search")) {
        return redirect($request->input('url'))->with('success','Article was updated successfully.');
    }

    return redirect()->route('articles.index')->with('success', 'Article was updated successfully.');
}

    public function destroy($id): RedirectResponse
    {
        $article = Article::find($id); // find article by id(article id)
        $article->delete(); //implemented delete function

        if (str_contains(url()->previous(), "search")) {
            return redirect(url()->previous())->with('success','Article was deleted successfully');
        }

        // redirect to articles list
        return redirect() -> route('articles.index')
        -> with('success','Article was deleted successfully');
    }
}

