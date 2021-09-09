<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin')->with('users', User::all());
})
    ->name('admin')
    ->middleware(['auth', 'isAdmin']);

Route::post('/promote/{user_id}', [UserController::class, 'promote'])
    ->name('promote')
    ->middleware(['auth', 'isAdmin']);

Route::post('/demote/{user_id}', [UserController::class, 'demote'])
    ->name('demote')
    ->middleware(['auth', 'isAdmin']);

Route::delete('/delete/{user_id}', [UserController::class, 'delete'])
    ->name('delete')
    ->middleware(['auth', 'isAdmin']);

Route::post('/create', [UserController::class, 'create'])
    ->name('user.create')
    ->middleware(['auth', 'isAdmin']);

Route::put('/edit/{user_id}', [UserController::class, 'edit'])
    ->name('edit')
    ->middleware(['auth', 'isAdmin']);

Route::get('/edit/{user_id}', function ($user_id){
    return view('edit')->with('user', User::find($user_id));
})->name('edit.show')
->middleware(['auth', 'isAdmin']);

Route::get('/news', [ArticleController::class, 'show'])
    ->name('news');

Route::post('/news', [ArticleController::class, 'create'])
    ->name('article.create')
    ->middleware(['auth', 'isAdmin']);

Route::delete('/news/delete/{article_id}', [ArticleController::class, 'delete'])
    ->name('article.delete')
    ->middleware(['auth', 'isAdmin']);

Route::get('/news/edit/{article_id}', [ArticleController::class, 'edit'])
    ->name('article.edit')
    ->middleware(['auth', 'isAdmin']);

Route::put('/news/save/{article_id}', [ArticleController::class, 'save'])
    ->name('article.save')
    ->middleware(['auth', 'isAdmin']);

Route::get('/profile', [ProfileController::class, 'show'])
    ->name('profile.show')
    ->middleware(['auth']);

Route::get('/profile/{user_id}', [ProfileController::class, 'watch'])
    ->name('profile.watch')
    ->middleware(['auth']);

Route::get('/profile/edit', function () {
    return view('profile.edit')->with('user', Auth::user());
})
    ->name('profile.edit')
    ->middleware(['auth']);

Route::put('/profile/save', [ProfileController::class, 'save'])
    ->name('profile.save')
    ->middleware(['auth']);

require __DIR__.'/auth.php';
