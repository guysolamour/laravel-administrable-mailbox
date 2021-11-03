<?php

namespace Guysolamour\Administrable\Extensions\Mailbox\Http\Controllers\Back;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Guysolamour\Administrable\Http\Controllers\BaseController;

class MailboxController extends BaseController
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $mailboxes = config('administrable-mailbox.models.mailbox')::last()->get();

        $unread = config('administrable-mailbox.models.mailbox')::unRead()->count();

        return view('administrable-mailbox::' . Str::lower(config('administrable.back_namespace')) . '.mailboxes.index', compact('mailboxes', 'unread'));
    }


    /**
    * Display the specified resource.
    *
    * @param  string  $slug
    * @return \Illuminate\Http\Response
    */
    public function show(string $slug)
    {
        $mailbox = config('administrable-mailbox.models.mailbox')::where('slug', $slug)->firstOrFail();

        $mailbox->markAsRead();

        return view('administrable-mailbox::' . Str::lower(config('administrable.back_namespace')) . '.mailboxes.show', compact('mailbox'));
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  string $slug
    * @return \Illuminate\Http\Response
    */
    public function destroy(string $slug)
    {
        $mailbox = config('administrable-mailbox.models.mailbox')::where('slug', $slug)->firstOrFail();

        $mailbox->delete();

        flashy(Lang::get('administrable-mailbox::translations.controller.delete'));

        return redirect_backroute('extensions.mailbox.mailbox.index');
    }

    public function saveNote(string $slug, Request $request)
    {
        $mailbox = config('administrable-mailbox.models.mailbox')::where('slug', $slug)->firstOrFail();

        $request->validate([
            'comment'   => 'required|min:10',
            'color'     => 'required',
            'email'     => 'required_if:save,0',
            'subject'   => 'required_if:save,0',
        ], [
            'comment.required'      => Lang::get('administrable-mailbox::translations.validation.comment_required'),
            'email.required_if'     => Lang::get('administrable-mailbox::translations.validation.email_required_if'),
            'subject.required_if'   => Lang::get('administrable-mailbox::translations.validation.subject_required_if'),
        ]);

        $note = new (config('administrable.modules.comment.model'));
        $note->commenter()->associate(get_guard());
        $note->commentable()->associate($mailbox);
        $note->comment = $request->get('comment');
        $note->guest_name = $request->get('color');
        $note->reply_notification = false;

        $note->save();

        // send email
        if ($request->get('save') == 0 && $request->get('email') && $request->get('subject')) {
            $notification = config('administrable-mailbox.mails.back.note_mail');

            Mail::to($request->get('email'))->send(new $notification($request->get('subject'), $note));
        }

        flashy(Lang::get('administrable-mailbox::translations.controller.note.create'));

        return back();
    }


    public function updateNote(string $slug, int $comment_id, Request $request)
    {
        $comment = config('administrable.modules.comment.model')::where('id', $comment_id)->firstOrFail();

        $request->validate([
            'comment' => 'required|min:10',
            'color'   => 'required',
        ], [
            'content.required'   => Lang::get('administrable-mailbox::translations.validation.comment_required'),
            'color.required'     => Lang::get('administrable-mailbox::translations.validation.color_required'),
        ]);

        $comment->update([
            'comment'       => $request->get('comment'),
            'guest_name'    => $request->get('color'),
        ]);

        flashy(Lang::get('administrable-mailbox::translations.controller.note.update'));

        return back();
    }

    public function deleteNote(string $slug, int $comment_id)
    {
        $comment = config('administrable.modules.comment.model')::where('id', $comment_id)->firstOrFail();

        $comment->delete();

        flashy(Lang::get('administrable-mailbox::translations.controller.note.delete'));

        return back();
    }
}
