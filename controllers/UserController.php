<?php

class UserController
{
    private $user;

    // Méthode pour créer un user, pour user_create.php
    public function create_user($firstName, $lastName, $mail, $adress, $city, $zip, $country, $dpt, $phone, $password)
    {
        $db = $this->dbConnect();
        $insertUser = $db->prepare('INSERT INTO users(firstname, lastname, email, adress, city, zip, country, department, phone, pswd) VALUES (:firstname, :lastname, :email, :adress, :city, :zip, :country, :department, :phone, :pswd)');
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

    // Méthode pour récupérer un user par rapport à son mail, pour login.php
    public function get_user($mail)
    {
        try{
            $db = $this->dbConnect();

            // On récupère toutes les informations de l'utilisateur correspondant au $mail
            $request = "SELECT * FROM users WHERE email = :mail";
            
            $state = $db->prepare($request);
            // On lie le paramètre mail à la variable $mail donc on lie le mail de $_POST au mail de l'objet user
            $state-> bindParam("mail", $mail);

            $state->execute();
            // On récupère le mail du user
            $this->user = $state->fetch();

            // On défini en cookie le prénom et nom du user
            $firstName = $this->user['firstname'];
            $lastName = $this->user['lastname'];
            setcookie('firstname', $firstName);
            setcookie('lastname', $lastName);
            
            // On rétourne le mail récupéré du user
            return $this->user;
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    // Méthode pour supprimer un user, dans user_controller.php
    public function delete_user()
    {
        $db = $this->dbConnect();
        $deleteAccount = $db->prepare("DELETE FROM `users` WHERE `email` = :email");
        $deleteAccount->execute(
            array(
                'email' => $_SESSION['email-login']
            )
        );
    }

    // Méthode qui crée la connexion à la base de données
    private function dbConnect()
    {
        try {
        $db = new PDO(
            'mysql:host=localhost;
            dbname=sneakers_website;
            port=3306;
            charset=utf8',
            'root'
        );
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } 
        
        catch(Exception $e) {
            echo $e->getMessage();
        }

        return $db;
    }
}

