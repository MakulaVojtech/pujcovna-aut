<?php

namespace classes;

require "dbConfig.php";
require "User.php";

use classes\dbConfig;
use classes\User;
use Exception;

final class UserManager extends dbConfig
{
    private $connection;

    public function __construct()
    {
        $this->connection = parent::getConnection();
    }

    public function getNewUser(): User
    {
        return new User();
    }

    public function checkPassword(string $password): bool
    {
        $regex = "/^(?=.*[0-9])(?=.*[A-Z]).{8,}$/";
        return preg_match($regex, $password);
    }
    public function checkEmail(string $email): bool
    {
        $regex = "/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/";
        return preg_match($regex, $email);
    }
    public function checkPhone(string $phone): bool
    {
        $regex = "/^([0-9]){9,9}$/";
        return preg_match($regex, $phone);
    }

    public function signUp(User $user): bool
    {
        $email = $user->getEmail();
        $name = $user->getName();
        $surname = $user->getSurname();
        $phone = $user->getPhone();
        $password = password_hash($user->getPassword(), PASSWORD_BCRYPT);
        if (!$this->checkEmail($email)) {
            throw new UserException("Zadejte prosím platný email.");
        }
        if(!$this->checkPassword($password)){
            throw new UserException("Heslo musí obsahovat alespoň osm znaků z toho jedno VELKÉ a jedno malé písmeno a jedno číslo");
        }
        if (!$this->checkPhone($phone)) {
            throw new UserException("Zadejte prosím platné telefonní číslo.");
        }
        $sql = "SELECT * FROM user where email = :email";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        if ($stmt->rowCount() >= 1) {
            throw new UserException("Zadaný uživatel již existuje.");
        } else {
            if ($user->getPassword() != $user->getPassAgain()) {
                throw new UserException("Zadaná hesla se neshodují.");
            } else {
                $sql = "INSERT INTO `user`(`email`, `name`, `surname`, `phone`, `password`) VALUES (:email, :name, :surname, :phone, :password)";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":surname", $surname);
                $stmt->bindParam(":phone", $phone);
                $stmt->bindParam(":password", $password);
                if ($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    public function signIn(string $email, string $password): User
    {
        if (!$this->checkEmail($email)) {
            throw new UserException("Zadejte prosím platný email.");
        }
        $sql = "SELECT * FROM user where email = :email";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            throw new UserException("Uživatel s tímto emailem neexistuje.");
        } else {
            $stmt->setFetchMode(\PDO::FETCH_CLASS, User::class);
            $user = $stmt->fetch();
            if (!password_verify($password, $user->getPassword())) {
                throw new UserException("Zadali jste špatné heslo.");
            } else {
                return $user;
            }
        }
    }

    public function changePassword(string $old, string $new, string $newAgain, User $user): bool
    {
        if (!password_verify($old, $user->getPassword())) {
            throw new UserException("Staré heslo je nesprávné.");
        } else {
            if ($new != $newAgain) {
                throw new UserException("Zadaná hesla se neshodují.");
            } else {
                $hash = password_hash($new, PASSWORD_BCRYPT);
                $sql = "UPDATE `user` SET `password` = :hash WHERE email = :email";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindParam(":hash", $hash);
                $email = $user->getEmail();
                $stmt->bindParam(":email", $email);
                return $stmt->execute();
            }
        }
    }
}
class UserException extends Exception
{
}
