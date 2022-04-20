<?php

try {
    $mysqlClient = new PDO(
        'mysql:host=localhost;
        dbname=sneakers_website;
        port=3306;
        charset=utf8',
        'root'
    );
    $mysqlClient->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(Exception $e) {
    echo $e->getMessage();
}