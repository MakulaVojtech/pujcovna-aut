<?php

namespace output;

require "classes/CarManager.php";

use classes\CarManager as Manager;

$manager = new Manager();
$lendings = $manager->getLendings();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Půjčovna aut | administrace</title>
</head>

<body>
    <header>
        <a class="logo" href="index.php"><b>E</b>půjčování.cz</a>
        <nav>
            <a href="index.php">Nabídka</a>
            <a href="https://github.com/MakulaVojtech/pujcovna-aut" target="_blank">Podmínky</a>
            <a href="https://github.com/MakulaVojtech/pujcovna-aut" target="_blank">Kontakty</a>
            <a href="admin.php">Administrace</a>
        </nav>
    </header>
    <h1>Administrace vypůjčených aut</h1>
    <div class="lendings">
        <?php foreach ($lendings as $lending) : ?>
            <div class="lending">
                <div class="cardiv">
                    <h1><?= $lending->car_name ?></h1>
                    <img src="images/<?= $lending->img ?>">
                    <p>Cena za den: <?= $lending->pricePerDay ?> Kč</p>
                </div>
                <div class="right">
                    <div class="contact">
                        <h1><?= $lending->name ?> <?= $lending->surname ?></h1>
                        <p><?= $lending->email ?></p>
                        <p><?= $lending->phone ?></p>
                    </div>
                    <div class="lendingdiv">
                        <b><?= ($lending->startDate == $lending->endDate) ? (date_format(date_create($lending->startDate), "d. m. Y")) : (date_format(date_create($lending->startDate), "d. m. Y") . " - " .  date_format(date_create($lending->endDate), "d. m. Y")) ?></b>
                        <?php
                        $dny = date_diff(date_create($lending->startDate), date_create($lending->endDate), true)->days + 1;
                        $slovy = $dny == 1 ? "den" : ($dny < 5 ? "dny" : "dní");
                        ?>
                        <p><?= "$dny $slovy" ?></p>
                        <p>Cena celkem: <?= $lending->price  ?> Kč</p>
                        <div class="controls">
                            <a href="#" class="fa fa-pencil"></a>
                            <a href="#" class="fa fa-trash"></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>