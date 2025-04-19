<?php

require '../initialisation.php';

use PasswordManager\Message;

unset($_SESSION['user']);

$_SESSION['message'] = new Message([
    'type' => 'success',
    'text' => 'Vous avez bien été déconnecté(e).'
]);

header('Location: login');