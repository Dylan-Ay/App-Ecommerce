<?php
session_start();

spl_autoload_register(function ($class_name) {
    require_once 'models/'.$class_name . '.php';
});

$userController = new User();

// Si $_GET a reçu le mot 'action' 
if (isset($_GET['action'])){
    // On va traiter les cas différents pour "?action=.." chaque cas est le mot clé après le '='
    switch($_GET['action']){

        // Cas de la déconnexion
        case "logout":
            unset($_SESSION['email-login']);
            setcookie('firstname', '', time()-1000);
            setcookie('lastname', '', time()-1000);
            header('Location: index.php?page=logout');
            break;
        // Cas de la suppression de compte
        case "delete-account":
            $userController->delete_user();
            
                if ( isset($_SERVER['HTTP_COOKIE']) || isset($_SESSION['email-login']) ){
                    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
                    foreach ($cookies as $cookie) {
                        $parts = explode('=', $cookie);
                        $name = trim($parts[0]);
                        setcookie($name, '', time()-1000);
                        setcookie($name, '', time()-1000, '/');
                    }
                    unset($_SESSION);
                }
                header('Location: index.php?page=delete-account');
                break;
            }
        }else {
            echo "Un problème est survenu";
        }