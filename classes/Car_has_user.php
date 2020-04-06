<?php

namespace classes;

final class Car_has_user
{

    private $car_name, $img, $pricePerDay, $name, $surname, $email, $phone, $startDate, $endDate;

    public function getCar_name() : string
    {
        return $this->car_name;
    }

    public function getImg() : string
    {
        return $this->img;
    }
 
    public function getPricePerDay() : int
    {
        return $this->pricePerDay;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getSurname() : string
    {
        return $this->surname;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function getPhone() : string
    {
        return $this->phone;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }
}