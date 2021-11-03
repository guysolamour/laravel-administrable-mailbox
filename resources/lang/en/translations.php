<?php

return [
    'default' => [
        'add'            => 'Add',
        'deleteall'      => 'Delete all',
        'delete'         => 'Delete',
        'edit'           => 'Edit',
        'edition'        => 'Edition',
        'minus'          => 'Minus',
        'cancel'         => 'Cancel',
        'show'           => 'Show',
        'clone'          => 'Clone',
        'save'           => 'Save',
        'modify'         => 'Modify',
        'dashboard'      => 'Dashboard',
        'yes'            => 'Yes',
        'no'             => 'No',
        'destroymodels'  => 'The selected items has been deleted',
    ],
    'label'      => "Mailbox",
    'controller' => [
        'create' => "We received your message and we will send you an answer as soon as possible !",
        'update' => "The message has been updated",
        'delete' => "The message has been deleted",
        'note'   => [
            'create' => "The note has been saved for this message",
            'update' => "The note has been updated",
            'delete' => "The note has been deleted",
        ]
    ],
    'view' => [
        'name'           => "Name",
        'email'          => 'Email',
        'read'           => 'Read',
        'from'           => 'From',
        'notes'          => 'Notes',
        'note_color'     => 'Color',
        'note_content'   => 'Content',
        'send_email'     => 'Send email to',
        'edit_note'      => 'Edit note',
        'reading'        => 'Reading message',
        'unread'         => "Unread message(s)",
        'phone_number'   => 'Phone number',
        'send_copy'      => 'Send me a copy',
        // 'online' => 'Online',
        // 'offline' => 'Offline',
        'content'    => 'Message',
        'actions'    => 'Actions',
        // 'status'    => 'Status',
        'createdat'  => 'Created at',
        'destroy'    => "Are you sure to remove this message ?",
        'see_all'    => 'See all messages',
    ],
    'mail' => [
        'front' => [
            'subject' => 'Contact message',
        ],
        'back' => [
            'subject' => 'Contact message',
        ],
    ],
    'validation' => [
        'comment_required'    => "The note can not be empty",
        'color_required'      => 'The color can not be empty',
        'email_required_if'   => "The email is required and must be valid",
        'subject_required_if' => "The subject is required",
    ],

];

