<?php

use App\Http\Controllers\DeleteController;
use App\Http\Controllers\PromoteController;
use App\Models\Role;
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

Route::post('/promote/{user_id}', [PromoteController::class, 'promote'])->name('promote')->middleware(['auth']);
Route::post('/delete/{user_id}', [DeleteController::class, 'delete'])->name('delete')->middleware(['auth']);

require __DIR__.'/auth.php';
