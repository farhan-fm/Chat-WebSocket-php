<?php


class DatabaseConection
{
    function connect()
    {
        $connect = new PDO("mysql:host=localhost; dbname=chitchat", "root", "");

        return $connect;
    }
}