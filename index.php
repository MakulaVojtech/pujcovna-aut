<?php

namespace output;
require "classes/CarManager.php";

use \classes\CarManager;
$manager = new CarManager();

$cars = $manager->getCars();
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Půjčovna aut</title>
</head>
<body>
<header>
<a class="logo" href="index.php"><b>E</b>půjčování.cz</a>
    <nav>
        <a href="index.php">Nabídka</a>
        <a href="#">Podmínky</a>
        <a href="#">Kontakty</a>
    </nav>
</header>
<h1>Nabídka aut k vypůjčení</h1>
<div class="cars">
    <?php foreach ($cars as $car) : ?>
        <div class="car">
            <h1><?= $car->getName() ?></h1>
            <img src="images/<?= $car->getImg() ?>">
            <h2>Cena za den: <?= $car->getPricePerDay() ?> Kč</h2>
            <a href="#" class="objednat">Objednat</a>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
