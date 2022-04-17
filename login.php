<?php
    session_start();
    $h1 = "Bienvenue. Veuillez ouvrir une session.";
    $title = "Page de connexion";
    include('header.php');
?>
<?php if (!isset($_SESSION['mail'])):?>
<div class="container">
    <div class="row pb-5 pt-3">
        <div class="col-12 pb-5">
            <h3 class="text-center">Nouveau client</h3>
            <p class="py-3 px-2">
                En créant votre compte sur Sneakers vous pourrez commander sur notre site et garder un historique de celles-ci.
            <p>
                <a class="d-flex justify-content-center m-auto mt-3 btn btn-outline-dark align-items-center bold w-75" href="create_account.php"><i class="fa-solid fa-angle-right me-1"></i>S'inscrire</a>
            </p>
            </p>
        </div>
        <div class="col-12">
            <h3 class="text-center">Client enregistré</h3>
            <form class=" align-items-center form-group d-flex flex-column m-auto w-75 py-3" action="recap.php" method="post">
                <input class="form-control" type="email" name="email" id="email" placeholder="Adresse email">
                <input class="form-control my-3" type="password" name="password" id="password" placeholder="Mot de passe">
                <input type="submit" class="btn btn-dark" value="Connexion">
            </form>
        </div>
    </div>
</div>
<?php else: header('Location: account.php '); endif;?>
<?php include('footer.php');?>