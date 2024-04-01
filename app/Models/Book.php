<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'author', 
        'isbn', 
        'edition', 
        'publisher', 
        'publication_date', 
        'category', 
        'language',
        'tags', 
        'reviewed_by',
        'description',
        'cover',
        'added_by',
    ];
}
