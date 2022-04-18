<?php

try {
    $mysqlClient = new PDO(
        'mysql:host=localhost;
        dbname=sneakers_website;
        port=3306;
        charset=utf8',
        'root'
    );
    $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}