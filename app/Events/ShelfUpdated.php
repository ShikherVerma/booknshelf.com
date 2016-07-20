<?php

namespace App\Events;

use App\Events\Event;
use App\Shelf;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ShelfUpdated extends Event
{
    use SerializesModels;

    public $shelf;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Shelf $shelf)
    {
        $this->shelf = $shelf;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
