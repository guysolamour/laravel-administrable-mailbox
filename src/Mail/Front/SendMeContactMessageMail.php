<?php

namespace Guysolamour\Administrable\Extensions\Mailbox\Mail\Front;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Lang;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMeContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(Lang::get('administrable-mailbox::translations.mail.front.subject') . config('app.name'))
            ->markdown('administrable-mailbox::emails.'. Str::lower(config('administrable.front_namespace')) .'.sendmessagecopy');
    }
}
