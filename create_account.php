<?php
    session_start();
    $h1 = "Informations sur le compte";
    $title = "Création de compte";
    include('header.php');

    if (!isset($_SESSION['email-login'])):
?>

<div class="container py-5">
    <?php if (isset($_SESSION['error-form'])): echo $_SESSION['error-form']; endif;?>
    <p class="py-3">
        <span class="bold">Important:</span> Si vous avez déjà un compte, merci de vous connecter à la page <a href="login.php"><u>d'ouverture de session</u></a>.
        <p class="text-end">
            <span class="red bold">*</span> Information requise.
        </p>
    </p>
    
    <h3 class="text-center pt-5">Vos données personnelles</h3>
    <form action="user_create.php" class="form-group d-flex flex-column" method="post">
        <label for="firstname">Prénom <span class="red">*</span></label>
        <input class="py-2" type="text" name="firstname" id="firstname" required>

        <label class="mt-3" for="lastname">Nom <span class="red">*</span></label>
        <input class="py-2 mb-3" type="text" name="lastname" id="lastname" required>

        <label for="email-login">Adresse email <span class="red">*</span></label>
        <input class="py-2" type="email" name="email-login" id="email-login" required>

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
        <input class="py-2" type="password" name="pswd" id="pswd" >

        <label class="mt-3" for="pswd-confirmation">Confirmez votre mot de passe <span class="red">*</span></label>
        <input class="py-2 mb-4" type="password" name="pswd-confirmation" id="pswd-confirmation" >

        <input class="btn btn-dark w-50 m-auto" type="submit" value="Créer mon compte">
    </form>
</div>

<?php else: header('Location: index.php'); endif;?>
<?php include('footer.php');?>