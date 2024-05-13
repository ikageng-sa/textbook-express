<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'amount',
        'session',
    ];

    /**
     * Transaction record has items associated with it
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany;
     */
    public  function items() : HasMany
    {
        return  $this->hasMany(Order::class, 'transaction_id')
            ->select(
                'books.id as book', 'books.title', 'books.isbn', 'books.author', 'books.publisher', 'books.publication_date', 
                'books.edition', 'books.quantity', 'books.cover', 'books.language', 'books.category', 
                'sales_listings.id as listing', 'sales_listings.price', 'sales_listings.status', 'sales_listings.condition', 
                'books.reviewed_by as reviewer', 'sales_listings.seller', 
                'orders.id as order', 'orders.transaction_id as transaction', 'orders.created_at as ordered_at'
            )
            ->join('sales_listings', 'sales_listings.id','orders.item_id')
            ->join('books', 'books.id', 'sales_listings.book_id');
    }

    public function findItem($key = 'id', $value) {
        return $this->hasOne(Order::class, 'transaction_id')->where($key, $value);
    }
}
