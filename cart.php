<section class="container" id="cart">
    <h1 class="text-center py-5 border-bottom-title">Le contenu de mon panier.</h1>
    <?php if (isset($_SESSION['products'])): $products =  $_SESSION['products']; endif;?>
    <?php if (empty($products)): ?>
        <div class="container-empty text-center">
            <p class='pt-4'>Votre panier est vide.</p><br>
            <a href='index.php'>
                <div class='btn btn-outline-dark'>Retour à l'accueil</div>
            </a>
        </div>
        <?php else: ?>
            <?php if (isset($_SESSION['delete'])): echo $_SESSION['delete']; endif;?>
            <form action="index.php?page=cart" method="post" class="py-5">
                <table class="w-100 table">
                    <thead class="bold">
                        <tr>
                            <td colspan="2">Products</td>
                            <td>Price</td>
                            <td class="text-center">Quantity</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php foreach ($products as $index => $product): // ForEach pour afficher un produit par ligne ?>
                            <tr class="my-3">
                    <td class="img py-3">
                        <a href="index.php?page=product&product_id=<?=array_key_first($products[$index]);?>">
                            <img src="<?=$products[$index]['picture']?>" alt="<?=$products[$index]['name']?>">
                        </a>
                    </td>
                    <td class="d-flex name">
                         <a href="index.php?page=product&product_id=<?=array_key_first($products[$index]);?>"><?=$products[$index]['name']?></a>
                        <br>
                        <a href="traitement.php?action=delete-unit&index=<?=$index?>" class="remove"><i class="fa-solid fa-trash ms-3"></i></a>
                    </td>
                    <td>
                        <span class="price d-flex">
                            <?=$products[$index]['price']?>&euro;
                        </span>
                    </td>
                    <td>
                        <div class="quantity d-flex">
                            <div class="quantity-input-container d-flex">
                                <input disabled class="form-control qtt" type="text" name="qtt" value="<?=$products[$index]['quantity']?>" max="<?=$product['max-quantity']?>">
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
                            $subTotal += $products[$index]['quantity'] * $products[$index]['price'] + $shippingCost;
                        }
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
            <!-- <input type="submit" value="Update" name="update">
            <input type="submit" value="Place Order" name="placeorder"> -->
            <p class="col-12 col-lg-6 pt-3 pb-2 order-0 order-lg-1">
                <a class="d-flex justify-content-center m-auto btn btn-outline-dark" href="traitement.php?action=order">Commander</a>
            </p>
            <p class="col-12 col-lg-6">
                <a class="d-flex justify-content-center m-auto mt-3 btn btn-outline-dark" href="traitement.php?action=delete-all">Vider le panier</a> 
            </p>
        </div>
    </form>
    <?php endif;?>
</section>

<?php var_dump($_SESSION['products'])?>

<?php if (isset($_SESSION['test'])): echo "test"; endif;?>