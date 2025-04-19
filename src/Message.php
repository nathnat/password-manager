<?php

namespace PasswordManager;

class Message extends Part
{
    protected $type;
    protected $text;
    protected $fillable = ['type', 'text'];

    public function getType()
    {
        return $this->type;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setText($text)
    {
        $this->text = $text;
    }
}
