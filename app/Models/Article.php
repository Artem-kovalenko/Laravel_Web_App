<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // --- Overwrite the method to use slug instead of key(id)

    //    public function getRouteKeyName()
    //    {
    //        // Laravel will do this - "Article::where('slug', $article)->first()"
    //        return 'slug';
    //    }


    // --- Protect variables

    protected $fillable = ['title', 'excerpt', 'body'];

    // use this to NOT guard anything and make all by your own
    // protected $guarded = [];
}
