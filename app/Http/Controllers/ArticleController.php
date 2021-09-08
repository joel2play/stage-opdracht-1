<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function show(){
        return view('news')->with('articles', Article::all()->sortByDesc('created_at'));
    }

    public function create(Request $request){
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'img' => 'mimes:jpg'
        ]);

        $article = Article::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => Auth::user()->id,
        ]);

        $request->img->store('images/articles');

        return redirect('/news');
    }
}
