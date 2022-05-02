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
    // Méthode pour afficher dynamiquement chaque produit en fonction de son ID récupéré en $_GET pour product.php
    public function get_product()
    {
        $request = "SELECT * FROM products WHERE product_id = ?";
        $state = $this->mysqlClient->prepare($request);
        $state->execute([$_GET['product_id']]);
        $this->product = $state->fetch();
        return $this->product;
    }
    // Méthode pour récupérer le produit en base et ensuite l'ajouter au panier, à partir du $_POST['product_id'] pour traitement.php
    public function get_product_cart()
    {
        $request = "SELECT * FROM products WHERE product_id = ?";
        $state = $this->mysqlClient->prepare($request);
        $state->execute([$_POST['product_id']]);
        $this->product = $state->fetch();
        return $this->product;
    }
    // Méthode pour récupérer le nombre de produits qui se trouve en base de données
    public function get_number_of_products()
    {
        $request = "SELECT * FROM products";
        $numberOfProducts = $this->mysqlClient->query($request)->rowCount();
        return $numberOfProducts;
    }
    // Méthode pour récupérer les 12 derniers produits ajoutés en base de données, classé par date du plus récent.
    public function get_all_products()
    {
        $request = "SELECT * FROM products ORDER BY date_added DESC LIMIT 12";
        $state = $this->mysqlClient->prepare($request);
        $state->execute();
        $this->allProducts = $state->fetchAll();
        return $this->allProducts;
    }
    // Méthode pour récupérer les 4 derniers produits ajoutés en base de données, classé par date du plus récent.
    public function get_four_last_products()
    {
        $request = "SELECT * FROM products ORDER BY date_added DESC LIMIT 4";
        $state = $this->mysqlClient->prepare($request);
        $state->execute();
        $this->fourLastProducts = $state->fetchAll();
        return $this->fourLastProducts;
    }
    // Méthode pour récupérer les tailles du produit reçu dans $_GET (pour product.php)
    public function get_product_sizes()
    {
        $request = "SELECT * FROM products_size WHERE product_id = ?";
        $state = $this->mysqlClient->prepare($request);
        $state->execute([$_GET['product_id']]);
        $this->product = $state->fetchAll();
        return $this->product;
    }
    // Méthode pour récupérer les tailles du produit reçu dans $_POST (pour traitement.php)
    public function get_size_post()
    {
        $request = "SELECT * FROM products_size WHERE product_id = ?";
        $state = $this->mysqlClient->prepare($request);
        $state->execute([$_POST['product_id']]);
        $this->product = $state->fetchAll();
        return $this->product;
    }
    // Méthode pour récupérer le stock de la taille d'un produit
    public function get_size_quantity($product_id, $size)
    {
        $request = "SELECT `stock` FROM `products_size` WHERE `product_id` = $product_id AND `size` = $size";
        $state = $this->mysqlClient->prepare($request);
        $state->execute();
        $this->product = $state->fetch();
        return $this->product;
    }
}