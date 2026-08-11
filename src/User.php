<?php

namespace PasswordManager;

class User extends Part
{
    protected $id;
    protected $email;
    protected $password;
    protected $timestamp;
    protected $numberOfTry;
    protected $blockTime;
    protected $fillable = [ 'id', 'email', 'password', 'timestamp', 'numberOfTry', 'blockTime'];

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        // On ne se connecte pour une extension Part que dans la classe User
        $this->dbConnect();
    }

    public function __wakeup()
    {
        $this->dbConnect();    
    }

    /**
     * Fonction qui vérifie si le mot de passe est correcte
     * 
     * @param string $password Le mot de passe à vérifier
     * 
     * @return bool True si le mot de passe est correcte, false sinon
     */
    public function passwordIsCorrect(string $password): bool
    {
        return \password_verify($password . $this->timestamp(), $this->password());
    }

    /**
     * Fonction qui ajoute un essai sur l'utilisateur
     */
    public function addTry()
    {
        $this->setNumberOfTry($this->numberOfTry() + 1);

        $update = $this->db->prepare('UPDATE users SET numberOfTry = :numberOfTry WHERE id = :id');
        $update->execute([
            'numberOfTry' => $this->numberOfTry(),
            'id' => $this->id()
        ]);
    }

    /**
     * Fonction qui bloque l'utilisateur.
     */
    public function block()
    {
        $this->setBlockTime(time() + 3600);

        $update = $this->db->prepare('UPDATE users SET blockTime = :blockTime WHERE id = :id');
        $update->execute([
            'blockTime' => $this->blockTime(),
            'id' => $this->id()
        ]);
    }

    /**
     * Fonction qui reset le nombre de tentative de l'utilisateur
     */
    public function resetTry()
    {
        $update = $this->db->prepare('UPDATE users SET numberOfTry = :numberOfTry WHERE id = :id');
        $update->execute([
            'numberOfTry' => 0,
            'id' => $this->id()
        ]);
    }

    public function id()
    {
        return $this->id;
    }

    public function email()
    {
        return $this->email;
    }

    public function password()
    {
        return $this->password;
    }

    public function timestamp()
    {
        return $this->timestamp;
    }

    public function numberOfTry()
    {
        return $this->numberOfTry;
    }

    public function blockTime()
    {
        return $this->blockTime;
    }

    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    public function setTimestamp($timestamp): User
    {
        $this->timestamp = (int)$timestamp;
        return $this;
    }

    public function setNumberOfTry($numberOfTry): User
    {
        $this->numberOfTry = (int)$numberOfTry;
        return $this;
    }

    public function setBlockTime($time): User
    {
        $this->blockTime = $time;
        return $this;
    }
}
