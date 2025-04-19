<?php

require '../initialisation.php';

use PasswordManager\Manager\ChampManager;

if (isset($_SESSION['user'])) {

    $manager = new ChampManager;

    // Récupération des champs
    $champs = $manager->getAll($_SESSION['user']);

    // On gère les messages
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
    }

    require '../view/showView.php';
} else {
    header('Location: login');
}
