<?php
    session_start();

    spl_autoload_register(function ($class_name) {
        require_once 'models/'.$class_name . '.php';
    });

    $userController = new User();
    header('Location: index.php');
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        
        if ( empty($_POST["email-login"] || empty($_POST["password-login"])) ){
            $_SESSION['wrong-id'] = 
            '<div class="alert alert-danger text-center" role="alert">
                Veuillez remplir les champs du formulaire.
            </div>';
        }
        if (!empty($_POST['website'])){
            header('Location: index.php?page=login');
            exit();
        }
        else{
            $email = htmlentities(trim($_POST['email-login']));
            $password = $_POST["password-login"];
            
            if (isset($_SESSION['wrong-id']) || isset($_SESSION['error-form'])){
                unset($_SESSION['wrong-id']);
                unset($_SESSION['error-form']);
            }

            // On récupère l'objet user qui correspond au mail en paramètre
            $user = $userController->get_user($email);
            // On vérifie que le password reçu en $_POST corresponde au password de l'user récupéré
            if (password_verify($password, $user['pswd'])){
                $_SESSION['email-login'] = $email;
                
                header('Location: index.php?page=account');
                unset($_SESSION['wrong-id']);
            }
            else{
                $_SESSION['wrong-id'] = 
                '<div class="alert alert-danger text-center" role="alert">
                    Erreur : aucun résultat ne correspond à cette adresse électronique et/ou mot de passe.
                    Merci de réessayer.
                </div>';
                header('Location: index.php?page=login');
            }
        }
    }