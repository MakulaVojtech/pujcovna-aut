<?php

namespace handler;

require "../classes/CarManager.php";

use classes\CarException;
use classes\CarManager;

$carManager = new CarManager();

if (isset($_REQUEST["deleteCar"])) {
    try {
        $carManager->deleteCar($_REQUEST["deleteCar"]);
        echo  true;
    } catch (CarException $e) {
        echo "<p class='error'>{$e->getMessage()}</p>";
    }
}

if (isset($_GET["carUpdateForm"])) {
    echo json_encode($carManager->getCar($_GET["carUpdateForm"]));
}

if (isset($_POST["carForm"])) {
    if ($_POST["carForm"] == "insert") {
        try {
            $carManager->checkInsertValues($_POST["name"], $_POST["pricePerDay"]);
            if ($carManager->insertCar(htmlspecialchars($_POST["name"]), $_FILES, $_POST["pricePerDay"])) {
                echo true;
            } else {
                echo "<p class='error'>Něco se nepovedlo, zkuste to prosím za chvíli.</p>";
            }
        } catch (CarException $e) {
            echo "<p class='error'>{$e->getMessage()}</p>";
        }
    } elseif ($_POST["carForm"] >= 0) {
        $id = $_POST["carForm"];
        try {
            $carManager->checkInsertValues($_POST["name"], $_POST["pricePerDay"]);
            $files = isset($_FILES["image"]) && !empty($_FILES["image"]) ? $_FILES : [];
            if($carManager->updateCar(intval($id), htmlspecialchars($_POST["name"]), htmlspecialchars($_POST["pricePerDay"]), $files)){
                echo true;
            }else{
                echo "<p class='error'>Něco se nepovedlo, zkuste to prosím za chvíli.</p>";
            }
        } catch (CarException $e) {
            echo "<p class='error'>{$e->getMessage()}</p>";
        }
    }
}
