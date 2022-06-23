<?php
    ob_start();

    $h1 = "Bienvenue. Veuillez ouvrir une session.";
    $title = "Connexion";
?>

<?php if (!isset($_SESSION['email-login'])):?>

<!-------- Sign up button -------->

<section id="login" class="container">
    <div class="row py-5">
        <div class="col-12 pb-5 text-center">
        <?php if (isset($_SESSION['wrong-id'])): echo $_SESSION['wrong-id']; endif;?>
            <h3>Nouveau client</h3>
            <div class="py-3 px-2">
                En créant votre compte sur Sneakers vous pourrez commander sur notre site et garder un historique de celles-ci.
                <p>
                    <a class="d-flex justify-content-center m-auto mt-3 btn btn-outline-dark align-items-center bold" href="index.php?page=create-account">
                        <i class="fa-solid fa-angle-right me-1"></i>S'inscrire
                    </a>
                </p>
            </div>
        </div>

<!-------- Log in button -------->

        <div class="col-12">
            <h3 class="text-center">Client enregistré</h3>
            <form class=" align-items-center form-group d-flex flex-column m-auto py-3" action="index.php?page=login" method="post" id="form">
                <input class="form-control" type="email" name="email-login" id="email-login" placeholder="Adresse email" required>
                <input class="form-control my-3" type="password" name="password-login" id="password-login" placeholder="Mot de passe" required>
                <input type="text" id="website" name="website" hidden>
                <input type="submit" class="btn btn-dark" value="Connexion">
            </form>
        </div>
    </div>
</section>

<?php 
    else: header('Location: index.php?page=account-menu'); endif;

    $content = ob_get_clean();
    require('views/template.php');
?>