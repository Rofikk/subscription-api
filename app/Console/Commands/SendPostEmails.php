<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendPostEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:post-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send new post emails to subscribers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Checking new posts to send...");

        // Ambil semua postingan
        $posts = Post::with('website', 'subscribers')->get();

        foreach ($posts as $post) {
            $subscribers = $post->website->subscribers;

            foreach ($subscribers as $subscriber) {
                // Cek apakah sudah pernah dikirim
                $alreadySent = $post->subscribers()->where('subscriber_id', $subscriber->id)->exists();

                if (!$alreadySent) {
                    // Kirim email
                    Mail::to($subscriber->email)->queue(new \App\Mail\PostPublished($post));

                    // Catat ke post_subscriber
                    $post->subscribers()->attach($subscriber->id, [
                        'sent_at' => now(),
                    ]);

                    $this->info("Email sent to: {Subscriber->email} for post '{$post->title}'");
                }
            }
        }

        $this->info("Finished sending post emails.");
        return 0;
    }
}
