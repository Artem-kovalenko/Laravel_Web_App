<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticlesController extends Controller
{
    public function show($id)
    {
        // Render a list of resources.

        $article = Article::find($id);

        return view('articles.show', ['article' => $article]);
    }

    public function index()
    {
        // Show a single resource

        $articles = Article::latest()->get();

        return view('articles.index', ['articles' => $articles]);
    }

    public function create()
    {
        // Show a view to create a new resource

        return view('articles.create');

    }

    public function store()
    {
        // Persist the new resource

        request()->validate([
            // use array to pass multiple instructions - ['required', 'min: 3', 'max: 255']
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required'
        ]);

        $article = new Article();
        $article->title = request('title');
        $article->excerpt = request('excerpt');
        $article->body = request('body');
        $article->save();

        return redirect('/articles');
    }

    public function edit($id)
    {
        // Show a view to edit an existing resource

        // Find the article associated with ID
        $article = Article::find($id);

        // compact - function to pass the variable to view (another way)
        return view('articles.edit', compact('article'));
    }

    public function update($id)
    {
        // Persist the edited resource

        request()->validate([
            // use array to pass multiple instructions - ['required', 'min: 3', 'max: 255']
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required'
        ]);

        $article = Article::find($id);
        $article->title = request('title');
        $article->excerpt = request('excerpt');
        $article->body = request('body');
        $article->save();

        return redirect('/articles/' . $article->id);

    }

    public function destroy()
    {
        // Delete the resource

    }

}
