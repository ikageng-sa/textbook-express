<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    use HasFactory;

    private $order;
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
        return  $this->hasMany(Cart::class, 'transaction_id')
            ->select(
                'books.id as book', 'books.title', 'books.isbn', 'books.author', 'books.publisher', 'books.publication_date', 
                'books.edition', 'books.quantity', 'books.cover', 'books.language', 'books.category', 
                'sales_listings.id as listing', 'sales_listings.price', 'sales_listings.status', 'sales_listings.condition', 
                'books.reviewed_by as reviewer', 'sales_listings.seller', 
                'carts.id as order', 'carts.transaction_id as transaction', 'carts.created_at as ordered_at'
            )
            ->join('sales_listings', 'sales_listings.id','carts.item_id')
            ->join('books', 'books.id', 'sales_listings.book_id');
    }

    /**
     * Find item associated with the transaction
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasOne;
     */
    public function findItem($value, $key = 'id') : HasOne
    {
        return $this->hasOne(Cart::class, 'transaction_id')->where($key, $value);
    }

    /**
     * Transaction record a order record associated with it
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasOne;
     */
    public function order() : HasOne
    {
        return $this->hasOne(Order::class, 'transaction_id');
    }

    /**
     * Transaction record a order record associated with it
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasOne;
     */
    public function orderWithDetails() : HasOne
    {
        return $this->hasOne(Order::class, 'transaction_id')
        ->select('addresses.*', 'delivery_methods.*', 'provinces.name as province')
        ->join('addresses', 'addresses.id', 'orders.address_id')
        ->join('delivery_methods', 'delivery_methods.id', 'orders.delivery_method_id')
        ->join('provinces', 'provinces.id', 'addresses.province_id');
    }

}
