<?php

namespace App\Listeners;

use App\Models\Book;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddToInventory
{
    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $book = $event->book;

        Book::find($book->book_id)->increment('quantity', 1);
    }
}
