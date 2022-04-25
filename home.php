<?php
    //Récupération des 4 derniers produits ajoutés
    $recentlyAddedProducts = $control->get_four_last_products();
?>

<div class="container py-3">
    <h2 class="text-center">Produits récemment ajoutés</h2>
    <div class="products py-5">
        <div class="row flex-column flex-lg-row align-items-center">
            <?php foreach ($recentlyAddedProducts as $product):?>
                <div class="col-10 col-md-8 col-lg-3 pb-5">
                    <a href="index.php?page=product&product_id=<?=$product['product_id']?>" class="product">
                        <img src="<?=$product['picture']?>" class="img-fluid" alt="<?=$product['name']?>">
                        <span class="name"><?=$product['name']?></span><br>
                        <span class="price bold">
                            &euro;<?=$product['price']?>
                        </span>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>