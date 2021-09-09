<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function show(){
        return view('news.show')->with('articles', Article::all()->sortByDesc('created_at'));
    }

    public function create(Request $request){
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'img' => 'image'
        ]);

        
        $article = Article::create([
            'intro' => $request->input('intro'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
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
            $article->img = $request->img->store('images/artciles');
            Storage::delete($article->img);
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
