<?php

namespace PasswordManager\Manager;

abstract class Manager
{
    protected $db;

    public function __construct()
    {
        // Fichier d'environnement pour la publication sur GitHub
        $env = parse_ini_file('../.env');
        
        $username = $env['USERNAME'];
        $password = $env['PASSWORD'];
        
        $isProd = false;
        if (exec('uname') === 'Linux') {
            $isProd = true;
        }

        $this->db = new \PDO('mysql:host=localhost;dbname=password-manager;charset=utf8', $username, $password);

        // On active les erreurs en dév
        if (!$isProd) {
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
    }
}
