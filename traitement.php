<?php
    session_start();
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
        if (isset($_POST['submit']) && !empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['qtt'])){
            // On filtre l'input name avec filter_sanitize_spcial_chars pour ne pas récupérer du html au cas où il y en aurait
            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
            // On filtre price avec filter validate float pour être sûr qu'on reçoit un nombre à virgule pour exclure le texte
            // Filter flag permet l'utilisation de ',' ou '.' pour insérer un nombre décimal
            $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            // On filtre 'qtt' avec filter_validate_int pour y recevoir uniquement un nombre entier
            $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);


            // Si les conditions sont vraies (si les valeurs contiennent ce qu'on attend)
            // Alors on ajoute le contenu de chaque champ dans un tableau pour ensuite les conserver en SESSION
            if ($name && $price && $qtt){
                $product = array(
                    'name' => $name,
                    'price' => $price,
                    'qtt' => $qtt,
                    'total' => $price * $qtt 
                );
            //On ajoute le produit au tableau de la SESSION
            //On crée la clé 'products' à la SESSION
            //Les doubles crochets indiquent que nous ajoutons une nouvelle entrée au futur tableau 'products'
            //Associé à la clé 'products'
                $_SESSION['products'][] = $product;
                unset($_SESSION['delete']);
            }
            //On attribut à $_SESSION['message'] une div si le produit a bien été ajouté
                $_SESSION['message'] = 
                '<div class="alert alert-success text-center" role="alert">
                    Le produit a bien été ajouté à la liste.
                </div>';
        }else{
            //On attribut à $_SESSION['message'] une div si le formulaire comporte une erreur
            $_SESSION['message'] = 
                '<div class="alert alert-danger text-center" role="alert">
                    Le formulaire comporte une erreur
                </div>';
        }

        // Suite du case
            header('Location: recap.php');
        break;
        // Le cas de ?action=delete-all
        case "delete-all":
            //On unset toutes les valeurs du tableau $_SESSION['products'] et on redirige vers recap.php
            unset($_SESSION['products']);
            unset($_SESSION['message']);
            header('Location: recap.php');
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
                header("Location: recap.php");
            }
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
                if (isset($_SESSION['products'][$index]) && $_SESSION['products'][$index]['qtt'] > 1 && $_SESSION['products'][$index]['total'] > 1){
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
            header('Location: recap.php');
        break;
            // Lorsqu'on clique sur le logo accueil cela enlève les différents messages en session
        case "unset-accueil":
            unset($_SESSION['delete']);
            unset($_SESSION['message']);
            unset($_SESSION['wrong-id']);
            unset($_SESSION['error-form']);
            header('Location: index.php');
        break;
            // Cas de la déconnexion
        case "logout":
            session_destroy();
            header('Location: logout.php');
        break;  
    }
}else echo "Un problème est survenu";

?>