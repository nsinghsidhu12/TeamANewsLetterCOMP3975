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
    // public function create()
    // {
    //     return view('articles.create');
    // }

    public function create()
    {
        $newsletters = Newsletter::all(['NewsletterID', 'Title']);
        return view('articles.create', compact('newsletters'));
    }


    public function store(Request $request)
    {
        $article = new Article();
        $article->Title = $request->input('title');
        $article->Description = $request->input('description');
        $article->Image = $request->input('Image');
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
        return view('articles.edit', compact('article', 'newsletters'));
    }

    public function update(Request $request, $id)
{
    $article = Article::findOrFail($id);
    $article->Title = $request->input('title');
    $article->Description = $request->input('description');
    $article->Image = $request->input('Image');
    $article->ImagePlacement = $request->input('image_placement');
    $article->NewsletterID = $request->input('newsletter_id');
    $article->save();

    return redirect()->route('articles.index')->with('success', 'Article was updated successfully.');
}

    // public function update(Request $request, $id)
    // {
    //     $article = Article::findOrFail($id);
    //     $article->update([
    //         'Title' => $request->input('title'),
    //         'Description' => $request->input('description'),
    //         'Image' => $request->input('Image'),
    //         'ImagePlacement' => $request->input('image_placement')
    //     ]);
        
    //     $newsletterId = $request->input('newsletter_id');
    //     if ($newsletterId) {
    //         $article->attachToNewsletter($newsletterId);
    //     }
        
    //     return redirect()->route('articles.index')->with('success','Article updated successfully');
    // }

    public function destroy($id): RedirectResponse
    {
        $article = Article::find($id); // find article by id(article id)
        $article -> delete(); //implemented delete function

        // redirect to articles list
        return redirect() -> route('articles.index')
        -> with('success','Articles was deleted successfully');
    }
}

