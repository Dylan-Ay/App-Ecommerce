<?php
    if (isset($_GET['product_id'])) {

        //On récupère le produit dont le $_GET['product_id'] est égal à l'ID dans la base de donnée
        $product = $control->get_product();

        if (!$product) {
                // Si l'ID du produit n'éxiste pas
                exit("<p class='text-center display-1 pt-5'>Le produit n'éxiste pas !</p>");
            }
        } else {
            // Si l'ID du produit n'est pas spécifié
            exit("<p class='text-center display-1 pt-5'>Le produit n'éxiste pas !</p>");
    }
?>
<section id="product">
    <div class="container py-3">
        <div class="row">
            <div class="col-12 col-lg-6 d-flex justify-content-center">
                <img src="<?=$product['picture']?>" class="img-fluid" alt="<?=$product['name']?>">
            </div>
            <div class="col-12 col-lg-6 py-4 align-self-center">
            <?php if (isset($_SESSION['message'])): echo $_SESSION['message']; endif;?>
                <h1 class="name text-center"><?=$product['name']?></h1>
                <span id="price" class="bold mb-3 d-block text-center">
                    <?=$product['price']?>&euro;
                </span>
                <form action="traitement.php?action=add" class="align-items-center py-3" method="post">
                    <div class="container-qtt w-75">
                        <img src="images/icon-minus.svg" id="minus" alt="minus icon">
                        <img src="images/icon-plus.svg" id="plus" alt="minus icon">
                        <input  class="btn w-100 no-arrow" type="number" name="quantity" id="qtt" 
                        value="1" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
                        <input type="hidden" name="product_id" value="<?= $product['product_id']?>">
                    </div>
                    <figure class="container-add-cart w-75">
                        <img src="images/icon-cart-1-white.svg" alt="cart icon">
                        <input  class="btn my-3 w-100" type="submit" name="submit" value="Ajouter au panier">
                    </figure>
                </form>
                <div class="description">
                    <?=$product['description']?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('footer.php');?>