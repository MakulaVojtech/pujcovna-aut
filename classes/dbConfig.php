<?php


namespace classes;


abstract class dbConfig
{
    private const DSN = "mysql:dbname=...;host=...;charset=utf8";
    private const USER = "root";
    private const PASS = "";

    protected function getConnection() : \PDO
    {
        return new \PDO(self::DSN,self::USER,self::PASS);
    }

}
