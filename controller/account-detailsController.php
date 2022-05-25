<?php 
// Problème à résoudre
spl_autoload_register(function ($class_name) {
    require 'models/'.$class_name .'.php';
});

$userController = new User();

if (isset($_SESSION['email-login'])){
    $userInformations = $userController->get_user($_SESSION['email-login']);

    foreach ($userInformations as $key => $value) {

    }
    $firstName = $userInformations['firstname'];
    $lastName = $userInformations['lastname'];
    $email = $userInformations['email'];
    $number = $userInformations['phone'];
}

function detailsAccount()
{
    require('views/account-detailsView.php');
}