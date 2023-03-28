<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Newsletter::all();
        return view("newsletters.index", ['newsletters' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('newsletters.create');
    }

    /**
     * Store a newly created resource in storage.
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
    // public function store(Request $request)
    // {
    //     $article = new Article();
    //     $article->Title = $request->input('title');
    //     $article->Description = $request->input('description');
    //     $article->ImagePlacement = $request->input('image_placement');
    
    //     if ($request->hasFile('image')) {
    //         $imagePath = $request->file('image')->store('public/images');
    //         $article->Image = Storage::url($imagePath);
    //     }
    
    //     $article->NewsletterID = 1; // Set a value for the NewsletterID field
    
    //     $article->save();
    
    //     return redirect()->route('articles.index')->with('success', 'Article was created successfully.');
    // }

    /**
     * Display the specified resource.
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
     * Show the form for editing the specified resource.
     */
    public function edit(Newsletter $id)
    {
        return view('newsletters.edit', ['newsletter'=> $id]);
    }
    

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(Newsletter $NewsletterID)
    {
        //delete the newsletter
        $NewsletterID->delete();
        return redirect('/newsletters')->with('success', 'Newsletter deleted!');
    }
}
