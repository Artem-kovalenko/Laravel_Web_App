<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ArticlesController;

use App\Models\Article;
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

Route::get('/about', function () {

//    $article = Article::take(2)->get();              - Take 2
//    $article = Article::latest()->get();             - Take the latest
//    $article = Article::latest('created_at')->get(); - Order by time
//    $article = Article::paginate(2);                 - Out of the box pagination
//    $article = Article::all();                       - Take all

    return view('about', [
        'articles' => Article::take(3)->latest()->get() // TAKE 3 MOST RECENT ARTICLES
    ]);
});


Route::get('/articles', [ArticlesController::class, 'index'])->name('articles.index');
Route::post('/articles', [ArticlesController::class, 'store']);
// Order matters! Need to put "create" endpoint above the "get" to avoid errors.
Route::get('/articles/create', [ArticlesController::class, 'create']);
// Named routes - avoid hardcode routes (to change them in future).
Route::get('/articles/{article}', [ArticlesController::class, 'show'])->name('articles.show');
Route::get('/articles/{article}/edit', [ArticlesController::class, 'edit']);
Route::put('/articles/{article}', [ArticlesController::class, 'update']);



// To get variable from URL by (?=VARIABLE) and pass it to VIEW.
// Use request global method.
Route::get('/test', function () {
    return view('test', [
        'name' => request('name')
    ]);
});

// To use unique ID/slug in the URL.
// {} - anything in the braces.
// Access value in the URL from function params
/* Route::get('/post/{post}', function ($post) {
    $posts = [
        'my-first-post' => 'Hello, this is my first blog post',
        'my-second-post' => 'My second blog post'
    ];

    // Abort if post was not found
    if (!array_key_exists($post, $posts)) {
        abort(404, 'Sorry, that post was not found');
    }

    return view('post', [
        'post' => $posts[$post]w
    ]);
});  */

// Controllers (Another way)
Route::get('/post/{post}', [PostsController::class, 'show']);

