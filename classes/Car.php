<?php


namespace classes;



final class Car
{
    private $id;
    private $name;
    private $img;
    private $pricePerDay;



    public function getId() : int
    {
        return $this->id;
    }
    public function getName() : string
    {
        return $this->name;
    }
    public function getImg() :string
    {
        return $this->img;
    }
    public function getPricePerDay() : int
    {
        return $this->pricePerDay;
    }
}