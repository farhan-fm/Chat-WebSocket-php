<?php


class DatabaseConection
{
    function connect()
    {
        $connect = new PDO("mysql:host=localhost; dbname=chat", "root", "");

        return $connect;
    }
}