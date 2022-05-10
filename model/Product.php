<?php

class Product 
{
    private $allProducts;
    private $product;
    private $fourLastProducts;

    public function __construct()
    {
        
    }

    // Méthode pour afficher dynamiquement chaque produit en fonction de son ID récupéré en $_GET pour product.php
    public function get_product()
    {
        $db = $this->dbConnect();
        $request = "SELECT * FROM products WHERE product_id = ?";
        $state = $db->prepare($request);
        $state->execute([$_GET['product_id']]);
        $this->product = $state->fetch();
        return $this->product;
    }

    // Méthode pour récuperer le produit selon l'ID reçu en paramètre, à partir de $_SESSION['visited_pages'] pour cart.php
    public function get_seen_product($id)
    {
        $db = $this->dbConnect();
        $request = "SELECT * FROM products WHERE product_id = ?";
        $state = $db->prepare($request);
        $state->execute([$id]);
        $this->product = $state->fetch();
        return $this->product;
    }

    // Méthode pour récupérer le produit en base et ensuite l'ajouter au panier, à partir du $_POST['product_id'] pour product_controller.php
    public function get_product_cart()
    {
        $db = $this->dbConnect();
        $request = "SELECT * FROM products WHERE product_id = ?";
        $state = $db->prepare($request);
        $state->execute([$_POST['product_id']]);
        $this->product = $state->fetch();
        return $this->product;
    }

    // Méthode pour récupérer le nombre de produits qui se trouve en base de données
    public function get_number_of_products()
    {
        $db = $this->dbConnect();
        $request = "SELECT * FROM products";
        $numberOfProducts = $db->query($request)->rowCount();
        return $numberOfProducts;
    }

    // Méthode pour récupérer les 12 derniers produits ajoutés en base de données, classé par date du plus récent.
    public function get_all_products()
    {
        $db = $this->dbConnect();
        $request = "SELECT * FROM products ORDER BY date_added DESC LIMIT 12";
        $state = $db->prepare($request);
        $state->execute();
        $this->allProducts = $state->fetchAll();
        return $this->allProducts;
    }

    // Méthode pour récupérer les 4 derniers produits ajoutés en base de données, classé par date du plus récent.
    public function get_four_last_products()
    {
        $db = $this->dbConnect();
        $request = "SELECT * FROM products ORDER BY date_added DESC LIMIT 4";
        $state = $db->prepare($request);
        $state->execute();
        $this->fourLastProducts = $state->fetchAll();
        return $this->fourLastProducts;
    }

    // Méthode pour récupérer les tailles du produit reçu dans $_GET (pour product.php)
    public function get_product_sizes()
    {
        $db = $this->dbConnect();
        $request = "SELECT * FROM products_size WHERE product_id = ?";
        $state = $db->prepare($request);
        $state->execute([$_GET['product_id']]);
        $this->product = $state->fetchAll();
        return $this->product;
    }

    // Méthode pour récupérer les tailles du produit reçu dans $_POST (pour product_controller.php)
    public function get_size_post()
    {
        $db = $this->dbConnect();
        $request = "SELECT * FROM products_size WHERE product_id = ?";
        $state = $db->prepare($request);
        $state->execute([$_POST['product_id']]);
        $this->product = $state->fetchAll();
        return $this->product;
    }

    // Méthode pour récupérer le stock de la taille d'un produit
    public function get_size_quantity($product_id, $size)
    {
        $db = $this->dbConnect();
        $request = "SELECT `stock` FROM `products_size` WHERE `product_id` = $product_id AND `size` = $size";
        $state = $db->prepare($request);
        $state->execute();
        $this->product = $state->fetch();
        return $this->product;
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