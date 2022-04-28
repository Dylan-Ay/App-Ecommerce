<?php
    session_start();
    $h1 = "Informations sur mon compte.";
    $title = "Compte";
    include('header.php');
?>

<?php if (isset($_SESSION['email-login'])):;?>

<h3 class="text-center pt-3">Bienvenue sur votre compte
    <span class="bold"><?= $_COOKIE['firstname'] ." ". $_COOKIE['lastname']."."?></span>
</h3> 
<div class="container py-4">
    <section id="account-delete">
        <a class="d-flex justify-content-center m-auto mt-3 py-2 btn btn-outline-dark align-items-center bold w-100" href="order_list.php"><i class="fa-solid fa-angle-right me-1"></i>Afficher mes commandes.</a>
        <a class="d-flex justify-content-center m-auto my-5 py-2 btn btn-outline-dark align-items-center bold w-100" href="account_details.php"><i class="fa-solid fa-angle-right me-1"></i>Afficher ou modifier les informations de mon compte.</a>
        <a class="d-flex justify-content-center m-auto mt-3 py-2 btn btn-outline-dark align-items-center bold w-100" href="account_pswd.php"><i class="fa-solid fa-angle-right me-1"></i>Modifier le mot de passe de mon compte.</a>
        <a class="d-flex justify-content-center m-auto mt-5 py-2 btn btn-outline-dark align-items-center bold w-100" href="traitement.php?action=logout"><i class="fa-solid fa-angle-right me-1"></i>Déconnexion</a>
        <a class="d-flex justify-content-center m-auto mt-5 py-2 btn btn-outline-danger align-items-center bold w-100" data-toggle="modal" data-target="#exampleModal">
            <!-- Ajouter bouton retour-->
            <i class="fa-solid fa-angle-right me-1"></i>
            Supprimer mon compte
        </a>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Etes vous sûr de vouloir supprimer votre compte ? Cette action est irreversible. Toutes vos informations vont être supprimées.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <a class="btn btn-danger" href="traitement.php?action=delete-account">Supprimer mon compte</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php else: header('Location: index.php'); endif; ?>
<?php include('footer.php');?>