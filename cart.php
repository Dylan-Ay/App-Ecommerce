<section class="container" id="cart">
    <h1 class="text-center py-5 border-bottom-title">Le contenu de mon panier.</h1>
    <?php if (isset($_SESSION['products'])){
        $products =  $_SESSION['products'];
    }?>
    <?php if (empty($products)): ?>
        <div class="container-empty text-center pb-4">
            <p class='pt-4'>Votre panier est vide.</p><br>
            <a href='index.php'>
                <div class='btn btn-outline-dark w-75'>
                    <i class="fa-solid fa-chevron-right pe-2"></i>Retour à l'accueil
                </div>
            </a>
        </div>
        <?php else: ?>
            <?php if (isset($_SESSION['delete'])): echo $_SESSION['delete']; endif;?>
            <form action="index.php?page=cart" method="post" class="py-5">
                <table class="w-100 table">
                    <thead class="bold">
                        <tr>
                            <td colspan="2">Produits</td>
                            <td>Prix</td>
                            <td class="text-center">Quantité</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php foreach ($products as $index => $product): // ForEach pour afficher un produit par ligne ?>
                            <tr class="my-3">
                    <td class="img py-3">
                        <a href="index.php?page=product&product_id=<?=array_key_first($products[$index]);?>">
                            <img class="table-img" src="<?=$products[$index]['picture']?>" alt="<?=$products[$index]['name']?>">
                        </a>
                    </td>
                    <td>
                        <div class="detail-container">
                            <div class="d-flex name">
                                <strong>
                                    <a href="index.php?page=product&product_id=<?=array_key_first($products[$index]);?>"><?=$products[$index]['name']?></a>
                                </strong>
                                <a href="traitement.php?action=delete-unit&index=<?=$index?>" class="remove ms-2">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                            <span>Taille : <?= $products[$index]['size']?></span>
                        </div>
                    </td>
                    <td>
                        <span class="price d-flex">
                            <?=$products[$index]['price']?>&euro;
                        </span>
                    </td>
                    <td>
                        <div class="quantity d-flex">
                            <div class="quantity-input-container d-flex">
                                <input disabled class="form-control qtt" type="text" name="qtt" value="<?=$products[$index]['quantity']?>" max="<?=$product['stock']?>">
                                <div class="arrow-container d-flex flex-column">
                                    <a href="traitement.php?action=increase&index=<?=$index?>"><i class="fa-solid fa-angle-up fa-sm"></i></a>
                                    <a href="traitement.php?action=decrease&index=<?=$index?>"><i class="fa-solid fa-angle-down fa-sm"></i></a>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="total-price d-flex">
                            <?=number_format($products[$index]['total'], 2, ",","")?>&euro;
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="row justify-content-end">
            <div class="totals col-4 col-md-3 col-xl-2">
                <p class="mb-0">
                    <span class="text bold">Livraison :</span>
                        <?= $shippingCost = 15;?>€
                </p>
                <span class="text bold">Sous-Total :
                    <?php 
                        $subTotal = 0;
                        foreach ($products as $index => $value) {
                            $subTotal += $products[$index]['total'];
                        }
                        $subTotal += $shippingCost;
                    ?>
                </span>
                <?=number_format($subTotal, 2, ",","") ?>&euro;
                <p> 
                    <span class="text bold">Total :</span> 
                    <?php 
                        $total = 0;
                        foreach ($products as $index => $value) {
                            $total += $subTotal;
                        }
                    ?>
                <?=number_format($subTotal, 2, ",","") ?>&euro;
                </p>
            </div>
        </div>
        <div class="row buttons d-flex flex-column flex-md-row justify-content-evenly py-3">
            <p class="col-12 col-lg-6 pt-3 pb-2 order-0 order-lg-1">
                <a class="d-flex justify-content-center m-auto btn btn-outline-dark align-items-center" href="traitement.php?action=order">Commander<i class="fa-solid fa-chevron-right ps-2"></i></a>
            </p>
            <p class="col-12 col-lg-6">
                <a class="d-flex justify-content-center m-auto mt-3 btn btn-outline-dark align-items-center" href="traitement.php?action=continue-purchase"><i class="fa-solid fa-chevron-left pe-2"></i>Continuer vos achats</a> 
            </p>
        </div>
    </form>
    <?php endif;?>
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