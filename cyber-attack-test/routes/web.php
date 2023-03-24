<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpecialpostsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('/posts',PostsController::class)->middleware(['auth','verified']);
Route::resource('/specialposts',SpecialpostsController::class)->middleware(['auth','verified','check_role:special']);

// Route::get('/', [PostsController::class,'index'])->name('posts.show');

// Route::get('/', [SpecialpostsController::class,'index'])->middleware(['auth', 'verified'])->name('specialposts.show');

// Route::get('/store', [SpecialpostsController::class,'create'])->middleware(['auth', 'verified'])->name('posts.create');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
