<?php

use App\Http\Controllers\DeleteController;
use App\Http\Controllers\PromoteController;
use App\Http\Controllers\UserController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
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

Route::get('/dashboard', function () {
    return view('dashboard')->with('users', Role::find(2)->users);
})->middleware(['auth'])->name('dashboard');

Route::post('/promote/{user_id}', [UserController::class, 'promote'])->name('promote')->middleware(['auth']);

Route::delete('/delete/{user_id}', [UserController::class, 'delete'])->name('delete')->middleware(['auth']);

Route::post('/create', [UserController::class, 'create'])->name('create')->middleware(['auth']);

Route::put('/edit/{user_id}', [UserController::class, 'edit'])->name('edit')->middleware(['auth']);

Route::get('/edit/{user_id}', function (Request $request, $user_id){
    // dd($request);
    return view('edit')->with('user', User::find($user_id));
})->middleware(['auth']);

require __DIR__.'/auth.php';
