<?php

namespace App\Events;

use App\Models\SalesListing;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookListedSuccessfully
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $book;

    /**
     * Create a new event instance.
     */
    public function __construct(SalesListing $book)
    {
        $this->book = $book;
    }

}
