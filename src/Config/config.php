<?php

return [
    //Feld 'name' befüllen
    'name' => 0,  // 0 = Manuell 1 = Vorname Nachname 2 = Nachname, Vorname
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

];
