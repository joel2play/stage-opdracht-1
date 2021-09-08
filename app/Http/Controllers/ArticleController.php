<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function show(){
        return view('news')->with('articles', Article::all()->sortByDesc('created_at'));
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

    public function delete($article){

        $article = Article::find($article);

        if ($article->img != null)
                Storage::delete($article->img);

        $article->delete();

        return redirect(route('news'));

    }
}
