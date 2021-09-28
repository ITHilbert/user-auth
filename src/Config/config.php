<?php

return [
    //Feld 'name' befüllen
    'name' => 0,  // 0 = Manuell 1 = Vorname Nachname 2 = Nachname, Vorname 3 = Nachname 4 = Vorname
    //Sollen die Views von ressources or vendor verwendet werden
    'views' => 'vendor',
    //View welche Felder anzeigen
    'user' => [
        'anrede' => false,
        'title' => false,
        'firstname' => false,
        'lastname'  => false,
        'smallname' => false,
        'name' => true,
        'role' => true,
        'email' => true,
        'private_email' => false,
        'street' => false,
        'postcode' => false,
        'city' => false,
        'country' => false,
        'signature_rule' => false,
        'ustid' => false,
        'phone' => false,
        'phone2' => false,
        'mobile' => false,
        'fax' => false,
        'skype' => false,
        'hourly_rate' => false,
        'birthday' => false,
        'comment' => false,
    ],
    'signature_rules' => [
        1 => [
                'id' => 1,
                'signature_rule' => 'i.A.',
                'meaning' => 'im Auftrag (i.A.)',
        ],
        2 => [
                'id' => 2,
                'signature_rule' => 'i.V.',
                'meaning' => 'in Vollmacht (i.V.)',
        ],
        3 => [
                'id' => 3,
                'signature_rule' => 'ppa.',
                'meaning' => 'Mit Prokura (ppa.)',
        ],
        4 => [
            'id' => 4,
            'signature_rule' => '',
            'meaning' => 'Geschäftsführer',
        ],
    ],
    'anrede' => [
        [
            'id' => "1",
            'anrede' => 'keine'
        ],
        [
            'id' => "2",
            'anrede' => 'Frau'
        ],
        [
            'id' => "3",
            'anrede' => 'Herr'
        ],
    ],

];
