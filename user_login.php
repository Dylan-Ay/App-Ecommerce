<?php
    session_start();
    include_once('mysql.php');

    if ($_SERVER["REQUEST_METHOD"] === "POST"){

        if ( empty($_POST["email-login"] || empty($_POST["password-login"])) ){
            $_SESSION['wrong-id'] = 
                '<div class="alert alert-danger text-center" role="alert">
                    Veuillez remplir les champs du formulaire.
                </div>';
        }else{

            // Query SQL
            $isUserExists = $mysqlClient->prepare("SELECT * FROM users WHERE email = :email AND pswd = :pswd"); 
            $isUserExists->execute(  
                array(  
                        'email' => $_POST["email-login"],  
                        'pswd' => $_POST["password-login"]  
                )  
            );  
            $count = $isUserExists->rowCount();  

            if ($count > 0){  
                $_SESSION['mail'] = $_POST["email-login"];  
                header("Location: account.php");  
            }else{
                $_SESSION['wrong-id'] = 
                    '<div class="alert alert-danger text-center" role="alert">
                        Erreur : aucun résultat ne correspond à cette adresse électronique et/ou mot de passe.
                        Merci de réessayer.
                    </div>';
                header('Location: login.php');
            }
        }
    }