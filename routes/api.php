<?php

use App\Http\Controllers\PostController;
use App\Http\Congtrollers\SubscriptionController;

Route::post('/websites/{website}/posts', [PostController::class, 'store']);
Route::post('/websites/{website}/subscribe', [SubscriptionController::class, 'subscribe']);