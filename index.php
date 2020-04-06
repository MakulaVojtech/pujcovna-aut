<?php

namespace output;

require "classes/CarManager.php";
include "header.php";

use \classes\CarManager;

$manager = new CarManager();

$cars = $manager->getCars();
?>

<h1>Nabídka aut k vypůjčení</h1>
<div class="cars">
    <?php foreach ($cars as $car) : ?>
        <div class="car">
            <h1><?= $car->getName() ?></h1>
            <img src="images/<?= $car->getImg() ?>">
            <h2>Cena za den: <?= $car->getPricePerDay() ?> Kč</h2>
            <?php if ($user->isLoggedIn()) : ?><a href="#" class="objednat">Objednat</a> <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
</body>

</html>