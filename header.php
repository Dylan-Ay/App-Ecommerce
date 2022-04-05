<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/aadee783c9.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
            <div class="container">
                <a class="navbar-brand" href="index.php">Appli PHP 1</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav flex-row justify-content-center">
                        <li class="nav-item active">
                            <a class="nav-link flex-grow-1" href="index.php">Accueil</a>
                        </li>
                        <li class="nav-item mx-5">
                            <a class="nav-link" href="recap.php">Récapitulatif</a>
                        </li>
                        <span class="d-flex align-items-center font-weight-bold">Nombre de produits : 
                            <?php 
                            if ( isset($_SESSION['products'])){ 
                                echo count($_SESSION['products']);
                            }else{
                                echo 0;
                            }
                            ?>
                        </span>
                    </ul>
                </div>   
            </div>
        </nav>
        <h1 class="text-center py-5"><?= $h1?></h1>
    </header>