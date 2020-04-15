<?php


namespace classes;

require "Car.php";
require "Car_has_user.php";
require "dbConfig.php";
require "ImageManager.php";

use classes\Car as Car;
use classes\dbConfig as dbConfig;
use classes\Car_has_user as Lending;
use classes\ImageManager;

final class CarManager extends dbConfig
{

    private $connection;
    private $imageManager;

    public function __construct()
    {
        $this->connection = parent::getConnection();
        $this->imageManager = new ImageManager();
    }


    public function getCars(): array
    {
        $sql = "SELECT * FROM car ORDER BY pricePerDay ASC";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS, Car::class);
        return $statement->fetchAll();
    }

    public function getCar(int $id): array
    {
        $sql = "SELECT * FROM car WHERE id = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$id]);
        $statement->setFetchMode(\PDO::FETCH_ASSOC);
        return $statement->fetch();
    }

    public function insertCar(string $name, array $files, int $pricePerDay): bool
    {
        try {
            $img = $this->imageManager->uploadImage($files);
        } catch (ImageException $e) {
            throw new CarException($e->getMessage());
        }
        $sql = "INSERT INTO car(name, img, pricePerDay) VALUES (:name, :img, :pricePerDay)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":img", $img);
        $stmt->bindParam(":pricePerDay", $pricePerDay);
        return $stmt->execute();
    }

    public function updateCar(int $id, string $name, int $pricePerDay, array $files = []): bool
    {
        if (empty($files)) {
            $sql = "UPDATE `car` SET name = :name, pricePerDay = :pricePerDay WHERE id = :id";
        } else {
            $sql = "SELECT img FROM car WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            $stmt->setFetchMode(\PDO::FETCH_ASSOC);
            $imgName = $stmt->fetch()["img"];
            try {
                $this->imageManager->deleteImage($imgName != null ? $imgName : "");
                $img = $this->imageManager->uploadImage($files);
            } catch (ImageException $e) {
                throw new CarException($e->getMessage());
            }
            
            $sql = "UPDATE `car` SET name = :name, pricePerDay = :pricePerDay, img = :img WHERE id = :id";
        }
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":pricePerDay", $pricePerDay);
        !empty($files) ? $stmt->bindParam(":img", $img) : "";
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function deleteCar(int $id): void
    {
        $sql = "SELECT img FROM car WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $name = $stmt->fetch()["img"];
        try {
            $this->imageManager->deleteImage($name != null ? $name : "");
        } catch (ImageException $e) {
            throw new CarException($e->getMessage());
        }
        $sql = "DELETE FROM car_has_user WHERE Car_id = :id; DELETE FROM car WHERE id = :id;";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(["id" => $id]);
    }

    public function getLendings(): array
    {
        $sql = "SELECT car.name AS car_name, car.img, car.pricePerDay, car_has_user.*, user.* FROM car_has_user LEFT JOIN car ON car_has_user.Car_id = car.id LEFT JOIN user ON car_has_user.User_email = user.email WHERE endDate >= CURRENT_DATE ORDER BY endDate ASC";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS, Lending::class);
        return $statement->fetchAll();
    }
}

class CarException extends \Exception
{
}
