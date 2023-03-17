<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Newsletter;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        if ($request->get('search')) {
            $newsletters = Newsletter::search($request->search)->get();
            $articles = Article::search($request->search)->get();
        } else {
            $newsletters = null;
            $articles = null;
        }

        return view('search.index', ['newsletters' => $newsletters, 'articles' => $articles]);
    }
}
