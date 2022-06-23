<?php
    ob_start();

    $h1 = "Résumé de votre commande";
    $title = "Résumé de la commande";


    // Adresse de livraison + valider la commande + retour au panier + afficher message de succès 

    $content = ob_get_clean();
    require('views/template.php');