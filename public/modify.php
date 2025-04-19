<?php

require '../initialisation.php';

use PasswordManager\Manager\ChampManager;
use PasswordManager\Message;

if (isset($_SESSION['user']) && isset($_GET['id'])) {

    $manager = new ChampManager;
    $champ = $manager->get((int)$_GET['id'], $_SESSION['user']);
    // Si il y a un champ
    if (!empty((array)$champ->timestamp())) {

        if (
            isset($_POST['site'])
            && isset($_POST['email'])
            && isset($_POST['username'])
            && isset($_POST['password'])
            && isset($_POST['description'])
        ) {

            if (isset($_POST['site']) && !empty($_POST['site'])) {

                // On hydrate le champ avec les nouvelles valeurs
                $champ->hydrate([
                    'site' => htmlspecialchars($_POST['site']),
                    'email' => htmlspecialchars($_POST['email']),
                    'username' => htmlspecialchars($_POST['username']),
                    'password' => strrev(encrypt_decrypt(
                        'encrypt',
                        htmlspecialchars(trim($_POST['password'])),
                        $champ->timestamp()
                    )),
                    'description' => htmlspecialchars($_POST['description'])
                ]);
                
                // On modifie le champ dans la base de données
                $manager->modify($champ);
                
                $_SESSION['message'] = new Message([
                    'type' => 'success',
                    'text' => 'La ligne a bien été modifiée.'
                ]);
                
                header('Location: .');
                exit;
            } else {
                $message = new Message([
                    'type' => 'error',
                    'text' => 'Veuillez renseigner le site.'
                ]);

                require '../view/modifyView.php';
            }
        } else {
            require '../view/modifyView.php';
        }
    } else {
        header('Location: .');
    }
} else {
    header('Location: .');
}
