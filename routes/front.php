<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;



Route::name(Str::lower(config('administrable.front_namespace') . '.'))->middleware('web')->group(function (){
    /*
    |--------------------------------------------------------------------------
    | EXTENSIONS -> Mailbox
    |--------------------------------------------------------------------------
    */
    Route::get('/contact', [config('administrable-mailbox.controllers.front.mailbox'), 'create'])->name('extensions.mailbox.mailbox.create');
    Route::post('/contact', [config('administrable-mailbox.controllers.front.mailbox'), 'store'])->name('extensions.mailbox.mailbox.store')->middleware(ProtectAgainstSpam::class);

});

