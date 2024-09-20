<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\PostController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// create posts
Route::prefix('v1')->as('v1.')->group(function() {
    Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');


    Route::post('issue-token', function() {

        $email = 'blittel@example.net';
        $password = 'password';

        $user = User::where('email', $email)->first();

        if (! $user || ! Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken('token')->plainTextToken;

    });

    Route::post('revoke-token', function() {

        $email = 'blittel@example.net';
        $password = 'password';

        $user = User::where('email', $email)->first();

        $user->tokens()->where('id', 1)->delete();

        return 'revoked';

    })->middleware('auth:sanctum');

});
