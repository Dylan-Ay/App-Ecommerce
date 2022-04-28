<?php
    session_start();
    require_once('mysql.php');
    require_once('Control.php');
    // On crée une instance de Control en utilisant l'objet PDO de mysql.php
    $control = new Control($mysqlClient);
    header('Location: index.php');
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        
        if ( empty($_POST["email-login"] || empty($_POST["password-login"])) ){
            $_SESSION['wrong-id'] = 
            '<div class="alert alert-danger text-center" role="alert">
                Veuillez remplir les champs du formulaire.
            </div>';
        }
        if (!empty($_POST['website'])){
            header('Location: login.php');
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
            $user = $control->get_user($email);
            // On vérifie que le password reçu en $_POST corresponde au password de l'user récupéré
            if (password_verify($password, $user['pswd'])){
                $_SESSION['email-login'] = $email;
                
                header('Location: account.php');
                unset($_SESSION['wrong-id']);
            }
            else{
                $_SESSION['wrong-id'] = 
                '<div class="alert alert-danger text-center" role="alert">
                    Erreur : aucun résultat ne correspond à cette adresse électronique et/ou mot de passe.
                    Merci de réessayer.
                </div>';
                header('Location: login.php');
            }
        }
    }