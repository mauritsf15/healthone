<?php

class User
{
    public $id;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $role;

    public function __construct()
    {
        settype($this->id, 'integer');
        settype($this->role, 'boolean');
    }
}

class OnlyID
{
    public $id;

    public function __construct()
    {
        settype($this->id, 'integer');
    }
}