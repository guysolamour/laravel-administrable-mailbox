<?php

namespace Guysolamour\Administrable\Extensions\Mailbox\Mail\Back;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Lang;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailbox;
	public $admin;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($admin, $mailbox)
    {
        $this->admin = $admin;
        $this->mailbox = $mailbox;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
		      ->from($this->mailbox->email )
		      ->subject(Lang::get('administrable-mailbox::translations.mail.back.subject') . config('app.name'))
		      ->markdown('administrable-mailbox::emails.'. Str::lower(config('administrable.back_namespace'))  .'.contact');
    }
}
