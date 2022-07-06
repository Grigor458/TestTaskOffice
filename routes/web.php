<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubCommentsController;
use App\Http\Controllers\TagController;
use App\Models\Posts;
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

//Route::get('/', function () {
//
//    return view('index', compact('posts'));
////    ste senc ban chen grum
//});
Route::get('/', [HomeController::class, 'homepage']);
Route::middleware(['auth'])->group(function () {
    Route::resources([
        'category' => CategoryController::class,
        'post' => PostController::class,
        'tag' => TagController::class,
        'comment' => CommentController::class,
        'subcomment' => SubCommentsController::class
    ]);
    //rsursi hamar ete methodner kan vor chen ogtagorcvum gri kam only kam except

    Route::get('getPostByTags/{data}', [PostController::class, 'getPostByTags'])->name('getPostByTags');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

});


Auth::routes();


