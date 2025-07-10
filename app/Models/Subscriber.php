<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = ['email'];

    public function websites()
    {
        return $this->belongsToMany(Website::class, 'subscriptions');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_subscriber')->withTimestamps()->withPivot('sent_at');
    }
}
