<?php

namespace App\Listeners;

use App\Events\PostStatusChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostStatusUpdated
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostStatusChanged $event): void
    {
        $event->post->status = $event->status;
        $event->post->save();
    }
}
