<?php
    session_start();
    $h1 = "Informations sur le compte";
    $title = "Création de compte";
    include('header.php');

    // Définitions des cookies et des sessions et on vérifie si POST existe
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        
        if (!empty($_POST['firstname'])){
            setcookie('firstname', $_POST['firstname']);
            $firstName = $_POST['firstname'];
        }else{
            $message = 
            '<div class="alert alert-danger text-center" role="alert">
                Le formulaire comporte une erreur
            </div>';
        }
        if (!empty($_POST['lastname'])){
            setcookie('lastname', $_POST['lastname']);
            $lastName = $_POST['lastname'];
        }else{
            $message = 
            '<div class="alert alert-danger text-center" role="alert">
                Le formulaire comporte une erreur
            </div>';
        }

        if (!empty($_POST['mail'])){
            $_SESSION['mail'] = $_POST['mail'];
            $mail = $_POST['mail'];
        }else{
            $message = 
            '<div class="alert alert-danger text-center" role="alert">
                Le formulaire comporte une erreur
            </div>';
        }

        if (!empty($_POST['adress'])){
            setcookie('adress', $_POST['adress']);
            $adress = $_POST['adress'];
        }else{
            $message = 
            '<div class="alert alert-danger text-center" role="alert">
                Le formulaire comporte une erreur
            </div>';
        }

        if (!empty($_POST['city'])){
            setcookie('city', $_POST['city']);
            $city = $_POST['city'];
        }else{
            $message = 
            '<div class="alert alert-danger text-center" role="alert">
                Le formulaire comporte une erreur
            </div>';
        }

        if (!empty($_POST['zip'])){
            setcookie('zip', $_POST['zip']);
            $zip = $_POST['zip'];
        }else{
            $message = 
            '<div class="alert alert-danger text-center" role="alert">
                Le formulaire comporte une erreur
            </div>';
        }

        if (!empty($_POST['country'])){
            setcookie('country', $_POST['country']);
            $country = $_POST['country'];
        }else{
            $message = 
            '<div class="alert alert-danger text-center" role="alert">
                Le formulaire comporte une erreur
            </div>';
        }

        if (!empty($_POST['dpt'])){
            setcookie('dpt', $_POST['dpt']);
            $dpt = $_POST['dpt'];
        }else{
            $message = 
            '<div class="alert alert-danger text-center" role="alert">
                Le formulaire comporte une erreur
            </div>';
        }
        if (!empty($_POST['phone'])){
            setcookie('phone', $_POST['phone']);
            $phone = $_POST['phone'];
        }else{
            $message = 
            '<div class="alert alert-danger text-center" role="alert">
                Le formulaire comporte une erreur
            </div>';
        }
        if (!empty($_POST['pswd']) && !empty($_POST['pswd-confirmation']) && $_POST['pswd'] === $_POST['pswd-confirmation']){
            $_SESSION['pswd'] = $_POST['pswd'];
        }else{
            $message = 
            '<div class="alert alert-danger text-center" role="alert">
                Le formulaire comporte une erreur.
            </div>';
        }
        $_SESSION['account-created'] = 
        '<div class="alert alert-success text-center" role="alert">
            Votre compte a été crée.
        </div>';
        header('Location: account.php');
    }
?>
<div class="container">
    <p class="py-3">
        <span class="bold">Important:</span> Si vous avez déjà un compte, merci de vous connecter à la page <a href="login.php"><u>d'ouverture de session</u></a>.
        <p class="text-end">
            <span class="red bold">*</span> Information requise.
        </p>
    </p>
    <?php if (isset($message)): echo $message; endif;?>
        <h3 class="text-center pt-5">Vos données personnels</h3>
        <form action="create_account.php" class="form-group d-flex flex-column" method="post">
            <label for="firstname">Prénom <span class="red">*</span></label>
            <input class="py-2" type="text" name="firstname" id="firstname" required>

            <label class="mt-3" for="lastname">Nom <span class="red">*</span></label>
            <input class="py-2 mb-3" type="text" name="lastname" id="lastname" required>

            <label for="mail">Adresse email <span class="red">*</span></label>
            <input class="py-2" type="email" name="mail" id="mail" required>

        <h3 class="text-center pt-5">Votre adresse</h3>
            <label for="adress">Adresse <span class="red">*</span></label>
            <input class="py-2" type="text" name="adress" id="adress" required>

            <label class="mt-3" for="city">Ville <span class="red">*</span></label>
            <input class="py-2" type="text" name="city" id="city" required>

            <label class="mt-3" for="zip">Code postal <span class="red">*</span></label>
            <input class="py-2" type="number" name="zip" id="zip" required>

            <label class="mt-3" for="country">Pays <span class="red">*</span></label>
            <input class="py-2" type="text" name="country" id="country" required>

            <label class="mt-3" for="dpt">Département <span class="red">*</span></label>
            <input class="py-2" type="text" name="dpt" id="dpt" required>

            <label class="mt-3" for="phone">Numéro de téléphone <span class="red">*</span></label>
            <input class="py-2" type="tel" name="phone" id="phone" required>

        <h3 class="text-center pt-5">Votre mot de passe <span class="red">*</span></h3>
            <label for="pswd">Mot de passe <span class="red">*</span></label>
            <input class="py-2" type="password" name="pswd" id="pswd" required>

            <label class="mt-3" for="pswd-confirmation">Confirmez votre mot de passe <span class="red">*</span></label>
            <input class="py-2 mb-4" type="password" name="pswd-confirmation" id="pswd-confirmation" required>

            <input class="btn btn-dark w-50 m-auto" type="submit" value="Créer mon compte">
        </form>

    <?php // var_dump($_POST)?>
    <br>
    <?php // var_dump($_COOKIE['firstname'])?>
    <br>
    <?php // var_dump($_COOKIE['lastname'])?>
    <?php // var_dump($_SESSION['mail'])?>
    <br>
    <?php // var_dump($_SESSION['pswd'])?>
</div>

<?php include('footer.php');?>