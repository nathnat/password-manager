<?php

namespace PasswordManager;

class Champ extends Part
{
    protected $id;
    protected $site;
    protected $email;
    protected $username;
    protected $password;
    protected $description;
    protected $timestamp;
    protected $fillable = [ 'id', 'site', 'username', 'password', 'description', 'timestamp'];

    public function toJson()
    {
        return json_encode([
            'id' => $this->id(),
            'site' => $this->site(),
            'email' => $this->email(),
            'username' => $this->username(),
            'password' => $this->password('decrypt'),
            'description' => $this->description(),
            'timestamp' => $this->timestamp(),
        ]);
    }

    public function id()
    {
        return $this->id;
    }

    public function site()
    {
        return $this->site;
    }

    public function email()
    {
        return $this->email;
    }

    public function username()
    {
        return $this->username;
    }

    public function password($decrypt = false)
    {
        if ($decrypt == 'decrypt') {
            return encrypt_decrypt('decrypt', strrev($this->password()), $this->timestamp());
        }
        return $this->password;
    }

    public function description()
    {
        return $this->description;
    }

    public function timestamp()
    {
        return $this->timestamp;
    }

    public function setId(int $id): Champ
    {
        $this->id = $id;
        return $this;
    }

    public function setSite(string $site): Champ
    {
        $this->site = $site;
        return $this;
    }

    public function setEmail(string $email): Champ
    {
        $this->email = $email;
        return $this;
    }

    public function setUsername(string $username): Champ
    {
        $this->username = $username;
        return $this;
    }

    public function setPassword(string $password): Champ
    {
        $this->password = $password;
        return $this;
    }

    public function setDescription(string $description): Champ
    {
        $this->description = $description;
        return $this;
    }

    public function setTimestamp(string $timestamp): Champ
    {
        $this->timestamp = $timestamp;
        return $this;
    }
}
