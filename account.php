<?php
    session_start();
    $h1 = "Informations sur mon compte.";
    $title = "Compte";
    include('header.php');
?>
<?php if (isset($_SESSION['mail'])):;?>

<!-- Ajouter bouton retour-->
    <h3 class="text-center pt-3">Bienvenue sur votre compte <span class="bold"><?= $_COOKIE['firstname'] ." ". $_COOKIE['lastname']."."?></span></h3>
<div class="container py-4">
    <a class="d-flex justify-content-center m-auto mt-3 py-2 btn btn-outline-dark align-items-center bold w-100" href="order_list.php"><i class="fa-solid fa-angle-right me-1"></i>Afficher mes commandes.</a>
    <a class="d-flex justify-content-center m-auto my-5 py-2 btn btn-outline-dark align-items-center bold w-100" href="account_details.php"><i class="fa-solid fa-angle-right me-1"></i>Afficher ou modifier les informations de mon compte.</a>
    <a class="d-flex justify-content-center m-auto mt-3 py-2 btn btn-outline-dark align-items-center bold w-100" href="account_pswd.php"><i class="fa-solid fa-angle-right me-1"></i>Modifier le mot de passe de mon compte.</a>
    <a class="d-flex justify-content-center m-auto mt-5 py-2 btn btn-outline-dark align-items-center bold w-100" href="traitement.php?action=logout"><i class="fa-solid fa-angle-right me-1"></i>Déconnexion</a>
</div>

<?php else: header('Location: index.php'); endif; ?>
<?php include('footer.php');?>