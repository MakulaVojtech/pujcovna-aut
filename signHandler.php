<?php

namespace handler;

session_start();

require "classes/UserManager.php";

use classes\UserException;
use classes\UserManager;


$userManager = new UserManager;

if (isset($_POST["signUp"])) {
    try {
        $user = $userManager->getNewUser();
        $user->setValues(htmlspecialchars($_POST["email"]), htmlspecialchars($_POST["name"]), htmlspecialchars($_POST["surname"]), htmlspecialchars($_POST["phone"]), htmlspecialchars($_POST["password"]), htmlspecialchars($_POST["passAgain"]));
        if ($userManager->signUp($user)) {
            echo "<p class='success'>Uživatel úspěšně registrován.</p>";
            header("Location:admin.php");
        } else {
            echo "<p class='error'>Něco se pokazilo, zkuste to prosím zachvíli</p>";
        }
    } catch (UserException $e) {
        echo "<p class='error'>{$e->getMessage()}</p>";
    }
}

if (isset($_POST["signIn"])) {
    try{
        $_SESSION["user"] = $userManager->signIn(htmlspecialchars($_POST["email"]), htmlspecialchars($_POST["password"])); 
        echo "<p class='success'>Přihlášení proběhlo úspěšně.</p>";
    }catch(UserException $e){
        echo "<p class='error'>{$e->getMessage()}</p>";
    }
}

if (isset($_POST["signOut"])) {
    session_destroy();
    echo "<p class='success'>Odhlášení proběhlo úspěšně.</p>";
}
