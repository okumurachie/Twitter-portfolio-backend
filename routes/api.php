<?php

use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;

Route::get('/ping', function () {
    return response()->json([
        'message' => 'API working'
    ]);
});

Route::middleware('auth.firebase')->group(function () {

    Route::get('/user', function (Request $request) {
        return response()->json([
            'uid' => $request->user()->firebase_uid,
        ]);
    });

    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts', [PostController::class, 'index']);
});
