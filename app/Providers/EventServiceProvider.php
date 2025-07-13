<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\PostCreated;
use App\Listeners\SendPostToSubscribers;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        PostCreated::class => [
            SendPostToSubscribers::class,
        ],
    ];
    
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
