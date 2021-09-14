<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Landing page
Route::get('/', function () { return view('welcome'); });

// Admin routes

// Admin User routes
Route::get('/admin', function () { return view('user.show')->with('users', User::all()); })
    ->name('user.show')
    ->middleware(['auth', 'isAdmin']);

Route::get('/user/create', function (){ return view('user.create'); })
    ->name('user.create')
    ->middleware(['auth', 'isAdmin']);

Route::post('/user/promote/{user_id}', [UserController::class, 'promote'])
    ->name('user.promote')
    ->middleware(['auth', 'isAdmin']);

Route::post('/user/demote/{user_id}', [UserController::class, 'demote'])
    ->name('user.demote')
    ->middleware(['auth', 'isAdmin']);

Route::delete('/user/delete/{user_id}', [UserController::class, 'delete'])
    ->name('user.delete')
    ->middleware(['auth', 'isAdmin']);

Route::post('/user/insert', [UserController::class, 'create'])
    ->name('user.insert')
    ->middleware(['auth', 'isAdmin']);

Route::put('/user/edit/{user_id}', [UserController::class, 'edit'])
    ->name('user.edit')
    ->middleware(['auth', 'isAdmin']);

Route::get('/user/edit/{user_id}', function ($user_id){
    return view('user.edit')->with('user', User::find($user_id));
})  ->name('user.edit.show')
    ->middleware(['auth', 'isAdmin']);

// News page
Route::get('/news', [ArticleController::class, 'show'])
    ->name('news')
    ->middleware(['auth']);

// Admin Article routes
Route::post('/article.save', [ArticleController::class, 'create'])
    ->name('article.save')
    ->middleware(['auth', 'isAdmin']);

Route::delete('/article/delete/{article_id}', [ArticleController::class, 'delete'])
    ->name('article.delete')
    ->middleware(['auth']);

Route::get('/article/edit/{article_id}', [ArticleController::class, 'edit'])
    ->name('article.edit')
    ->middleware(['auth']);

Route::post('/article/create', [ArticleController::class, 'create'])
    ->name('article.create')
    ->middleware(['auth']);

Route::get('/article/create', function () { return view('news.create'); })
    ->name('article.create')
    ->middleware(['auth']);

Route::get('/admin/articles', function () { return view('admin.news')->with('articles', Article::all()); })
    ->name('articles.show')
    ->middleware(['auth', 'isAdmin']);

Route::put('/article/save/{article_id}', [ArticleController::class, 'save'])
    ->name('article.save')
    ->middleware(['auth']);

// Profile routes
Route::get('/profile', [ProfileController::class, 'show'])
    ->name('profile.show')
    ->middleware(['auth']);

Route::get('/profile/edit', function () {
    return view('profile.edit')->with('user', Auth::user());
})  ->name('profile.edit')
    ->middleware(['auth']);

Route::get('/profile/{user_id}', [ProfileController::class, 'watch'])
    ->name('profile.watch')
    ->middleware(['auth']);

Route::put('/profile/save', [ProfileController::class, 'save'])
    ->name('profile.save')
    ->middleware(['auth']);

require __DIR__.'/auth.php';
