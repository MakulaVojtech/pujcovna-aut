<?php

namespace output;

require "classes/User.php";
session_start();

use classes\User;

$user = isset($_SESSION["user"]) ? $_SESSION["user"] : new User();

if (isset($_SESSION["sign"])) {
    $sign = $_SESSION["sign"];
    unset($_SESSION["sign"]);
}

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
    <script src="js/main.js"></script>
    <title>Půjčovna aut</title>
</head>

<body>
    <header>
        <a class="logo" href="index.php"><b>E</b>půjčování.cz</a>
        <nav>
            <a href="index.php">Nabídka</a>
            <a href="https://github.com/MakulaVojtech/pujcovna-aut" target="_blank" rel="noopener noreferrer">Podmínky</a>
            <a href="https://github.com/MakulaVojtech/pujcovna-aut" target="_blank" rel="noopener noreferrer">Kontakty</a>
            <?php if ($user->isAdmin()) : ?>
                <div class="navDiv">
                    <a href="#" id="administraceA">Administrace</a>
                    <div id="administraceDiv" class="close" style="display:none">
                        <a href="admin.php">Objednávky</a>
                        <a href="auta-admin.php">Vozidla</a>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($user->isLoggedIn()) : ?> <a href="profil.php" class="fa fa-user"></a> <?php endif; ?>
            <?php if ($user->isLoggedIn()) : ?>
                <a href="" id="signOut">Odhlásit se</a>
            <?php else : ?>
                <a href="login.php">Přihlásit se</a>
            <?php endif; ?>
        </nav>
    </header>
    <div id="flashes">
        <?php if (isset($sign)) : ?><?= $sign ?><?php endif; ?>
    </div>