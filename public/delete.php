<?php

require '../initialisation.php';

use PasswordManager\Manager\ChampManager;
use PasswordManager\Message;

if (isset($_SESSION['user'])) {

    $manager = new ChampManager;

    if (isset($_POST['id'])) {

        // Delete du champ
        $manager->delete((int)$_POST['id'], $_SESSION['user']);

        $_SESSION['message'] = new Message([
            'type' => 'success',
            'text' => 'La ligne a bien été supprimée.'
        ]);
    }
} else {
    header('Location: .');
}
