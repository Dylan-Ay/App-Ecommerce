<?php 
    session_start();
    $h1 = "Ajouter un produit";
    $title = "Ajouter un produit";
    include('header.php');
    ?>
<div class="container">
    <!-- Si la session 'message' existe, afficher le contenu de $_SESSION['message']-->
<?php if (isset($_SESSION['message'])): echo $_SESSION['message']; endif;?>
    <div class="row m-auto">
        <form class=" align-items-center form-group d-flex flex-column m-auto w-50" action="traitement.php?action=add" method="post">
            <p>
                <label>
                    Nom du produit :
                    <input class="form-control" type="text" name="name">
                </label>
            </p>
            <p>
                <label>
                    Prix du produit :
                    <input class="form-control" type="number" step="any" name="price">
                </label>
            </p>
            <p>
                <label>
                    Quantité désirée :
                    <input class="form-control" type="number" name="qtt" value="1">
                </label>
            </p>
            <p>
                <input  type="submit" class="btn btn-dark" name="submit" value="Ajouter le produit">
            </p>
        </form>
    </div>
</div>
<?php include('footer.php');?>