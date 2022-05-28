<?php

spl_autoload_register(function ($class_name) {
    require_once 'models/'.$class_name .'.php';
});

$productController  = new Product();
$userController = new User();

function listProducts()
{
    global $productController;
    require('views/productsView.php');
}

function product()
{
    global $productController;
    require('views/productView.php');
}

function cart()
{
    global $productController;
    require('views/cartView.php');
}

function home()
{
    global $productController;
    require('views/homeView.php');
}

function login()
{
    global $userController;
    require('views/loginView.php');
}

function createAccount()
{
    global $userController;
    require('views/createAccountView.php');
}

function account()
{
    global $userController;
    require('views/accountView.php');
}

function orderPage()
{
    require('views/order-pageView.php');
}

function deleteAccount()
{
    require('views/delete-accountView.php');
}

function accountSuccess()
{
    require('views/account-successView.php');
}

function logout()
{
    require('views/logoutView.php');
}