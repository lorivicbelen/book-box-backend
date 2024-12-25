<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use app\Models\Genre;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    public function books() {
        return $this->hasMany(Book::class);
    }
}
