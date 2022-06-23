<?php

class HomeController{

    public function getHomePage()
    {
        global $productController;
        require_once('views/home/home.php');
    }
}