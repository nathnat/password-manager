<?php

/**
 * Fonction pour encrypter et décrypter un texte.
 */
function encrypt_decrypt($action, $string, $secret_key = false, $secret_iv = false)
{
    $output = false;

    $encrypt_method = "AES-256-CBC";

    // Fichier d'environnement pour la publication sur GitHub
    $env = parse_ini_file('../.env');

    if ($secret_key == false)
        $secret_key = $env['SECRET_KEY'];

    if ($secret_iv == false)
        $secret_iv = $env['SECRET_IV'];

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } elseif ($action == 'decrypt')
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);

    return $output;
}
