<?php

return [
    //Feld 'name' befüllen
    'name' => 0,  // 0 = Manuell 1 = Vorname Nachname 2 = Nachname, Vorname 3 = Nachname 4 = Vorname
    //Sollen die Views von 'ressources' or 'vendor' verwendet werden
    'views' => 'vendor',
    //View welche Felder anzeigen
    'user' => [
        'firstname' => true,
        'lastname'  => true,
        'smallname' => true,
        'name' => true,
        'role' => true,
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
    ]

];
