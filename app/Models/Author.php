<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Author extends Model
{
    protected $fillable = [
        'name',
        'bio'
    ];

    public function books(){
        return $this->hasMany(Book::class);
    }
}
