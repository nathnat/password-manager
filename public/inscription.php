<?php

use PasswordManager\Manager\UserManager;
use PasswordManager\Message;
use PasswordManager\User;

require '../initialisation.php';

$userManager = new UserManager;

$error = '';
// On gère les messages
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

// Si il y a toutes les variables
if (
    isset($_POST['email']) && !empty($_POST['email'])
    && isset($_POST['password']) && !empty($_POST['password'])
    && isset($_POST['confirmPassword']) && !empty($_POST['confirmPassword'])
) {
    // Si l'email est valide
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        //Valid email!
        // On sécurise les variables
        $_POST['email'] = htmlspecialchars(trim($_POST['email']));
        $_POST['password'] = htmlspecialchars(trim($_POST['password']));
        $_POST['confirmPassword'] = htmlspecialchars(trim($_POST['confirmPassword']));
        
        // Si l'utilisateur n'existe pas déjà
        if ($userManager->get($_POST['email'])->id() === null) {
            
            if (strlen($_POST['password']) >= 6) {
                if ($_POST['password'] == $_POST['confirmPassword']) {
                    
                    $user = new User([
                        'email' => $_POST['email'],
                        'password' => $_POST['password']
                    ]);
                    
                    $userManager->add($user);
                    
                    $_SESSION['user'] = $user;
                    
                    header('Location: .');
                    exit;
                } else {
                    $error = 'Les mots de passe sont différents.';
                }
            } else {
                $error = 'Le mot de passe doit contenir au minimum 6 caractères.';
            }
        } else {
            $error = 'Un compte existe déjà avec cette email.';
        }
    } else {
        $error = 'Le format de l\'adresse email est invalide.';
    }
}

if (!empty($error)) {
    $message = new Message([
        'type' => 'error',
        'text' => $error
    ]);
}

require '../view/inscriptionView.php';
