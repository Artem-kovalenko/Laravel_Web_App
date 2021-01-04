<?php


namespace App\Http\Controllers;

use DB;


class PostsController
{
    // Access value in the URL from function params.
    // We get $slug from '/post/{post}'.
    public function show($slug) {

        $post = DB::table('posts')->where('slug', $slug)->first();

        if (! $post) {
            abort(404);
        }

        return view('post', [
            'post' => $post
        ]);
    }
}
