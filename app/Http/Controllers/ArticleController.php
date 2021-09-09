<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function show(){

        // dd(Article::find(1)->start_date <= Date::create('2021', '1', '2') && Article::find(1)->end_date >= Date::now());
        $articles = Article::where([
                ['start_date', '<=', Date::now()],
                ['end_date', '>=', Date::now()]
            ]
        )->get();

        return view('news.show')->with('articles', $articles);
    }

    public function create(Request $request){
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'img' => 'image',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
        
        $article = Article::create([
            'intro' => $request->input('intro'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'start_date' => Carbon::parse($request->input('start_date')),
            'end_date' => Carbon::parse($request->input('end_date')),
            'user_id' => Auth::user()->id,
        ]);

        if ($request->has('img')){
            $filename = $request->img->store('images/articles');
            $article->img = $filename;
        }


        $article->save();        

        return redirect('/news');
    }

    public function edit($article_id){
        return view('news.edit')->with('article', Article::find($article_id));
    }

    public function save(Request $request, $article_id){
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'img' => 'image'
        ]);

        $article = Article::find($article_id);

        $article->title = $request->input('title');
        $article->intro = $request->input('intro');
        $article->content = $request->input('content');

        if ($request->img){
            Storage::delete($article->img);
            $article->img = $request->img->store('images/articles');
        } elseif (!$request->has('keep_image')) {
            $article->img = null;
            Storage::delete($article->img);
        }

        $article->save();

        return redirect('/news');

    }

    public function delete($article_id){

        $article = Article::find($article_id);

        if ($article->img != null)
                Storage::delete($article->img);

        $article->delete();

        return redirect(route('news'));

    }
}
