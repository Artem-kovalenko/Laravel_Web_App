<?php


namespace App\Http\Controllers;


class PostsController
{
    // Access value in the URL from function params.
    // We get $post from '/post/{post}'.
    public function show($post) {
        $posts = [
            'my-first-post' => 'Hello, this is my first blog post',
            'my-second-post' => 'My second blog post'
        ];

        // Abort if post was not found
        if (!array_key_exists($post, $posts)) {
            abort(404, 'Sorry, that post was not found');
        }

        return view('post', [
            'post' => $posts[$post]
        ]);
    }
}
