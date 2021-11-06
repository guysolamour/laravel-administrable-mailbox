@component('mail::message')
Bonjour {{ $admin->full_name }},
un message de contact vient d'être envoyé
sur la plateforme par {{ $mailbox->name }} chez {{ $mailbox->email }}

@slot('title')
Message de contact  {{ config('app.name') }}
@endslot

@component('mail::panel')
{{ Str::limit($mailbox->content, 500) }}
@endcomponent


Merci, de bien vouloir traiter ce message <br>
{{ config('app.name') }}
@endcomponent

