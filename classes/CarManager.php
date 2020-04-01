<?php


namespace classes;
require "Car.php";
require "dbConfig.php";

use classes\Car as Car;
use classes\dbConfig as dbConfig;

final class CarManager extends dbConfig
{

    private $connection;

    public function __construct()
    {
        $this->connection = parent::getConnection();
    }

    public function getCars() : array
    {
        $sql = "SELECT * FROM car ORDER BY pricePerDay ASC";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS, Car::class);
        return $statement->fetchAll();
    }

    public function getLendings() : array
    {
        $sql = "SELECT car.name AS car_name, car.img, car.pricePerDay, car_has_user.*, user.* FROM car_has_user LEFT JOIN car ON car_has_user.Car_id = car.id LEFT JOIN user ON car_has_user.User_email = user.email WHERE endDate >= CURRENT_DATE";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS, \STDClass::class);
        return $statement->fetchAll();
    }
}