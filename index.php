<?php 
    session_start();
    //Router
    $page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';

    // On défini le title de la page avec le nom de la page et on utilise ucfirst la première lettre en majuscule
    $title = ucfirst($page);

    //Inclusion du header pour chaque page, de la config PDO et de la class Control
    include('header.php');
    
    spl_autoload_register(function ($class_name) {
        require_once 'model/'.$class_name . '.php';
    });

    //Instanciation de la class Control pour chaque page produit
    $productController = new Product();

    // Include la page demandé 
    include $page . '.php';
    

    //Include du footer
    include('footer.php');