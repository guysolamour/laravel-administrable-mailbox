<?php

return [
    'default' => [
        'add'       => 'Ajouter',
        'deleteall' => 'Tous supprimer',
        'delete'    => 'Supprimer',
        'edit'      => 'Editer',
        'edition'   => 'Edition',
        'minus'     => 'Réduire',
        'cancel'    => 'Annuler',
        'show'      => 'Afficher',
        'clone'     => 'Cloner',
        'save'      => 'Enregistrer',
        'modify'    => 'Modifier',
        'dashboard' => 'Tableau de bord',
        'yes'       => 'Oui',
        'no'        => 'Non',
        'destroymodels'        => 'Les élements sélectionnés ont été supprimés',
    ],
    'label'      => "Messagerie",
    'controller' => [
        'create' => "Nous avons réussi votre message et nous vous répondrons dans les plus brefs délais !",
        'update' => "Le message a bien été mis à jour",
        'delete' => "Le message a bien été supprimé",
        'note'   => [
            'create' => "La note a bien été ajoutée pour ce message",
            'update' => "La note a bien été modifiée",
            'delete' => "La note a bien été supprimée",
        ]
    ],
    'view' => [
        'name'           => "Nom",
        'email'          => 'Email',
        'read'           => 'Lu',
        'from'           => 'De',
        'notes'          => 'Notes',
        'note_color'     => 'Couleur',
        'note_content'   => 'Contenu',
        'send_email'     => 'Envoyer un email à',
        'edit_note'      => 'Edition de note',
        'reading'        => 'Lecture de message',
        'unread'         => "messages non lu(s))",
        'phone_number'   => 'Numéro de téléphone',
        'send_copy'      => 'Envoyez-moi une copie du message',
        // 'online' => 'En ligne',
        // 'offline' => 'Hors ligne',
        'content'    => 'Message',
        'actions'    => 'Actions',
        // 'status'    => 'Status',
        'createdat'  => 'Date ajout',
        'destroy'    => "Etes vous sûr de bien vouloir procéder à la suppression ?",
        'see_all'    => 'Voir tous les Messages',
    ],
    'mail' => [
        'front' => [
            'subject' => 'Message de contact ',
        ],
        'back' => [
            'subject' => 'Message de contact ',
        ],
    ],
    'validation' => [
        'comment_required'    => "La note ne peut pas être vide",
        'color_required'      => 'La couleur ne peut pas être vide',
        'email_required_if'   => "L'email est obligatoire et doit être valide pour envoyer un email",
        'subject_required_if' => "Le sujet est obligatoire et doit être valide pour envoyer un email",
    ],

];
