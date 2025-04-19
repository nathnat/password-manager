<?php

require '../initialisation.php';

use PasswordManager\Champ;
use PasswordManager\Message;
use PasswordManager\Manager\ChampManager;

if (isset($_SESSION['user'])) {
    if (
        !empty($_POST['site'])
        || !empty($_POST['email'])
        || !empty($_POST['username'])
        || !empty($_POST['password'])
        || !empty($_POST['description'])
    ) {
        if (isset($_POST['site']) && !empty($_POST['site'])) {

            $champ = new Champ([
                'site' => htmlspecialchars(trim($_POST['site'])),
                'email' => htmlspecialchars(trim($_POST['email'])),
                'username' => htmlspecialchars(trim($_POST['username'])),
                'password' => htmlspecialchars(trim($_POST['password'])),
                'description' => htmlspecialchars(trim($_POST['description']))
            ]);
            
            $manager = new ChampManager;
            $manager->add($champ, $_SESSION['user']);
            
            $_SESSION['message'] = new Message([
                'type' => 'success',
                'text' => 'La ligne a bien été créée.'
            ]);
            
            header('Location: .');
            exit;   
        } else {
            $message = new Message([
                'type' => 'error',
                'text' => 'Veuillez renseigner le site.'
            ]);

            require '../view/addView.php';
        }
    } else {
        require '../view/addView.php';
    }
} else {
    header('Location: .');
}
