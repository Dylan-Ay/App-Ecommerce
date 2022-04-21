<?php
    $h1 = "Votre session a été fermée.";
    $title = "Sneakers";
    include('header.php');
?>

<?php if (!isset($_SESSION['email-login'])):?>

    <div class="container py-5">
        <img  class="d-block m-auto pt-3" src="images/logo.svg" alt="Logo du site sneakers">
        <p class="py-4 text-center">
            Vous avez fermé votre session. Vous pouvez laisser votre ordinateur allumé sans risque d'utilisation de votre compte.
            <br><br>
            Votre panier en cours a été sauvegardé.
        </p>
    </div>

<?php else: header('Location: index.php'); endif;?>
<?php include('footer.php');?>