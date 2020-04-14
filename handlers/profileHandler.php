<?php

namespace handler;

require "../classes/UserManager.php";

use classes\UserException;
use classes\UserManager;

session_start();

$manager = new UserManager();


if(isset($_POST["password"])){
    try{
        if($manager->changePassword($_POST["old"], $_POST["new"], $_POST["newAgain"], $_SESSION["user"])){
            echo "<p class='success'>Heslo úspěšně změno.</p>";
        }else{
            echo "<p class='error'>Změna hesla se nezdařila. Zkuste to později.</p>";
        }
    }catch(UserException $e){
        echo "<p class='error'>{$e->getMessage()}</p>";
    }
}
