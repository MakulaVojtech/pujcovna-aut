<?php

namespace output;

require "classes/User.php";
session_start();

use classes\User;

$user = isset($_SESSION["user"]) ? $_SESSION["user"] : new User();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/sign.js"></script>
    <title>Půjčovna aut | administrace</title>
</head>

<body>
    <div class="modal" id="registraceModal">
        <form action="handlers/signHandler.php" method="POST" id="signUpForm">
            <input type="email" name="email" placeholder="email" required>
            <input type="password" name="password" placeholder="heslo" required>
            <input type="password" name="passAgain" placeholder="heslo znovu" required>
            <input type="text" name="name" placeholder="jméno" required>
            <input type="text" name="surname" placeholder="příjmení" required>
            <input type="tel" name="phone" placeholder="telefon" required>
            <input type="hidden" name="signUp" value="Registrovat">
            <button type="submit" name="submit" value="Registrovat">Registrovat</button>
        </form>
    </div>
    <div class="modal" id="loginModal">
          <form action="handlers/signHandler.php" method="POST" id="signInForm">
              <input type="email" name="email" placeholder="email" required>
              <input type="password" name="password" placeholder="heslo" required>
              <input type="hidden" name="signIn" value="Přihlásit">
              <button type="submit" name="submit" value="login">Přihlásit</button>
          </form>
      </div>
    <header>
        <a class="logo" href="index.php"><b>E</b>půjčování.cz</a>
        <nav>
            <a href="index.php">Nabídka</a>
            <a href="https://github.com/MakulaVojtech/pujcovna-aut" target="_blank">Podmínky</a>
            <a href="https://github.com/MakulaVojtech/pujcovna-aut" target="_blank">Kontakty</a>
            <?php if ($user->isAdmin()) : ?><a href="admin.php">Administrace</a> <?php endif; ?>
            <?php if ($user->isLoggedIn()) : ?>
                <a href="" id="signOut">Odhlásit se</a>
            <?php else : ?>
                <a href="#">Přihlásit se</a>
            <?php endif; ?>
        </nav>
    </header>
    <div id="flashes"></div>