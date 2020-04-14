<?php

namespace output;

include "header.php";

if (!$user->isLoggedIn()) {
    header("Location: index.php");
}

?>
<h1>Profil uživatele <?= $user->getName() ?> <?= $user->getSurname() ?></h1>
<div class="profile">
    <div class="changePass">
        <h1>Změna hesla</h1>
        <form action="" method="post" id="password">
            <input type="password" placeholder="Staré heslo" name="old" id="" required>
            <input type="password" placeholder="Nové heslo" name="new" id="" required>
            <input type="password" placeholder="Nové heslo znovu" name="newAgain" id="" required>
            <input type="hidden" name="password" value="true">
            <input type="submit" value="Změnit">
        </form>
    </div>

</body>

<script src="js/profile.js"></script>

</html>