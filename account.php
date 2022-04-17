<?php
    session_start();
    $h1 = "Informations sur mon compte.";
    $title = "Compte";
    include('header.php');
?>
<div class="container">
<?php if (isset($_SESSION['account-created'])): echo $_SESSION['account-created']; endif;

// Ajouter bouton déconnexion + afficher les commandes effectuées + afficher ou modifier les informations de compte + modifier mot de passe du compte avec bouton valider et retour

?>

</div>





<?php include('footer.php');?>