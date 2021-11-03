<?php

namespace Guysolamour\Administrable\Extensions\Mailbox\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Guysolamour\Administrable\Traits\FormBuilderTrait;
use Guysolamour\Administrable\Http\Controllers\BaseController;

class ContactController extends BaseController
{
    use FormBuilderTrait;

    public function create()
    {
        $form = $this->getForm(new (config('administrable-mailbox.models.mailbox')), config('administrable-mailbox.forms.front.mailbox'), false);

        $page = get_meta_page('contact');

        return front_view('extensions.mailboxes.create', compact('form', 'page'));
    }

    public function store(Request $request)
    {
        $form = $this->getForm( new (config('administrable-mailbox.models.mailbox')), config('administrable-mailbox.forms.front.mailbox'), false );
        $form->redirectIfNotValid();

        $mailbox = config('administrable-mailbox.models.mailbox')::create( $request->all() );

        if($request->get('send_copy')){
            $mail = config('administrable-mailbox.mails.front.sendme_mail');
            Mail::to($mailbox->email)->send(new $mail($mailbox));
        }

        $notification = config('administrable-mailbox.notifications.back.mailbox');
        Notification::send(get_guard_notifiers(), new $notification($mailbox));

        if ($request->ajax()) {
            return response()->json(['sucess' => Lang::get('administrable-mailbox::translations.controller.create')]);
        }

        flashy( Lang::get('administrable-mailbox::translations.controller.create') );

        return back();
    }
}
