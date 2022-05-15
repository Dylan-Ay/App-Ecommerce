<?php 
    $allProducts = $productController->get_all_products();
    $totalProducts = $productController->get_number_of_products();
?>
<section id="products" class="container py-5">
    <p class="text-center"><?=$totalProducts?> Produits</p>
    <div class="products-content py-5">
        <div class="row flex-column flex-md-row align-items-center align-items-md-start justify-content-evenly ">
            <?php foreach ($allProducts as $product):?>
                <div class="col-10 col-md-5 col-lg-3 pb-5 pb-md-0">
                    <a href="index.php?page=product&product_id=<?=$product['product_id']?>" class="product">
                        <img src="<?=$product['picture']?>" class="img-fluid" alt="<?=$product['name']?>">
                        <span class="name"><?=$product['name']?></span><br>
                        <span class="price bold">
                            <?=$product['price']?>&euro;
                        </span>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>