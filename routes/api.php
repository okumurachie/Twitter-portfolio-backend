<?php

use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return response()->json([
        'message' => 'API working'
    ]);
});
Route::middleware('auth.firebase')->get('/user', function (Request $request) {
    return response()->json([
        'uid' => $request->get('firebase_uid'),
    ]);
});
