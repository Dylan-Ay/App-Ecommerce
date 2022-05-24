<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">
    <script src="https://kit.fontawesome.com/aadee783c9.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg py-3">
            <div class="container">
                <div class="row">
                    <div class="col d-flex">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa-solid fa-bars"></i>
                        </button>
                        </div>
                    <div class="col">
                        <a class="navbar-brand" href="product_controller.php?action=unset-accueil">Sneakers</a>
                    </div>
                </div>
                <div class="row flex-nowrap align-items-center order-lg-1">
                    <div class="col d-flex align-items-end user-content">
                        <a href="index.php?page=login" class="d-flex align-items-center">
                            <i class="fa-solid fa-user"></i>
                            <?php if (isset($_COOKIE['firstname'])): echo "<span class='ms-2 name'>" .$_COOKIE['firstname']."</span>"; endif;?>
                        </a>
                    </div>
                    <div class="col">
                        <figure>
                            <a href="product_controller?action=unset-panier">
                            <i class="fa-solid fa-bag-shopping"></i>
                            </a>
                            <figcaption>
                                <?php 
                                    if (isset($_SESSION['products'])){ 
                                        $totalQuantity = 0;
                                        foreach ($_SESSION['products'] as $key => $value) {
                                            $totalQuantity += $_SESSION['products'][$key]['quantity'];
                                        }
                                        echo $totalQuantity;
                                    }else{
                                        echo 0;
                                    }
                                ?>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="col pt-1">
                        <a href="#">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav justify-content-evenly w-100 align-items-center pt-4 pb-lg-4 flex-md-row">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php?page=home">Accueil</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="index.php?page=products">Produits</a>
                        </li>
                        <!-- <li class="nav-item ">
                            <a class="nav-link" href="#">Hommes</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#">Femmes</a>
                        </li> -->
                        <li class="nav-item ">
                            <a class="nav-link" href="#">A Propos</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>   
        </nav>
        <?php if (isset($h1)):?>
            <h1 class="text-center py-5 mx-3"><?= $h1?></h1>
        <?php endif;?>
    </header>
    <main>

        <?= $content ?>
        
    </main>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/website.js"></script>

    <!------- FOOTER ------->
    <footer class="w-100 py-4 flex-shrink-0">
        <div class="container py-4">
            <div class="row gy-4 gx-5">
                <div class="col-lg-4 col-md-6">
                    <h5 class="h1 text-white">Sneakers</h5>
                    <p class="small text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                    <p class="small text-muted mb-0">&copy; Réalisé par <a href="https://dylanayache.com" target="_blank" class="text-muted">Dylan Ayache</a> - Tous droits réservés.</p>
                </div>
                <div class="col-lg-4 col-md-12">
                    <h5 class="text-white mb-3">Pages du site</h5>
                    <nav class="list-unstyled text-muted">
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="index.php?page=products">Produits</a></li>
                        <li><a href="#">A Propos</a></li>
                        <li><a href="#">Contact</a></li>
                    </nav>
                </div>
                <!-- <div class="col-lg-2 col-md-6">
                    <h5 class="text-white mb-3">Quick links</h5>
                    <nav class="list-unstyled text-muted">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Get started</a></li>
                        <li><a href="#">FAQ</a></li>
                    </nav>
                </div> -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-white mb-3">Newsletter</h5>
                    <p class="small text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                    <form action="#">
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" placeholder="Adresse email" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-primary" id="button-addon2" type="button"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>