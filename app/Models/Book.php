<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use App\Models\Category;
use App\Models\Genre;

class Book extends Model
{
    protected $fillable = [
        'title',
        'description',
        'author_id',
        'category_id',
        'cover_photo'
    ];

    public function author() {
        return $this->belongsTo(Author::class);
    }
    
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function genres() {
        return $this->belongsToMany(Genre::class);
    }
}
