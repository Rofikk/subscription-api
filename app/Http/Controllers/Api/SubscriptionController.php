<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use App\Models\Website;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request, Website $website)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $subscriber = Subscriber::firstOrCreate([
            'email' => $request->email
        ]);

        // Cek jika sudah subscribe
        if ($website->subscribers()->where('subscriber_id', $subscriber->id)->exists()) {
            return response()->json([
                'message' => 'Already subscribed to this website.'
            ], 200);
        }

        $website->subscribers()->attach($subscriber->id);

        return response()->json([
            'message' => 'Subscribed successfully'
        ], 201);
    }
}
