<?php

class User
{
    public $id;
    public $name;
    public $lastname;
    public $email;
    public $password;

    public function __construct($id = null, $name = null, $lastname = null, $email = null, $password = null) {
        $this->id = $id;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
    }
}