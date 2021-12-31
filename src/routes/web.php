<?php

Route::post('aws/register', '\Anmup\LaravelAwsMp\AwsMpController@handle')    
        ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);