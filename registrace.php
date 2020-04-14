<?php

namespace output;

include "header.php";
?>

<h1>Nabídka aut k vypůjčení</h1>
<div class="cars">
    <div class="car">
    <form action="" method="POST" id="signUpForm">
            <input type="email" name="email" placeholder="email" required>
            <input type="password" name="password" placeholder="heslo" required>
            <input type="password" name="passAgain" placeholder="heslo znovu" required>
            <input type="text" name="name" placeholder="jméno" required>
            <input type="text" name="surname" placeholder="příjmení" required>
            <input type="tel" name="phone" placeholder="telefon" required>
            <input type="hidden" name="signUp" value="Registrovat">
            <button type="submit" name="submit" value="Registrovat">Registrovat</button>
            <a href="login.php">Již máte účet? Přihlašte se <u>zde</u></a>
        </form>
    </div>
</div>
</body>

</html>