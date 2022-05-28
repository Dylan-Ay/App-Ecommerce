<?php
    ob_start();
    
    $h1 = "Votre compte a été crée !";
    $title = "Sneakers - Magasin de Sneakers & Streetwear";
?>

<?php if (isset($_SESSION['email-login'])):?>

<div class="container py-5">
    <p>
        Félicitations ! Votre nouveau compte a été créé ! Vous pouvez maintenant profiter des privilèges de membre afin de tirer pleinement parti de notre site de commerce en ligne.
        <br><br>
        Une confirmation de création de compte a été envoyée à l'adresse électronique fournie. Si vous ne l'avez pas reçu dans l'heure, veuillez nous contacter.
    </p>
    <a class="d-flex justify-content-center m-auto mt-3 btn btn-outline-dark align-items-center bold w-75 mt-5" href="index.php?page=home"><i class="fa-solid fa-angle-right me-1"></i>Continuer</a>
</div>

<?php 
    else: header('Location: index.php?page=home'); endif;
    $content = ob_get_clean();

    require('views/template.php');
?>