<?php

use PasswordManager\Manager\UserManager;
use PasswordManager\Message;

require '../initialisation.php';

// On gère les messages
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

try {
    if (isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {

        $_POST['email'] = htmlspecialchars(trim($_POST['email']));
        $_POST['password'] = htmlspecialchars(trim($_POST['password']));

        $userManager = new UserManager;

        $user = $userManager->get($_POST['email']);

        // Si cette utilisateur existe
        if ($user->id() !== null) {

            if (time() > $user->blockTime()) {

                // Si le mot de passe est bon
                if ($user->passwordIsCorrect($_POST['password'])) {

                    $_SESSION['user'] = $user;

                    $user->resetTry();

                    header('Location: .');
                    exit;
                } else {

                    $exception = 'Il y a une erreur dans votre mot de passe. ';

                    $user->addTry();

                    switch ($user->numberOfTry()) {
                        case 17:
                            $exception .= '3 tentatives restantes.';
                            break;

                        case 18:
                            $exception .= '2 tentatives restantes.';
                            break;

                        case 19:
                            $exception .= '1 tentative restante.';
                            break;

                        case 20:

                            $user->resetTry();

                            $user->block();

                            $exception .= 'Trop de tentative votre compte est bloqué.';
                            break;
                    }

                    throw new Exception($exception);
                }
            } else {
                $tempsRestant = (int)((($user->blockTime() - time()) / 60) + 1);
                if ($tempsRestant > 1) {
                    throw new Exception('Ce compte est bloqué. Réessayez dans ' . $tempsRestant . ' minutes.');
                } else {
                    throw new Exception('Ce compte est bloqué. Réessayez dans ' . $tempsRestant . ' minute.');
                }
            }
        } else {
            throw new Exception('Cette utilisateur n\'existe pas.');
        }
    }
} catch (Exception $e) {
    $message = new Message([
        'type' => 'error',
        'text' => $e->getMessage()
    ]);
}

require '../view/loginView.php';
