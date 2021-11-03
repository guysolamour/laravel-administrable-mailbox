<?php

return [
    /*
    |--------------------------------------------------------------------------
    | EXTENSIONS -> Mailbox
    |--------------------------------------------------------------------------
    |
    | The migrations folder in database directory
    */
    'migrations_path' => database_path('extensions/mailbox'),

    'models' => [
        'mailbox'     =>  \Guysolamour\Administrable\Extensions\Mailbox\Models\Mailbox::class,
    ],
    'forms' => [
        'front' => [
            'mailbox' => \Guysolamour\Administrable\Extensions\Mailbox\Forms\Front\ContactForm::class,
        ],
    ],
    'controllers' => [
        'back' => [
            'mailbox' => \Guysolamour\Administrable\Extensions\Mailbox\Http\Controllers\Back\MailboxController::class,
        ],
        'front' => [
            'mailbox' => \Guysolamour\Administrable\Extensions\Mailbox\Forms\Front\ContactForm::class,
            'mailbox' => \Guysolamour\Administrable\Extensions\Mailbox\Http\Controllers\Front\ContactController::class,
        ]
    ],
    'mails' => [
        'back' => [
            'mailbox'   => \Guysolamour\Administrable\Extensions\Mailbox\Mail\Back\ContactMail::class,
            'note_mail' => \Guysolamour\Administrable\Mail\Front\NoteAnswerMail::class,
        ],
        'front' => [
            'sendme_mail'   => \Guysolamour\Administrable\Extensions\Mailbox\Mail\Front\SendMeContactMessageMail::class,
            'note_mail' => \Guysolamour\Administrable\Mail\Front\NoteAnswerMail::class,
        ],
    ],
    'notifications' => [
        'back' => [
            'mailbox' => \Guysolamour\Administrable\Extensions\Mailbox\Notifications\Back\ContactNotification::class,
        ]
    ]

    // 'mailbox' => [
    //     'activate'    => false,
    //     'model'       => \Guysolamour\Administrable\Models\Extensions\Mailbox\Mailbox::class,
    //     'back'     => [
    //         'notification'    => \Guysolamour\Administrable\Notifications\Back\Extensions\Mailbox\ContactNotification::class,
    //         'mail'            => \Guysolamour\Administrable\Mail\Back\Extensions\Mailbox\ContactMail::class,
    //         'note_mail'       => \Guysolamour\Administrable\Mail\Front\NoteAnswerMail::class,
    //         'controller'      => \Guysolamour\Administrable\Http\Controllers\Back\Extensions\Mailbox\MailboxController::class,
    //     ],
    //     'front'     => [
    //         'note_mail'       => \Guysolamour\Administrable\Mail\Front\NoteAnswerMail::class,
    //         'form'            => \Guysolamour\Administrable\Forms\Front\Extensions\Mailbox\ContactForm::class,
    //         'controller'      => \Guysolamour\Administrable\Http\Controllers\Front\Extensions\Mailbox\ContactController::class,
    //         'mail'            => \Guysolamour\Administrable\Mail\Front\Extensions\Mailbox\SendMeContactMessageMail::class,
    //     ],
    // ],
];
