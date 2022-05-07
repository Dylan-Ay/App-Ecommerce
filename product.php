<?php
    if (isset($_GET['product_id'])) {
        $product = $control->get_product();
        $product_sizes = $control->get_product_sizes();
        foreach ($product_sizes as $key => $value) {
            
            $sizes [] = $product_sizes[$key]['size'];
        }
        //On récupère le produit dont le $_GET['product_id'] est égal à l'ID dans la base de donnée
        if (!$product) {
                // Si l'ID du produit n'éxiste pas
                exit("<p class='text-center display-1 pt-5'>Le produit n'éxiste pas !</p>");
            }
        } else {
            // Si l'ID du produit n'est pas spécifié
            exit("<p class='text-center display-1 pt-5'>Le produit n'éxiste pas !</p>");
    }
?>
<div class="cart-content container">
    <div id="cart-info" class="px-4 py-4">
        <span class="d-block"><i class="fa-solid fa-check"></i> Ajouté au panier</span>
        <?php
        if (isset($_SESSION['products'])):
            $productInCart = $_SESSION['products'];
            foreach ($productInCart as $key => $value) {
            }
            ?>
            <div class="product-content-cart row align-items-center py-4">
                <div class="col-3">
                    <img src="<?= $productInCart[$key]['picture']?>" alt="<?= $productInCart[$key]['name']?>">
                </div>
                <div class="col-9 ps-4">
                    <h6 class=""> <?= $productInCart[$key]['name'] ?></h6>
                    <span class="d-block">Taille: <?= $productInCart[$key]['size'] ?></span>
                    <span class="d-block">Prix: <?= $productInCart[$key]['price'] ?>€</span>
                </div>
            </div>
            <div class="action-btn-cart d-flex justify-content-between">
                <a href="traitement.php?action=unset-panier">Afficher le panier 
                    <?php $totalQuantity = 0;
                        foreach ($_SESSION['products'] as $key => $value) {
                            $totalQuantity += $_SESSION['products'][$key]['quantity'];
                        }
                        echo "($totalQuantity)"; ?>
                </a>
                <a href="traitement.php?action=order">Paiement</a>
            </div>
        <?php endif;?>
    </div>
</div>
<section id="product" class="container py-3">
    <div class="row justify-content-center pb-3">
        <div class="col-12 col-lg-6 d-flex justify-content-center">
            <img src="<?=$product['picture']?>" class="img-fluid" alt="<?=$product['name']?>">
        </div>
        <div class="col-12 col-lg-6 py-4 align-self-center">
        <?php if (isset($_SESSION['message'])): echo $_SESSION['message']; endif;?>
            <h1 class="name text-center"><?=$product['name']?></h1>
            <span id="price" class="bold mb-3 d-block text-center">
                <?= $product['price']?>&euro;
            </span>
            <form action="traitement.php?action=add" class="align-items-center py-3" method="post">
                <div class="input-container d-flex w-75 justify-content-evenly text-center">
                    <div class="select-container">
                        <label for="size">Taille</label>
                        <select class ="w-100 btn mt-2" name="size" id="size" required>
                            <?php foreach ($sizes as $key => $value): ?>
                                <option value="<?= $value ?>" <?= (isset($_POST['size']) && $_POST['size'] == $value) ? 'selected' : ''?>><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                        <!-- Le selected ne fonctionne à cause de la redirection -->
                    </div>
                    <div class="quantity-container">
                        <label for="qtt">Quantité</label>
                        <div class="container-qtt">
                            <img src="images/icon-minus.svg" id="minus" alt="minus icon">
                            <img src="images/icon-plus.svg" id="plus" alt="minus icon">
                            <input  class="btn w-100 no-arrow mt-2" type="number" name="quantity" id="qtt" 
                            value="1" min="1" placeholder="Quantity" required>
                        </div>
                    </div>
                    <input type="hidden" name="product_id" value="<?= $product['product_id']?>">
                </div>
                <figure class="container-add-cart w-75">
                    <img src="images/icon-cart-1-white.svg" alt="cart icon">
                    <input  class="btn my-3 w-100" id="add-cart-btn" type="submit" name="submit" value="Ajouter au panier">
                </figure>
            </form>
            <div class="description">
                <?=$product['description']?>
            </div>
        </div>
    </div>
    </div>
    <p class="pt-5 pb-3 almost-bold border-bottom-title text-center">DERNIERS PRODUITS CONSULTES</p>
    <?php if (isset($_SESSION['visited_pages'])):?>
    <div class="row justify-content-evenly">
        <?php foreach ($_SESSION['visited_pages'] as $key => $value):?>
            <div class="col-6 col-sm-5 col-md-4 col-lg-3 col-xl-2">
                <div class="product-content d-flex flex-column align-items-center">
                    <a class="pt-4" href="index.php?page=product&product_id=<?= $value ?>">
                        <?php echo '<img class="last-seen-img" src='.$control->get_seen_product($value)['picture'].'>';
                        echo "<h6 class='pt-3'>". $control->get_seen_product($value)['name']."</h4>";
                        ?>
                    </a>
                </div>
            </div>
        <?php endforeach; endif;?>
    </div>
</section>

<?php include_once('footer.php');?>

<?php 
// Récupération dans $_SESSION['visited_pages'] des produits visités

// Si $_SESSION['visited_pages'] existe -> Si $_SESSION['visited_pages'] contient l'id $_GET['product_id] ne rien faire, sinon ajouté l'id dans $_SESSION -> Si $_SESSION['visited_pages'] n'existe pas ajouté l'id à $_SESSION
if (isset($_SESSION['visited_pages'])){

    $visitedPages = $_SESSION['visited_pages'];
    if (in_array($_GET['product_id'], $visitedPages)){
       
    }else{
        $_SESSION['visited_pages'] [] = $_GET['product_id'];
    }
}else{
    $_SESSION['visited_pages'] [] = $_GET['product_id'];
}

var_dump($productInCart);
