<?php

namespace output;

require "classes/CarManager.php";
include "header.php";

if (!$user->isAdmin()) {
    header("Location: index.php");
}

use classes\CarManager;

$manager = new CarManager();

$cars = $manager->getCars();

?>

<h1>Administrace vozidel</h1>
<div class="wrapper">
    <div class="cars">
        <?php foreach ($cars as $car) : ?>
            <div class="car">
                <h1><?= $car->getName() ?></h1>
                <img src="images/<?= $car->getImg() ?>" alt="">
                <h2>Cena za den: <?= $car->getPricePerDay() ?> Kč</h2>
                <a href="#carFormModal" value="<?= $car->getId() ?>" class="fa fa-pencil updateCar"></a>
                <a href="" value="<?= $car->getId() ?>" class="fa fa-trash deleteCar"></a>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="#carFormModal" class="fa fa-plus"></a>
</div>
<script src="js/admin.js"></script>
<div class="modal close" id="carFormModal">
    <div class="modalCloseDiv">
        <a href="#carFormModal" class="fa fa-times" class="modalClose"></a>
    </div>
    <form action="" enctype="multipart/form-data">
        <h2></h2>
        <input type="text" name="name" id="nameInput" placeholder="Název auta" required>
        <input type="number" name="pricePerDay" id="priceInput" placeholder="Cena za den" required>
        <input type="file" name="image" id="imageInput" placeholder="Obrázek vozidla">
        <input type="hidden" name="carForm" value="insert" id="hiddenInput">
        <input type="submit" value="Odeslat">
    </form>
</div>
<div class="modalOverlay close" id="modalOverlay">
</div>
</body>

</html>