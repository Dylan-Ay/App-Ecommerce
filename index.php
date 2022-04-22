<?php 
    session_start();
    //$h1 = "Ajouter un produit";
    $title = "Product Page";
    include('header.php');
    require_once('mysql.php');
    require_once('Control.php');
?>

<?php 
    // On instancie la class Control
    $control = new Control($mysqlClient);

    // On récupère dans la base de donnée le produit
    $products = ($control->get_product());
    
    // Boucle le tableau du produit
    foreach ($products as $key => $value) { 
    } 
    $productName = $products['name'];
    $productPrice = $products['price'];
    $productPicture = "<img src='".$products['picture']."' class='img-fluid' alt='" .$products['name']."'>";
    $productId = $products['product_id'];
?>

<section id="product">
    <?= $productPicture?>
    <div class="container py-3">
        <?php if (isset($_SESSION['message'])): echo $_SESSION['message']; endif;?>
        <small class="primary-color bold">SNEAKER COMPANY</small>
        <h1 class="py-3">
            <strong><?= $productName?></strong>
        </h1>
        <p class="dark-grayish-blue">
            These low-profile sneakers are your perfect casual wear companion. Featuring a 
            durable rubber outer sole, they’ll withstand everything the weather can offer.
        </p>
        <span id="price" class="bold">$<?= $productPrice?>.00</span>
        <form class="py-3" action="traitement.php?action=add" method="post">
            <div class="container-qtt">
                <img src="images/icon-minus.svg" id="minus" alt="minus icon">
                <img src="images/icon-plus.svg" id="plus" alt="minus icon">
                <input  class="btn w-100 no-arrow" type="number" name="qtt" id="qtt" 
                value="<?php echo htmlspecialchars($_POST['qtt'] ?? 0, ENT_QUOTES); ?>">
            </div>
            <figure class="container-add-cart">
                <img src="images/icon-cart-1-white.svg" alt="cart icon">
                <input  class="btn my-3 w-100" type="submit" name="submit" value="Add to cart">
            </figure>
        </form>
    </div>
</section>

<?php include('footer.php');?>

<!--<div class="row m-auto">
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
                <input class="form-control" type="number" name="qtt">
            </label>
        </p>
        <p>
            <input  type="submit" class="btn btn-outline-dark" name="submit" value="Ajouter le produit">
        </p>
    </form>
</div>-->