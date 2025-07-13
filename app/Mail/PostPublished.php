<?php

namespace App\Mail;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostPublished extends Mailable
{
    use Queueable, SerializesModels;

    public Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function build(): self
    {
        return $this->subject('New Post from ' . $this->post->website->name)
                    ->view('emails.post')
                    ->with([
                        'title' => $this->post->title,
                        'description' => $this->post->description,
                    ]);
    }
}
