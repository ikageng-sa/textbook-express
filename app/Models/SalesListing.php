<?php

namespace App\Models;

use App\Traits\FilterableByDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesListing extends Model
{
    use HasFactory, FilterableByDates, SoftDeletes;

    protected $fillable = [
        'book_id',
        'seller',
        'price',
        'condition',
        'status',
    ];
}
