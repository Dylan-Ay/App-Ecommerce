<?php

require_once('controllers/ProductController.php');
require_once('controllers/UserController.php');

$productController  = new ProductController();
$userController = new UserController();

function listProducts()
{
    global $productController;
    require('views/product/productsList.php');
}

function product()
{
    global $productController;
    require('views/product/productDetail.php');
}