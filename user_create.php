<?php
    session_start();
    require_once('mysql.php');
    include('functions.php');

    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        
        if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['mail']) && !empty($_POST['adress']) && !empty($_POST['city']) && !empty($_POST['zip']) && !empty($_POST['country']) && !empty($_POST['dpt']) && !empty($_POST['phone']) && !empty($_POST['pswd']) && !empty($_POST['pswd-confirmation']) && $_POST['pswd'] === $_POST['pswd-confirmation']){

            if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
                setcookie('firstname', $_POST['firstname']);
                $firstName = htmlspecialchars(trim($_POST['firstname']));

                setcookie('lastname', $_POST['lastname']);
                $lastName = htmlspecialchars(trim($_POST['lastname']));

                $_SESSION['mail'] = $_POST['mail'];
                $mail = $_POST['mail'];
                
                setcookie('adress', $_POST['adress']);
                $adress = htmlspecialchars(trim($_POST['adress']));

                setcookie('city', $_POST['city']);
                $city = htmlspecialchars(trim($_POST['city']));

                setcookie('zip', $_POST['zip']);
                $zip = htmlspecialchars(trim($_POST['zip']));

                setcookie('country', $_POST['country']);
                $country = htmlspecialchars(trim($_POST['country']));

                setcookie('dpt', $_POST['dpt']);
                $dpt = htmlspecialchars(trim($_POST['dpt']));

                setcookie('phone', $_POST['phone']);
                $phone = htmlspecialchars(trim($_POST['phone']));

                $pswd = htmlspecialchars(trim($_POST['pswd']));
                $password = password_hash($pswd, PASSWORD_ARGON2I);
                header('Location: account_success.php');
            }
            else{
                $_SESSION['error-form'] = 
                '<div class="alert alert-danger text-center" role="alert">
                    Le formulaire comporte une erreur
                </div>';
            }
        }

        // Si les input sont définis alors on créer la requête SQL que l'on met dans $insertUser
        if ( isset($firstName) && isset($lastName) && isset($mail) && isset($adress) && isset($city) && isset($zip) && isset($country) && isset($dpt) && isset($phone) && isset($pswd) ){

            $insertUser = $mysqlClient->prepare('INSERT INTO users(firstname, lastname, email, adress, city, zip, country, department, phone, pswd) VALUES (:firstname, :lastname, :email, :adress, :city, :zip, :country, :department, :phone, :pswd)');

        // On execute l'insertion en ajoutant dans chaque champ sa valeur correspondante reçu dans $_POST
            $insertUser->execute([
                'firstname'=> $firstName,
                'lastname'=> $lastName,
                'email' => $mail,
                'adress' => $adress,
                'city' => $city,
                'zip' => $zip,
                'country' => $country,
                'department' => $dpt,
                'phone' => $phone,
                'pswd' => $password,
            ]);
        }
        else{
            header('Location: create_account.php');
        }
    }