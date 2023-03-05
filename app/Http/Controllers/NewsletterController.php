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
    public function show($id)
    {
        $data = DB::table('newsletters')
            ->join('articles', 'newsletters.NewsletterID', '=', 'articles.NewsletterID')
            ->select('newsletters.NewsletterID', 'newsletters.Title as NewsletterTitle', 'newsletters.Date', 'newsletters.Logo', 
            'articles.Title as ArticleTitle', 'articles.Description', 'articles.Image', 'articles.ImagePlacement')
            ->where('newsletters.NewsletterID', '=', $id)
            ->get();

        return view("newsletters.show", ['newsletters' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Newsletter $newsletter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Newsletter $newsletter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Newsletter $newsletter)
    {
        //
    }
}
