<?php

namespace App\Events;

use App\Enums\SalesListingStatus;
use App\Models\Book;
use App\Models\Order;
use App\Models\SalesListing;
use App\Models\Transaction;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PurchaseSuccessful
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $books;

    /**
     * Create a new event instance.
     */
    public function __construct(Transaction $transaction)
    {


        $orders = Order::whereTransactionId($transaction->id)->get('item_id');

        // Initialize listings
        $listings = SalesListing::whereIn('id', $orders);

        // Change the each listing status to sold
        $listings->update(['status' => SalesListingStatus::SOLD]);

        // Get the book 
        $books = Book::whereIn('id', $listings->get('book_id'));

        $this->books = $books;
    }
}
