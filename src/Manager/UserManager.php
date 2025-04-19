<?php


namespace PasswordManager\Manager;

use PasswordManager\User;

class UserManager extends Manager
{
    /**
     * Fonction qui ajoute un utilisateur dans la base de données.
     * 
     * @param User $user L'utilisateur à ajouté
     */
    public function add(User $user)
    {
        $user->setTimestamp(time());
        $user->setPassword($this->hashPassword($user));

        // Insertion du champ
		$insert = $this->db->prepare('INSERT INTO users (email, password, timestamp) VALUES(:email, :password, :timestamp)'); 

		$insert->execute([
			'email' => $user->email(),
			'password' => $user->password(),
            'timestamp' => $user->timestamp()
		]);

		// Hydratation du champ avec l'id
		$user->setId($this->db->lastInsertId());
    }

    /**
     * Fonction qui hash un mot de passe d'un utilisateur
     * 
     * @param User $user L'utilisateur
     *  
     * @return string Le hash du mot de passe
     */
    private function hashPassword($user): string
    {
        return \password_hash($user->password() . $user->timestamp(), \PASSWORD_DEFAULT);
    }

    /**
     * Fonction qui permet de récupere un utilisateur à partir de son id ou de son nom d'utilisateur
     * 
     * @param mixed $info L'id ou le nom d'utilisateur
     * 
     * @return User L'utilisateur trouvé
     */
    public function get($info): User
    {
        if (is_int($info)) {
            $get = $this->db->prepare('SELECT * FROM users WHERE id = :info LIMIT 1');
        } else {
            $get = $this->db->prepare('SELECT * FROM users WHERE email = :info LIMIT 1');
        }
        $get->execute([':info' => $info]);

        return new User((array)$get->fetch());
    }
}
