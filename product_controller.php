<?php
session_start();

spl_autoload_register(function ($class_name) {
    require_once 'model/'.$class_name . '.php';
});

$productController = new Product();

// Si $_GET a reçu le mot 'action' 
if (isset($_GET['action'])){
    // On va traiter les cas différents pour "?action=.." chaque cas est le mot clé après le '='
    switch($_GET['action']){
        
        case 'add':
            // J'utilise la méthode "get_product_cart" pour récupérer les informations du produit dont l'id est celui reçu dans "$_POST['product_id']
            $product = $productController->get_product_cart();
                foreach ($product as $key => $value) {
                }
            // J'utilise la méthode "get_size_post" pour récupérer les tailles du produit dont l'id est celui reçu dans "$_POST['product_id']"
            $product_sizes = $productController->get_size_post();
                foreach ($product_sizes as $key => $value) {
                    $sizes [] = $product_sizes[$key]['size'];
                }

            // Si le panier existe :
            if (isset($_SESSION['products']) && is_array($_SESSION['products'])) {
                
                    $product_id = (int)$_POST['product_id'];
                    $quantity = (int)$_POST['quantity'];
                    $size = (int)$_POST['size'];
                    $stockDB = $productController->get_size_quantity($product_id, $size);
                        foreach ($stockDB as $key => $value) {
                            $stock = $value; // Je récupère le stock de la taille du produit reçu en POST
                        }
                    $id = "$product_id-$size";

                    // Si dans le tableau $_SESSION['products'] la clé $id existe && que la quantité reçu en $_POST est inférieure à la quantité max du produit && que la quantité dans $_SESSION soit inférieure au stock && que la quantité en $_POST soit inférieure ou égale à la différence entre le stock du produit et la quantité déjà présente dans $_SESSION.
                    if (array_key_exists($id, $_SESSION['products']) && $quantity < $stock && $_SESSION['products'][$id]['quantity'] < $stock && $quantity <= $stock - $_SESSION['products'][$id]['quantity']){

                        // J'incrémente la quantité du produit
                        $_SESSION['products'][$id]['quantity'] += $quantity;
                        $_SESSION['products'][$id]['total'] = $product['price'] * $_SESSION['products'][$id]['quantity'];
                        unset($_SESSION['delete']);
                        // Affichage du message succès
                        $_SESSION['message'] = "<script src='js/product.js'></script>";
                        header('Location: index.php?page=product&product_id='.$_POST['product_id']);
                    
                    // Si le produit n'éxiste pas mais que $_SESSION['products'] existe :
                    // Si la clé $id n'éxiste pas dans $_SESSION && les POST sont des numériques && quantité en POST soit inférieure ou égale au stock && le stock soit différent de la quantité du produit.
                    }else if (!array_key_exists($id, $_SESSION['products']) && is_numeric($product_id) && is_numeric($quantity) && is_numeric($size) && $quantity <= $stock && $stock != $_SESSION['products'][$id]['quantity']){

                        if ($product_id && $quantity && $size){
                            $productInSession = array(
                                $product_id => $product_id, //l'id venant du $_POST['product_id']
                                'picture' => $product['picture'],
                                'name' => $product['name'],
                                'price' => $product['price'],
                                'size' => $size,
                                'quantity' => $quantity,
                                'stock' => $stock,
                                'total' => $product['price'] * $quantity //Quantité venant du $_POST['quantity']
                            );
                            $id = "$product_id-$size";
                            $_SESSION['products'] [$id] = $productInSession;
                            $_SESSION['message'] = "<script src='js/product.js'></script>";
                            header('Location: index.php?page=product&product_id='.$_POST['product_id']);
                        }
                    }
                    else{
                        $_SESSION['message'] = 
                        "<div class='alert alert-danger text-center' role='alert'>
                            La quantité maximale de ce produit est atteinte.
                        </div>";
                        header('Location: index.php?page=product&product_id='.$_POST['product_id']);
                    }
                }else{ 
                    // Si le panier n'existe pas :
                    // Si $_POST['product_id'],quantity et size sont définis, && qu'ils possèdent une valeur numérique && que l'id en POST correspond à un id qui existe en base && que la taille en POST existe en base.

                    if (isset($_POST['product_id'], $_POST['size'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['size']) && is_numeric($_POST['quantity']) && $_POST['product_id'] === $product['product_id'] && in_array($_POST['size'], $sizes)){
                        $product_id = (int)$_POST['product_id'];
                        $size = (int)$_POST['size'];
                        $quantity = (int)$_POST['quantity'];
                        $stockDB = $productController->get_size_quantity($product_id, $size);
                        foreach ($stockDB as $key => $value) {
                            $stock = $value; // Je récupère le stock de la taille du produit reçu en POST
                        }
                    }
                    // Si la quantité en POST est inférieur ou égal à la quantité en base du produit en cours
                        if ($quantity <= $stock){

                            // Si les conditions sont vraies ($product_id && size && $quantity) Alors on ajoute le contenu de chaque champ dans $productInSession
                            if ($product_id && $size && $quantity){
                                $productInSession = array(
                                    $product_id => $product_id, //l'id venant du $_POST['product_id']
                                    'picture' => $product['picture'],
                                    'name' => $product['name'],
                                    'price' => $product['price'],
                                    'size' => $size,
                                    'quantity' => $quantity,
                                    'stock' => $stock, // Stock récupéré grâce à la méthode get_size_quantity
                                    'total' => $product['price'] * $quantity //Quantité venant du $_POST['quantity']
                                );
                                
                                // Affichage du message succès
                                // On défini l'id de l'entrée dans $_SESSION['products'] grâce à l'id du produit + la taille ajouté
                                $id = "$product_id-$size";
                                $_SESSION['products'] [$id] = $productInSession;
                                $_SESSION['message'] = "<script src='js/product.js'></script>";
                                header('Location: index.php?page=product&product_id='.$_POST['product_id']);
                                
                            }else{
                                // Affichage du message d'erreur, si les champs sont mal remplis
                                $_SESSION['message'] = 
                                '<div class="alert alert-danger text-center" role="alert">
                                    Le formulaire comporte une erreur.
                                </div>';
                                header('Location: index.php?page=product&product_id='.$_POST['product_id']);
                            }
                        }else{
                            // Affichage du message d'erreur, si la quantité inséré n'est pas disponible
                            $_SESSION['message'] = 
                            "<div class='alert alert-danger text-center' role='alert'>
                                La quantité inséré n'est pas disponible pour ce produit.
                            </div>";
                            header('Location: index.php?page=product&product_id='.$_POST['product_id']);
                        }
                    }

                // Suite du case
                break;

        // Le cas de ?action=continue-purchase
        case "continue-purchase":
            //On unset toutes les valeurs du tableau $_SESSION['products'] et on redirige vers le panier
            unset($_SESSION['message']);
            header('Location: index.php?page=products');
            break;

        // Le cas de ?action=delete-unit
        case "delete-unit":
            //Si $_GET a reçu un index en paramètre ( ?action=delete-unit&index=...) alors on récupère l'index dans $index, Si products contient un seul produit il vide le panier
            if (isset($_GET['index'])){
                $index = $_GET["index"];
                if (count($_SESSION['products']) == 1){
                    unset($_SESSION['products']);
                }
                //Si une entrée est présente dans products on ajoute à $name le produit on unset ce produit grâce à son index récupéré dans $_GET['index']
                else if (isset($_SESSION['products'][$index])){
                    $name = $_SESSION['products'][$index]['name'];
                    $size = $_SESSION['products'][$index]['size'];
                    unset($_SESSION['products'][$index]);
                    unset($_SESSION['message']);
                    $_SESSION['delete'] = 
                    "<div class='alert alert-success text-center' role='alert'>
                        L'article '<strong>$name'</strong> en taille <strong>$size</strong> a bien été supprimé du panier.
                    </div>";
                }else{
                    echo "Un problème est survenu.";
                }
            }
            header("Location: index.php?page=cart"); 
            break;

        // Le cas de ?action=increase
        case "increase":
            //Si $_GET a reçu un index en paramètre ( ?action=increase&index=...) alors on récupère l'index dans $index 
            if (isset($_GET['index'])){
                $index = $_GET['index'];
                // Si une entrée est dans products et que la quantité de cette entrée est inférieure ou égale à sa quantité max et que la quantité actuel est différente de sa quantité max
                if (isset($_SESSION['products'][$index]) && $_SESSION['products'][$index]['quantity'] <= $_SESSION['products'][$index]['stock'] && $_SESSION['products'][$index]['quantity'] != $_SESSION['products'][$index]['stock'] ){
                    //On incrémente la quantié de 1 de l'entrée et on additione le prix au total à chaque envoi dans $_GET
                    $_SESSION['products'][$index]['quantity'] = $_SESSION['products'][$index]['quantity'] + 1;
                    $_SESSION['products'][$index]['total'] += $_SESSION['products'][$index]['price'];
                    unset($_SESSION['message']);
                    unset($_SESSION['delete']);
                }
                else{
                    $name = $_SESSION['products'][$index]['name'];
                    $size = $_SESSION['products'][$index]['size'];
                    $_SESSION['delete'] = 
                    "<div class='alert alert-danger text-center' role='alert'>
                        La quantité maximale de l'article '<strong>$name'</strong> en taille $size est atteinte.
                    </div>";
                }
            }
            header('Location: index.php?page=cart');
            break;

        // Le cas de ?action=decrease
        case "decrease":
            //Si $_GET a reçu un index en paramètre ( ?action=decrease&index=...) alors on récupère l'index dans $index 
            if (isset($_GET['index'])){
                $index = $_GET['index'];
                //Si un index existe, et si la quantité est supérieur à 0 et si le total est supérieur à 0 Alors on décrémente la quantité de 1 et on soustrait le prix au total à chaque clique
                if (isset($_SESSION['products'][$index]) && $_SESSION['products'][$index]['quantity'] > 1){
                    $_SESSION['products'][$index]['quantity'] = $_SESSION['products'][$index]['quantity'] - 1;
                    $_SESSION['products'][$index]['total'] -= $_SESSION['products'][$index]['price'];
                    unset($_SESSION['message']);
                    unset($_SESSION['delete']);
                }else if (isset($_SESSION['products'][$index]) && $_SESSION['products'][$index]['quantity'] === 1){
                    $name = $_SESSION['products'][$index]['name'];
                    $size = $_SESSION['products'][$index]['size'];
                    unset($_SESSION['products'][$index]);
                    $_SESSION['delete'] = 
                    "<div class='alert alert-success text-center' role='alert'>
                        L'article '<strong>$name</strong>' en taille <strong>$size</strong> a bien été supprimé de la liste.
                    </div>";
                }
            }
            header('Location: index.php?page=cart');
            break;

        // Le cas de ?action=order lorsqu'on clique sur commander dans recap.php
        case "order":
            
            if (isset($_SESSION['email-login'])){
                header('Location: order_page.php');
                unset($_SESSION['delete']);
                unset($_SESSION['message']);
                unset($_SESSION['wrong-id']);
                unset($_SESSION['error-form']);
                unset($_SESSION['wrong-id']);
            }else{
                header('Location: login.php');
                unset($_SESSION['delete']);
                unset($_SESSION['message']);
                unset($_SESSION['wrong-id']);
                unset($_SESSION['error-form']);
                unset($_SESSION['wrong-id']);
            }
            break;

        // Lorsqu'on clique sur le panier cela enlève les différents messages en session
        case "unset-panier":
            unset($_SESSION['delete']);
            unset($_SESSION['message']);
            unset($_SESSION['wrong-id']);
            unset($_SESSION['error-form']);
            unset($_SESSION['wrong-id']);
            header('Location:index.php?page=cart');
            break;

        // Lorsqu'on clique sur le logo accueil cela enlève les différents messages en session
        case "unset-accueil":
            unset($_SESSION['delete']);
            unset($_SESSION['message']);
            unset($_SESSION['wrong-id']);
            unset($_SESSION['error-form']);
            unset($_SESSION['wrong-id']);
            header('Location: index.php');
            break;

        case "close-btn":
            $index = $_GET["product_id"];
            unset($_SESSION['delete']);
            unset($_SESSION['message']);
            unset($_SESSION['wrong-id']);
            unset($_SESSION['error-form']);
            unset($_SESSION['wrong-id']);
            header("location:".$_SERVER['HTTP_REFERER']);
            break;
    }
}else {
    echo "Un problème est survenu";
}