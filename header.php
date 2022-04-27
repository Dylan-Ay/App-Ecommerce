<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
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
                        <a class="navbar-brand" href="traitement.php?action=unset-accueil">Sneakers</a>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav justify-content-evenly w-100 align-items-center py-4">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Accueil</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="index.php?page=products">Products</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#">Men</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#">Women</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="row flex-nowrap">
                    <div class="col">
                        <figure>
                            <a href="traitement.php?action=unset-panier">
                                <img src="images/icon-cart-1.svg" alt="Icon panier">
                            </a>
                            <figcaption>
                                <?php 
                                    if ( isset($_SESSION['products'])){ 
                                        echo count($_SESSION['products']);
                                    }else{
                                        echo 0;
                                    }
                                ?>
                            </figcaption>
                        </figure>
                        </div>
                    <div class="col d-flex align-items-end">
                        <a href="login.php">
                            <i class="fa-regular fa-circle-user"></i>
                        </a>
                    </div>
                </div>
            </div>   
        </nav>
        <?php if (isset($h1)):?>
            <h1 class="text-center py-5 mx-3"><?= $h1?></h1>
        <?php endif;?>
    </header>
    <main>