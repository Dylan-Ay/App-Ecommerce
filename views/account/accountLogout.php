<?php
    ob_start();

    $h1 = "Votre session a été fermée.";
    $title = "Sneakers - Magasin de Sneakers & Streetwear";
?>

<?php if (!isset($_SESSION['email-login'])):?>

    <div class="container py-5 text-center">
        <span class="display-6 bold">Sneakers</span>
        <p class="py-4">
            Vous avez fermé votre session. Vous pouvez laisser votre ordinateur allumé sans risque d'utilisation de votre compte.
            <br><br>
            Votre panier en cours a été sauvegardé.
        </p>
    </div>

<?php 
    else: header('Location: index.php?page=home'); endif;

    $content = ob_get_clean();
    require('views/template.php');
?>