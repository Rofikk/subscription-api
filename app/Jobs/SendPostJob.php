<?php

namespace App\Jobs;

use App\Mail\PostPublished;
use App\Models\Post;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Post $post;
    protected Subscriber $subscriber;

    /**
     * Create a new job instance.
     */
    public function __construct(Post $post, Subscriber $subscriber)
    {
        $this->post = $post;
        $this->subscriber = $subscriber;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Cegah duplikat pengiriman
        if (!$this->post->subscribers()->where('subscriber_id', $this->subscriber->id)->exists()) {
            return;
        }
            
        // Kirim email
        Mail::to($this->subscriber->email)->queue(new PostPublished($this->post));

        // Catat sebagai sudah dikirim
        $this->post->subscribers()->attach($this->subscriber->id, [
            'sent_at' => now(),
        ]);
    }
}
