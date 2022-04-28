<?php
    session_start();
    require_once('mysql.php');
    require_once('Control.php');
    $control = new Control($mysqlClient);

    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        if (!empty($_POST['website'])){
            header('Location: create_account.php');
            exit();
        }
        // On récupèré le mail en $_POST ensuite on appelle la méthode get_user avec ce mail récupéré. 
        $mail = $_POST['email-login'];
        $mailDataBase = $control->get_user($mail);
        
        //Si le mail récupéré est égal à un mail de la table user de la colonne 'email' alors on renvoi une erreur.
        if ($mail === $mailDataBase['email']){
            $_SESSION['error-form'] = 
                '<div class="alert alert-danger text-center" role="alert">
                    Un compte a déjà été crée avec cette adresse email. Veuillez vous <a href="login.php" class="bold">connecter</a> avec cette adresse email ou créer un compte avec une adresse différente.
                </div>';
            header('Location: create_account.php');
        }

        else if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email-login']) && filter_var($_POST['email-login'], FILTER_VALIDATE_EMAIL)  && !empty($_POST['adress']) && !empty($_POST['city']) && !empty($_POST['zip']) && !empty($_POST['country']) && !empty($_POST['dpt']) && !empty($_POST['phone']) && !empty($_POST['pswd']) && !empty($_POST['pswd-confirmation']) && $_POST['pswd'] === $_POST['pswd-confirmation']){
            header('Location: account_success.php');
            setcookie('firstname', $_POST['firstname']);
            $firstName = htmlspecialchars(trim($_POST['firstname']));

            setcookie('lastname', $_POST['lastname']);
            $lastName = htmlspecialchars(trim($_POST['lastname']));

            $_SESSION['email-login'] = $_POST['email-login'];
            $mail = $_POST['email-login'];
            $user = $control->get_user($mail);
            
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

            if (isset($_SESSION['wrong-id']) || isset($_SESSION['error-form'])){
                unset($_SESSION['wrong-id']);
                unset($_SESSION['error-form']);
            }

            //Contenu du mail de confirmation d'inscription
            $header  = 'MIME-Version: 1.0' . "\r\n";
            $header .= 'Content-type: text/html; charset=utf-8' . "\r\n";

            $message = 
            "<span>Cher $firstName $lastName,</span>

            <p>
                Nous sommes heureux de vous accueillir dans notre boutique en ligne <strong>Sneakers</strong>.
                <br><br>
                Vous pouvez maintenant utiliser les services réservés à nos clients :
                <ul>
                    <li>
                        <strong>Panier permanent</strong> - Tous les produits ajoutés à votre panier en ligne sont conservés entre vos visites jusqu'à la finalisation de votre commande. Vous pouvez donc commencer vos achats aujourd'hui et conclure votre commande lors de votre prochaine visite.</li>
                        <li><strong>Carnet d'adressess</strong> - Nous pouvons livrer vos produits à une adresse différente de la vôtre! C'est parfait pour envoyer des cadeaux à vos proches et amis.</li>
                        <li><strong>Historique des commandes</strong> - Chacune de vos commandes dans notre boutique est conservée. Vous pouvez à tout moment consulter l'historique ou connaître l'avancement de votre dernière commande si elle n'a pas encore été livrée.
                    </li>
                </ul>
                <br>
                Pour plus d'informations à propos de nos services en ligne, vous pouvez contacter le propriétaire du site à l'adresse suivante : <a href='mailto:dylan.ay@outlook.com'>dylan.ay@outlook.com</a>.  
                <br><br>
                <strong>REMARQUE IMPORTANTE</strong> : Vous recevez cet email car il fait suite à l'inscription d'un nouveau client dans notre boutique en ligne. Si vous ne vous êtes pas inscrit sur Sneakers, merci de le signaler au gestionnaire de la boutique à cette adresse : <a href='mailto:dylan.ay@outlook.com'>dylan.ay@outlook.com</a>.
            </p>";
            mail($mail, "Confirmation d'inscription : Bienvenue chez Sneakers", $message, $header);
        }
        else{
            $_SESSION['error-form'] = 
                '<div class="alert alert-danger text-center" role="alert">
                Le formulaire comporte une erreur.
                </div>';
        }
    }header('Location: account_success.php');

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