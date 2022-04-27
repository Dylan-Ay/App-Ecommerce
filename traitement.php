<?php
session_start();
require_once('mysql.php');
require_once('Control.php');
$control = new Control($mysqlClient);

// Si $_GET a reçu le mot 'action' 
if (isset($_GET['action'])){
    //On va traiter les cas différents pour "?action=.." chaque cas est le mot clé après le '='
    switch($_GET['action']){
        // Le cas de ?action=add
        case 'add':
            // J'utilise la méthode "get_product_cart" pour récupérer les informations du produit dont l'id est celui reçu dans "$_POST['product_id']"
            $product = $control->get_product_cart();
            foreach ($product as $key => $value) {
            }
            if (isset($_SESSION['products'])){
                foreach ($_SESSION['products'] as $index => $value) {
                    // Je boucle dans $_SESSION['products'] pour récupérer la clé qui existe pour chaque entrée du tableau
                }
            }

            if (isset($_SESSION['products']) && is_array($_SESSION['products'])) {
                
                    $product_id = (int)$_POST['product_id'];
                    $quantity = (int)$_POST['quantity'];

                    // Si dans le tableau $_SESSION['products'][$index] le nom du produit dont l'id est celui reçu en $_POST existe et que la quantité reçu en $_POST est inférieure à la quantité max du produit et que la quantité inséré en $_POST soit inférieure ou égale à la différence entre la max quantity du produit et la quantity actuel
                    if (in_array($product['name'], $_SESSION['products'][$index]) && $quantity < $product['quantity'] && $_SESSION['products'][$index]['quantity'] < $_SESSION['products'][$index]['max-quantity'] && $quantity <= $_SESSION['products'][$index]['max-quantity'] - $_SESSION['products'][$index]['quantity'] ){
                        // J'incrémente la quantité du produit
                        $_SESSION['products'][$index]['quantity'] += $quantity;
                        $_SESSION['products'][$index]['total'] = $product['price'] * $_SESSION['products'][$index]['quantity'];
                        unset($_SESSION['delete']);
                        $_SESSION['message'] = 
                        '<div class="alert alert-success text-center" role="alert">
                            Le produit a bien été ajouté à la liste si $SESSION existe et que on incrémente la quantité.
                        </div>';
                        header('Location: index.php?page=product&product_id='.$_POST['product_id']);
                        
                    }else if (!in_array($product['name'], $_SESSION['products'][$index]) && is_numeric($product_id) && is_numeric($quantity) && $quantity <= $product['quantity'] ){
                        //$_SESSION['quantity'][$index] < $_SESSION['products'][$index]['max-quantity']
                        if ($product_id && $quantity){
                            $productInSession = array(
                                $product_id => $product_id, //l'id venant du $_POST['product_id']
                                'picture' => $product['picture'],
                                'name' => $product['name'],
                                'price' => $product['price'],
                                'quantity' => $quantity,
                                'max-quantity' => $product['quantity'],
                                'total' => $product['price'] * $_SESSION['products'][$index]['quantity'] //Quantité venant du $_POST['quantity']
                            );
                            $_SESSION['products'] [$product_id] = $productInSession;
                            $_SESSION['message'] = 
                            '<div class="alert alert-success text-center" role="alert">
                                Le produit a bien été ajouté et la quantité a été mise à jour.
                            </div>';
                            header('Location: index.php?page=product&product_id='.$_POST['product_id']);
                        }
                    }
                    else{
                        $_SESSION['message'] = 
                        "<div class='alert alert-danger text-center' role='alert'>
                            La quantité maximale de ce produit est de ". $product['quantity'].".
                        </div>";
                        header('Location: index.php?page=product&product_id='.$_POST['product_id']);
                    }
                }else{
                    
                    // Si $_POST['product_id'] et $_POST['quantity'] sont définis, et qu'ils possèdent une valeur numérique et que l'id inséré correspond à un id qui existe en base et que la quantité inséré est inférieur ou égal à la quantité en base
                    if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity']) && $_POST['product_id'] === $product['product_id'] && $_POST['quantity'] <= $product['quantity']){ 
                        $product_id = (int)$_POST['product_id'];
                        $quantity = (int)$_POST['quantity'];
                        
                        // Si les conditions sont vraies ($product_id && $quantity)
                        // Alors on ajoute le contenu de chaque champ dans $productInSession
                        if ($product_id && $quantity){
                            $productInSession = array(
                                $product_id => $product_id, //l'id venant du $_POST['product_id']
                                'picture' => $product['picture'],
                                'name' => $product['name'],
                                'price' => $product['price'],
                                'quantity' => $quantity,
                                'max-quantity' => $product['quantity'],
                                'total' => $product['price'] * $quantity //Quantité venant du $_POST['quantity']
                            );
                            
                            //On attribut à $_SESSION['message'] une div si le produit a bien été ajouté
                            $_SESSION['products'] [$product_id] = $productInSession;
                            $_SESSION['message'] = 
                            '<div class="alert alert-success text-center" role="alert">
                                Le produit a bien été ajouté à la liste si $SESSION est pas defini.
                            </div>';
                            header('Location: index.php?page=product&product_id='.$_POST['product_id']);
                            
                        }else{
                            //On attribut à $_SESSION['message'] une div si le formulaire comporte une erreur
                            $_SESSION['message'] = 
                            '<div class="alert alert-danger text-center" role="alert">
                                Le formulaire comporte une erreur.
                            </div>';
                            header('Location: index.php?page=product&product_id='.$_POST['product_id']);
                        }
                    }else{
                        //On attribut à $_SESSION['message'] une div si la quantité inséré n'est pas disponible
                        $_SESSION['message'] = 
                        "<div class='alert alert-danger text-center' role='alert'>
                            La quantité inséré n'est pas disponible pour ce produit.
                        </div>";
                        header('Location: index.php?page=product&product_id='.$_POST['product_id']);
                    }
                }

                // Suite du case
                break;

        // Le cas de ?action=delete-all
        case "delete-all":
            //On unset toutes les valeurs du tableau $_SESSION['products'] et on redirige vers le panier
            unset($_SESSION['products']);
            unset($_SESSION['message']);
            header('Location: index.php?page=cart.php');
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
                    unset($_SESSION['products'][$index]);
                    unset($_SESSION['message']);
                    $_SESSION['delete'] = 
                    "<div class='alert alert-success text-center' role='alert'>
                        Le produit <strong>$name</strong> a bien été supprimé du panier.
                    </div>";
                }else{
                    echo "Erreur";
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
                if (isset($_SESSION['products'][$index]) && $_SESSION['products'][$index]['quantity'] <= $_SESSION['products'][$index]['max-quantity'] && $_SESSION['products'][$index]['quantity'] != $_SESSION['products'][$index]['max-quantity'] ){
                    //On incrémente la quantié de 1 de l'entrée et on additione le prix au total à chaque envoi dans $_GET
                    $_SESSION['products'][$index]['quantity'] = $_SESSION['products'][$index]['quantity'] + 1;
                    $_SESSION['products'][$index]['total'] += $_SESSION['products'][$index]['price'];
                    unset($_SESSION['message']);
                    unset($_SESSION['delete']);
                }
                else{
                    $_SESSION['delete'] = 
                    "<div class='alert alert-danger text-center' role='alert'>
                        La quantité de l'article <strong> ".$_SESSION['products'][$index]['name']."</strong> est atteinte.
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
                    unset($_SESSION['products'][$index]);
                    $_SESSION['delete'] = 
                    "<div class='alert alert-success text-center' role='alert'>
                    Le produit <strong>$name</strong> a bien été supprimé de la liste
                    </div>";
                }
            }
            header('Location: Location: index.php?page=cart');
            break;

        // Le cas de ?action=order lorsqu'on clique sur commander dans recap.php
        case "order":
            
            if (isset($_SESSION['mail'])){
                header('Location: order_page.php');
            }else{
                header('Location: login.php');
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

        // Cas de la déconnexion
        case "logout":
            unset($_SESSION['email-login']);
            header('Location: logout.php');
            break;  
            
        // Cas de la suppression de compte
        case "delete-account":
            $deleteAccount = $mysqlClient->prepare("DELETE FROM `users` WHERE `email` = :email");
            $deleteAccount->execute(
                array(
                    'email' => $_SESSION['email-login']
                    )
                );
                if ( isset($_SERVER['HTTP_COOKIE']) || isset($_SESSION['email-login']) ){
                    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
                    foreach ($cookies as $cookie) {
                        $parts = explode('=', $cookie);
                        $name = trim($parts[0]);
                        setcookie($name, '', time()-1000);
                        setcookie($name, '', time()-1000, '/');
                    }
                    unset($_SESSION);
                }
                header('Location: account_deleted.php');
                break;
            }
        }else {
            echo "Un problème est survenu";
            header('Location: index.php');
        }                                        