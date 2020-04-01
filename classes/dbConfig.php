<?php


namespace classes;


abstract class dbConfig
{
    const DSN = "mysql:dbname=...;host=...;charset=utf8";
    const USER = "root";
    const PASS = "";

    protected function getConnection() : \PDO
    {
        return new \PDO(self::DSN,self::USER,self::PASS);
    }

}
