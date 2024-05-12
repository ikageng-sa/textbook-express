<?php

namespace App\Listeners;

use App\Models\Book;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateInventory
{

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $books = $event->books;
        Book::whereIn('id', $books->get('id'))->decrement('quantity', 1);
    }
}
