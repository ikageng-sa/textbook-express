<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

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
