<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Debug route for testing authentication
Route::get('/debug-auth', function () {
    if (auth()->check()) {
        return response()->json([
            'authenticated' => true,
            'user' => auth()->user()->only(['id', 'name', 'email']),
            'can_access_admin' => true
        ]);
    }
    return response()->json([
        'authenticated' => false,
        'message' => 'Not authenticated'
    ]);
})->middleware('web');
