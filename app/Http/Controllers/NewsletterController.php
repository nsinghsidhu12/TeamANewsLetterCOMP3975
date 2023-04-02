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

    public function edit(Newsletter $id)
    {
        return view('newsletters.edit', ['newsletter' => $id]);
    }


    public function update(Request $request, Newsletter $newsletter)
    {
        $request->validate([
            'Title' => 'required',
            'Date' => 'required | date_format:Y-m-d',
        ]);

        $newsletter->Title = $request->get('Title');
        $newsletter->Date = $request->get('Date');
        $newsletter->IsActive = $request->get('IsActive') === 'on' ? 1 : 0; // convert 'on' to 1, and other values to 0
        $newsletter->Logo = $request->get('Logo');
        $newsletter->save();

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

        return redirect('/newsletters')->with('success', 'Newsletter deleted!');
    }
}
