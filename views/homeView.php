<?php
    ob_start();
    $title = "Sneakers - Magasin de Sneakers & Streetwear";

    //Récupération des 4 derniers produits ajoutés
    $recentlyAddedProducts = $productController->get_five_last_products();
?>
<section id="slider">
    <h1>Slider</h1>
</section>

<section id="new-products" class="container py-5">
    <h2 class="text-center">Produits récemment ajoutés</h2>
    <div class="products py-5">
        <div class="row flex-column flex-md-row align-items-center align-items-md-start justify-content-evenly">
            <?php foreach ($recentlyAddedProducts as $product):?>
                <div class="col-9 col-sm-7 col-md-5 col-lg-2">
                    <a href="index.php?page=product&product_id=<?=$product['product_id']?>" class="product">
                        <img src="<?=$product['picture']?>" class="img-fluid" alt="<?=$product['name']?>">
                        <div class="product-description">
                            <span class="name"><?=$product['name']?></span><br>
                            <span class="price bold">
                                &euro;<?=$product['price']?>
                            </span>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php 
    $content = ob_get_clean();
    require('views/template.php');
?>