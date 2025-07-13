<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Jobs\SendPostJob;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPostToSubscribers implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(PostCreated $event): void
    {
        $post = $event->post;
        $website = $post->website;

        // Proses subscriber dalam bentuk chunk (100 per batch)
        $website->subscribers()->lazyById(100)->each(function ($subscribers) use ($post) {
            // Kirim job ke queue
            SendPostJob::dispatch($post, $subscriber);
        });
    }
}
