<?php
    session_start();
    require_once('mysql.php');
    require_once('Control.php');
    $control = new Control($mysqlClient);
        // On utilise session_start pour récupérer les informations de l'utilisateur et les garder entre plusieurs pages
        // pour les réutiliser on stock les informations dans les cookies
        //include('recap.php');
        // Si $_GET a reçu le mot 'action' 
    if (isset($_GET['action'])){
        //On va traiter les cas différents pour "?action=.." chaque cas est le mot clé après le '='
        switch($_GET['action']){
            // Le cas de ?action=add
            case 'add':

        //On vérifie si le serveur a reçu une clé submit pour éviter qu'un utiliseur puisse atteindre traitement.php
        // d'une autre manière
        if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])){
            $product_id = (int)$_POST['product_id'];
            $quantity = (int)$_POST['quantity'];
            
            $product = $control->get_product_cart();

            // Si les conditions sont vraies ($product_id && $quantity)
            // Alors on ajoute le contenu de chaque champ dans $productInSession
            if ($product_id && $quantity){
                $productInSession = array(
                    $product_id => $product_id, //l'ID venant du $_POST['product_id']
                    'picture' => $product['picture'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'quantity' => $quantity,
                    'total' => $product['price'] * $quantity //Quantité venant du $_POST['quantity']
                );
                if (isset($_SESSION['products']) && is_array($_SESSION['products'])) {
                    foreach ($_SESSION['products'] as $index => $value) {
                        // Je boucle dans $_SESSION['products'] pour récupérer la clé qui existe pour chaque entrée
                    }
                    if (array_key_exists($product_id, $_SESSION['products'][$index])) {
                        // Si le produit existe, j'ajoute la quantité de $_POST['quantity']
                        $_SESSION['products'][$index]['quantity'] += $quantity;
                        unset($_SESSION['delete']);
                       } else {
                        // Si le produit n'existe pas, je l'ajoute à $_SESSION['products']
                        $_SESSION['products'] [] = $productInSession;
                        unset($_SESSION['delete']);
                       }
                   } else {
                       // Sinon Si $_SESSION['products'] est n'existe pas je lui ajoute le produit
                       $_SESSION['products'] [] = $productInSession;
                       unset($_SESSION['delete']);
                }
                 
                
                //On ajoute le produit au tableau de la SESSION
                //On crée la clé 'products' à la SESSION
                //Les doubles crochets indiquent que nous ajoutons une nouvelle entrée au futur tableau 'products'
                //Associé à la clé 'products'
                
            }
            //On attribut à $_SESSION['message'] une div si le produit a bien été ajouté
                $_SESSION['message'] = 
                '<div class="alert alert-success text-center" role="alert">
                    Le produit a bien été ajouté à la liste.
                </div>';
                header('Location: index.php?page=product&product_id=5'); 
        }else{
            //On attribut à $_SESSION['message'] une div si le formulaire comporte une erreur
            $_SESSION['message'] = 
                '<div class="alert alert-danger text-center" role="alert">
                    Le formulaire comporte une erreur
                </div>';
                header('Location: index.php?page=product&product_id=5'); 
        }

        // Suite du case
        break;
        // Le cas de ?action=delete-all
        case "delete-all":
            //On unset toutes les valeurs du tableau $_SESSION['products'] et on redirige vers recap.php
            unset($_SESSION['products']);
            unset($_SESSION['message']);
            header('Location: index.php?page=cart.php');
        break;
            // Le cas de ?action=delete-unit
        case "delete-unit":
            //Si $_GET a reçu un index en paramètre ( ?action=delete-unit&index=...) alors on récupère l'index dans $index 
            if (isset($_GET['index'])){
                $index = $_GET["index"];
                //Si un index est présent dans products on ajoute à $name le produit et son index associé et on unset ce produit grâce à son index récupéré dans $_GET['index']
                if (isset($_SESSION['products'][$index])){
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
                if (isset($_SESSION['products'][$index])){
                //Si un index existe, Alors on incrémente la quantié de 1 pour l'index concerné et on additione le prix au total à chaque clique
                    $_SESSION['products'][$index]['qtt'] = $_SESSION['products'][$index]['qtt'] + 1;
                    $_SESSION['products'][$index]['total'] += $_SESSION['products'][$index]['price'];
                    unset($_SESSION['message']);
                    unset($_SESSION['delete']);
                }
            }
            header('Location: recap.php');
        break;
            // Le cas de ?action=decrease
        case "decrease":
            //Si $_GET a reçu un index en paramètre ( ?action=decrease&index=...) alors on récupère l'index dans $index 
            if (isset($_GET['index'])){
                $index = $_GET['index'];
                //Si un index existe, et si la quantité est supérieur à 0 et si le total est supérieur à 0 Alors on décrémente la quantité de 1 et on soustrait le prix au total à chaque clique
                if (isset($_SESSION['products'][$index]) && $_SESSION['products'][$index]['qtt'] > 1 && $_SESSION['products']/*[$index]['total']*/ > 1){
                    $_SESSION['products'][$index]['qtt'] = $_SESSION['products'][$index]['qtt'] - 1;
                    $_SESSION['products'][$index]['total'] -= $_SESSION['products'][$index]['price'];
                    unset($_SESSION['message']);
                    unset($_SESSION['delete']);
                }else if (isset($_SESSION['products'][$index]) && $_SESSION['products'][$index]['qtt'] === 1){
                    $name = $_SESSION['products'][$index]['name'];
                    unset($_SESSION['products'][$index]);
                    $_SESSION['delete'] = 
                    "<div class='alert alert-success text-center' role='alert'>
                        Le produit <strong>$name</strong> a bien été supprimé de la liste
                    </div>";
                }
            }
            header('Location: recap.php');
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
            header('Location: recap.php');
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
}else 

var_dump($_SESSION['products']);
$product_id = 5;
$quantity = 10;

if (isset($_SESSION['products']) && is_array($_SESSION['products'])) {
    if (array_key_exists($product_id, $_SESSION['products'])) {
        // Product exists in cart so just update the quanity
        echo "existe";
       } else {
        echo 'existe pas';
       }
}
