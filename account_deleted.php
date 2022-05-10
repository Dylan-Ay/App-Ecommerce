<?php 
    session_start();
    $h1 = "Votre compte a bien été supprimé !";
    $title = "Sneakers";
    include('header.php');
?>

<?php if (!isset($_SESSION['email-login'])):?>

<div class="container">
    Nous sommes navrés de vous voir partir. A tout moment vous avez la possibilité de recréer un compte.
    Sachez que l'intégralité de vos informations a bien été supprimée. A bientôt sur sneakers.fr
</div>

<?php else: header('Location: index.php'); endif;
    include('footer.php');
?>