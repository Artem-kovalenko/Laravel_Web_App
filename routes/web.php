<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
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

