<?php

class Control 
{
    private $user;
    private $allProducts;
    private $product;
    private $fourLastProducts;
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

     public function get_product()
     {
        $request = "SELECT * FROM products WHERE product_id = ?";
        $state = $this->mysqlClient->prepare($request);
        $state->execute([$_GET['product_id']]);
        $this->product = $state->fetch();
        return $this->product;
     }

     public function get_product_cart()
     {
        $request = "SELECT * FROM products WHERE product_id = ?";
        $state = $this->mysqlClient->prepare($request);
        $state->execute([$_POST['product_id']]);
        $this->product = $state->fetch();
        return $this->product;
     }

    public function get_number_of_products()
    {
        $request = "SELECT * FROM products";
        $numberOfProducts = $this->mysqlClient->query($request)->rowCount();
        return $numberOfProducts;
    }

    public function get_all_products()
    {
        $request = "SELECT * FROM products ORDER BY date_added DESC LIMIT 12";
        $state = $this->mysqlClient->prepare($request);
        $state->execute();
        $this->allProducts = $state->fetchAll();
        return $this->allProducts;
    }
    
    public function get_four_last_products()
    {
        $request = "SELECT * FROM products ORDER BY date_added DESC LIMIT 4";
        $state = $this->mysqlClient->prepare($request);
        $state->execute();
        $this->fourLastProducts = $state->fetchAll();
        return $this->fourLastProducts;
    }

}