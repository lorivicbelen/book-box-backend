<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Genre extends Model
{
    protected $fillable = [
        'name'
    ];

    public function books(){
        return $this->belongsToMany(Book::class);
    }
}
