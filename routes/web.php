<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromoteController;
use App\Http\Controllers\UserController;
use App\Models\Article;
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
    return view('admin')->with('users', Role::find(2)->users);
})
->middleware(['auth'])
->name('admin');

Route::post('/promote/{user_id}', [UserController::class, 'promote'])
    ->name('promote')
    ->middleware(['auth']);

Route::delete('/delete/{user_id}', [UserController::class, 'delete'])
    ->name('delete')
    ->middleware(['auth']);

Route::post('/create', [UserController::class, 'create'])
    ->name('user.create')
    ->middleware(['auth']);

Route::put('/edit/{user_id}', [UserController::class, 'edit'])
    ->name('edit')
    ->middleware(['auth']);

Route::get('/edit/{user_id}', function ($user_id){
    return view('edit')->with('user', User::find($user_id));
})->name('edit.show')
->middleware(['auth']);

Route::get('/news', [ArticleController::class, 'show'])->name('news');

Route::post('/news', [ArticleController::class, 'create'])->name('article.create')->middleware(['auth']);

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show')->middleware(['auth']);

Route::get('/profile/edit', function () {
    return view('profile.edit')->with('user', Auth::user());
})->name('profile.edit')->middleware(['auth']);

Route::put('/profile/save', [ProfileController::class, 'save'])->name('profile.save');

require __DIR__.'/auth.php';
