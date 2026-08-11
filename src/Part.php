<?php

namespace PasswordManager;

abstract class Part
{
    protected $db;
    protected $fillable;

    public function __construct(array $data = [])
    {
        $this->hydrate($data);
    }

    public function __sleep()
    {
        return $this->fillable;
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            // One gets the setter's name matching the attribute.
            $method = 'set' . ucfirst($key);

            // If the matching setter exists
            if (method_exists($this, $method)) {
                // One calls the setter.
                $this->$method($value);
            }
        }
    }

    /**
     * Fonction qui se connecte à la base de données et met l'objet PDO dans $db
     */
    public function dbConnect()
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
