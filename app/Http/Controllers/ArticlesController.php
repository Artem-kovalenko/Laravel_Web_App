<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticlesController extends Controller
{
    // We can get variable this way, if "/{article}" matches the "$article below"
    // Laravel making such request behind the scene - "Article::where('id', 1)->first();"
    // This approach will work only if names are matching
    // If we want to use not the key(1/2/3), but slug(my-first-post), we need to edit the Article associated model.
    public function show(Article $article)
    {
        // Show a single resource

        // Find the article associated with ID
        // $article = Article::find($id);

        return view('articles.show', ['article' => $article]);
    }

    public function index()
    {
        // Render a list of resources.

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

    public function edit(Article $article)
    {
        // Show a view to edit an existing resource

        // compact - function to pass the variable to view (another way)
        return view('articles.edit', compact('article'));
    }

    public function update(Article $article)
    {
        // Persist the edited resource

        request()->validate([
            // use array to pass multiple instructions - ['required', 'min: 3', 'max: 255']
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required'
        ]);

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
