<?php

namespace output;

require "classes/CarManager.php";
include "header.php";

use classes\CarManager as Manager;

$manager = new Manager();
$lendings = $manager->getLendings();

if(!$user->isAdmin()){
    header("Location: index.php");
}



?>

    <h1>Administrace vypůjčených aut</h1>
    <div class="lendings">
        <?php foreach ($lendings as $lending) : ?>
            <div class="lending">
                <div class="cardiv">
                    <h1><?= $lending->getCar_name() ?></h1>
                    <img src="images/<?= $lending->getImg() ?>">
                    <p>Cena za den: <?= $lending->getPricePerDay() ?> Kč</p>
                </div>
                <div class="right">
                    <div class="contact">
                        <h1><?= $lending->getName() ?> <?= $lending->getSurname() ?></h1>
                        <p><?= $lending->getEmail() ?></p>
                        <p><?= $lending->getPhone() ?></p>
                    </div>
                    <div class="lendingdiv">
                        <b><?= ($lending->getStartDate() == $lending->getEndDate()) ? (date_format(date_create($lending->getStartDate()), "d. m. Y")) : (date_format(date_create($lending->getStartDate()), "d. m. Y") . " - " .  date_format(date_create($lending->getEndDate()), "d. m. Y")) ?></b>
                        <?php
                        $dny = date_diff(date_create($lending->getStartDate()), date_create($lending->getEndDate()), true)->days + 1;
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