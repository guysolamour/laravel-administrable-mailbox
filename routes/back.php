<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

Route::prefix(config('administrable.auth_prefix_path') . "/extensions/") ->middleware(['web', Str::lower(config('administrable.guard')) . '.auth'])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | EXTENSIONS -> Mailbox
    |--------------------------------------------------------------------------
    */
    Route::name(Str::lower(config('administrable.back_namespace')) . '.extensions.mailbox.mailbox.')->group(function () {
        Route::resource('mailboxes', config('administrable-mailbox.controllers.back.mailbox'))->names([
            'index'    => 'index',
            'show'     => 'show',
            'create'   => 'create',
            'store'    => 'store',
            'edit'     => 'edit',
            'update'   => 'update',
            'destroy'  => 'destroy',
        ])->except('create', 'edit', 'store', 'update');

        Route::post('/mailboxes/{mailbox}/note', [config('administrable-mailbox.controllers.back.mailbox'), 'saveNote'])->name('note.store');
        Route::put('/mailboxes/{mailbox}/note/{comment}', [config('administrable-mailbox.controllers.back.mailbox'), 'updateNote'])->name('note.update');
        Route::delete('/mailboxes/{mailbox}/note/{comment}', [config('administrable-mailbox.controllers.back.mailbox'), 'deleteNote'])->name('note.destroy');
    });


});
