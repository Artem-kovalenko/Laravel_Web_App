<?php


namespace App\Http\Controllers;

use App\Models\Post;


class PostsController
{
    // Access value in the URL from function params.
    // We get $slug from '/post/{post}'.
    public function show($slug) {

        return view('post', [
            'post' => Post::where('slug', $slug)->firstOrFail()
        ]);
    }
}
