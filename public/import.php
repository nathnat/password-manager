<?php

require '../initialisation.php';

use PasswordManager\Champ;
use PasswordManager\Manager\ChampManager;
use PasswordManager\User;

$user = new User([
    'id' => 2,
    'username' => 'Nathaniel'
]);

$filename = '../code.csv';

$manager = new ChampManager();


// Open the file for reading
if (($h = fopen("{$filename}", "r")) !== FALSE) {
    // Each line in the file is converted into an individual array that we call $data
    // The items of the array are comma separated
    while (($data = fgetcsv($h, 1000, ",")) !== FALSE) {

        $champData = [
            'site' => trim($data[0]),
            'email' => trim($data[1]),
            'username' => trim($data[2]),
            'password' => trim($data[3]),
            'description' => ''
        ];

        if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,255}$#", $champData['email'])) {

            $champData['username'] = $champData['email'];
            $champData['email'] = '';
        }

        $champ = new Champ($champData);

        $manager->add($champ, $user);
    }

    // Close the file
    fclose($h);
}

echo 'Tout les champs ont bien été inscrit !';