<?php
    class Control 
    {
        private $user;
        private $mysqlClient;

        public function __construct($mysqlClient)
        {
            $this->mysqlClient = $mysqlClient;
        }

        public function get_user($mail)
        {
            try{
                // On récupère toutes les informations de l'utilisateur correspondant au $mail
                $request = "SELECT * FROM users WHERE email = :mail";
                
                $state = $this->mysqlClient->prepare($request);
                // On lie le paramètre mail à la variable $mail donc on lie le mail de $_POST au mail de l'objet user
                $state-> bindParam("mail", $mail);

                $state->execute();
                // On récupère le mail de l'user
                $this->user = $state->fetch();
                // On rétourne le mail récupéré du user
                return $this->user;
            }
            catch(Exception $e) {
                echo $e->getMessage();
            }
        }
    }