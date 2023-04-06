<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsletterController extends Controller
{

    public function index()
    {
        $data = Newsletter::paginate(5);
        return view("newsletters.index", ['newsletters' => $data]);
    }

    public function create()
    {
        return view('newsletters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Title' => 'required',
            'Date' => 'required',
            'Active' => 'required',
            'Logo' => 'required',
        ]);

        $newsletter = new Newsletter([
            'Title' => $request->get('Title'),
            'Date' => $request->get('Date'),
            'Active' => $request->get('Active'),
            'Logo' => $request->get('Logo'),
        ]);

        // Newsletter::create($request->all());
        $newsletter->save();
        return redirect('/newsletters')->with('success', 'Newsletter saved!');
    }

    public function show($id)
    {
        $data = DB::table('newsletters')
            ->join('articles', 'newsletters.NewsletterID', '=', 'articles.NewsletterID', 'left')
            ->select(
                'newsletters.NewsletterID',
                'newsletters.Title as NewsletterTitle',
                'newsletters.Date',
                'newsletters.Logo',
                'articles.Title as ArticleTitle',
                'articles.Description',
                'articles.Image',
                'articles.ImagePlacement'
            )
            ->where('newsletters.NewsletterID', '=', $id)
            ->get();

        return view("newsletters.show", ['newsletters' => $data]);
    }

    public function showLatestNewsletter()
    {
        $data = DB::table('newsletters')
        ->join('articles', 'newsletters.NewsletterID', '=', 'articles.NewsletterID', 'left')
        ->select(
            'newsletters.NewsletterID',
            'newsletters.Title as NewsletterTitle',
            'newsletters.Date',
            'newsletters.Logo',
            'articles.Title as ArticleTitle',
            'articles.Description',
            'articles.Image',
            'articles.ImagePlacement'
        )
        ->where('newsletters.IsActive', '=', 1) // Add condition for active newsletter
        ->orderBy('newsletters.Date', 'desc')
        ->distinct()
        ->limit(1)
        ->get()
        ->toArray();

        return view("dashboard", ['latestNewsletter' => $data]);
    }

    public function edit($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        return view('newsletters.edit', ["newsletter" => $newsletter, "url" => url()->previous()]);
    }


    public function update(Request $request, $id)
    {
        $newsletter = Newsletter::findOrfail($id);
        $request->validate([
            'Title' => 'required',
            'Date' => 'required | date_format:Y-m-d',
            'Logo' => 'required',
        ]);

        $newsletter->Title = $request->get('Title');
        $newsletter->Date = $request->get('Date');
        $newsletter->IsActive = $request->get('IsActive') === 'on' ? 1 : 0; // convert 'on' to 1, and other values to 0
        $newsletter->Logo = $request->get('Logo');
        $newsletter->save();

        if ($request->input('url') && str_contains($request->input('url'), "search")) {
            return redirect($request->input('url'))->with('success','Newsletter was updated successfully.');
        }    

        return redirect('/newsletters')->with('success', 'Newsletter updated!');
    }



    public function destroy($id, Newsletter $newsletter)
    {
        //delete the newsletter
        $newsletter = Newsletter::find($id);

        if ($newsletter) {
            DB::table('articles')
            ->where('NewsletterID', '=', $id)
            ->update(['NewsletterID' => null]);

            $newsletter->delete();
        }

        if (str_contains(url()->previous(), "search")) {
            return redirect(url()->previous())->with('success', 'Newsletter deleted!');
        }

        return redirect('/newsletters')->with('success', 'Newsletter deleted!');
    }
}
