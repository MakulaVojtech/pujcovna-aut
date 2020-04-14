<?php

namespace output;

include "header.php";
?>

<h1>Nabídka aut k vypůjčení</h1>
<div class="cars">
    <div class="car">
        <form action="" method="POST" id="signInForm">
            <input type="email" name="email" placeholder="email" required>
            <input type="password" name="password" placeholder="heslo" required>
            <input type="hidden" name="signIn" value="Přihlásit">
            <button type="submit" name="submit" value="login">Přihlásit</button>
            <a href="registrace.php">Ještě nemáte účet? Nevadí! Zaregistrujte se <u>zde</u></a>
        </form>
    </div>
</div>
</body>

</html>