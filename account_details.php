<?php
    include('account_details_controller.php');
    $h1 = "Details de mon compte";
    $title = "Details de mon compte";
    include('header.php');
    
    if (isset($_SESSION['email-login'])):?>

    <section id="account-details" class="container py-5">
        <?php if (isset($_SESSION['error-form'])): echo $_SESSION['error-form']; endif;?>
        <p class="text-end">
            <span class="red bold">*</span> Information requise.
        </p>
        <form action="account_details_controller.php" class="form-group d-flex flex-column" method="post">
            <label for="firstname">Prénom <span class="red">*</span></label>
            <input class="py-2 px-2" type="text" name="firstname" id="firstname" value="<?= $firstName?>" required>

            <label class="mt-3" for="lastname">Nom <span class="red">*</span></label>
            <input class="py-2 mb-3 px-2" type="text" name="lastname" id="lastname" value="<?= $lastName?>" required>

            <label for="email-login">Adresse email <span class="red">*</span></label>
            <input class="py-2 px-2" type="email" name="email-login" id="email-login" value="<?= $email?>" required>

            <label class="mt-3" for="phone">Numéro de téléphone <span class="red">*</span></label>
            <input class="py-2 mb-4 px-2" type="tel" name="phone" id="phone" value="<?= $number?>" required>

            <input class="btn btn-dark w-50 m-auto" type="submit" value="Valider">
        </form>

    <?php else: header('Location: index.php'); endif;  var_dump($userInformations);?>