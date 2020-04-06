<?php

namespace classes;

final class User
{
    private $email, $name, $surname, $phone, $password, $passAgain, $isAdmin;

    public function setValues($email, $name, $surname, $phone, $password, $passAgain = null, $isAdmin = 0) : void
    {
        $this->email = $email;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->password = $password;
        $this->passAgain = $passAgain;
        $this->isAdmin = $isAdmin;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getSurname() : string
    {
        return $this->surname;
    }

    public function getPhone() : int
    {
        return $this->phone;
    }


    public function getPassword() : string
    {
        return $this->password;
    }

    public function isLoggedIn() : bool
    {
        return !empty($this->email) && !empty($this->password) ? true : false;
    }

    public function isAdmin() : bool
    {
        return !empty($this->isAdmin) && $this->isAdmin == 1 ? true : false;
    }

    public function getPassAgain()
    {
        return $this->passAgain;
    }
}