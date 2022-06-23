<?php 
    ob_start();
    $h1 = "Votre compte a bien été supprimé !";
    $title = "Sneakers - Magasin de Sneakers & Streetwear";
?>

<?php if (!isset($_SESSION['email-login'])):?>

<div class="container py-5 w-50">
    Nous sommes navrés de vous voir partir. A tout moment vous avez la possibilité de recréer un compte.
    Sachez que l'intégralité de vos informations a bien été supprimée. A bientôt sur sneakers.fr
</div>

<?php 
    else: header('Location: index.php?page=home'); endif;

    $content = ob_get_clean();
    require('views/template.php');
?>