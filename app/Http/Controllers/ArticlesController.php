<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;

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
        if (request('tag')) {
            $articles = Tag::where('name', request('tag'))->firstOrFail()->articles;
        } else {
            $articles = Article::latest()->get();
        }

        return view('articles.index', ['articles' => $articles]);
    }

    public function create()
    {
        // Show a view to create a new resource

        return view('articles.create', [
            'tags' => Tag::all()
        ]);
    }

    public function store()
    {
        // Persist the new resource

        // $article = new Article();
        // $article->title = request('title');
        // $article->excerpt = request('excerpt');
        // $article->body = request('body');
        //$article->save();

        // To avoid the error need to protect variables in the model
        //! "request()->validate" in "validateArticle" function returns array of validated values used to ::create article.
        $this->validateArticle();

        $article = new Article(request(['title', 'excerpt', 'body']));
        $article->user_id = 1; // hardcode because we do not have auth
        $article->save();

        // to add (attach) array of tag ids to the article
        $article->tags()->attach(request('tags'));

        return redirect(route('articles.index'));
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

        $article->update($this->validateArticle());

        // return redirect('/articles/' . $article->id);
        return redirect(route('article.show', $article));
    }

    public function destroy()
    {
        // Delete the resource

    }

    // function to reduce duplication of validation code
    protected function validateArticle()
    {
        return request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            // sql will perform a query to make sure that everything is okay
            'tags' => 'exists:tags,id'
        ]);
    }
}
