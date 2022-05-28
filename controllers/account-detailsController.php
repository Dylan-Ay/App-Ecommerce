<?php 

spl_autoload_register(function ($class_name) {
    require_once 'models/'.$class_name .'.php';
});

$userController = new User();

function detailsAccount()
{
    global $userController;
    require('views/account-detailsView.php');
}