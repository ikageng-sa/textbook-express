<?php

namespace App\Models;

use App\Traits\FilterableByDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesListing extends Model
{
    use HasFactory, FilterableByDates;

    protected $fillable = [
        'book_id',
        'seller',
        'price',
        'condition',
        'status',
    ];
}
