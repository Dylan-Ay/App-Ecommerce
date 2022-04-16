<?php
    session_start();
    $h1 = "Le contenu de mon panier.";
    $title = "Récapitulatif de la commande";
    include('header.php');
    //On créee une session ou on poursuit avec une session déjà créee (la session est dans header.php)
?>

<div id="recap" class="container text-center">
    <?php
        // Si le tableau dont la clé 'products' n'est pas défini ou si le tableau de la SESSION dont la clé 'products' est vide
        //Alors on affiche qu'aucun produit n'est en session (aucun produit n'a été ajouté au tableau)
        
        if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
            echo "<p class='pt-4'>Votre panier est vide.</p><br>
                <a href='index.php'>
                    <div class='btn btn-outline-dark'>Retour à l'accueil</div>
                </a>
            ";
        } else {
            if (isset($_SESSION['delete'])): echo $_SESSION['delete']; endif; 
            //En-tête du tableau
            echo 
                "<table class='m-auto table d-flex flex-column'>",
                    '<tbody>';
            // On crée la variable totalGeneral pour pouvoir lui attribuer le total de chaque produit pour avoir le total général
            $totalGeneral = 0;
            //Pour chaque élement du tableau SESSION dont la clé est 'products' on crée un tableau graphique
            // On utilise $index dans les colonnes où l'on va récupérer une action avec $_GET "?action=..." est envoyé dans $_GET tout autant que "&index=" qui lui récupère l'index de la colonne en question
            foreach ($_SESSION['products'] as $index => $product) {
                echo "<tr class='d-flex justify-content-evenly align-items-center'>",
                '<td class="px-2 d-none">'.$index."</td>",
                '<td class="px-2 name">'.$product['name']."</td>",
                // On modifie l'affichage du prix <input class="form-control" type="number" name="qtt" value="1">
                '<td class="px-2 d-flex">
                <input disabled class="form-control qtt" type="text" name="qtt" value="'.$product['qtt'].'">
                
                <div class="arrow-container d-flex flex-column">
                <a href=traitement.php?action=increase&index='.$index.'><i class="fa-solid fa-angle-up fa-sm"></i></i></a>
                <a href=traitement.php?action=decrease&index='.$index.'><i class="fa-solid fa-angle-down fa-sm"></i></a>
                </div>
                </td>',
                '<td class="px-2 price">'.number_format($product['total'], 2, ",","%nbsp;")."€</td>",
                "<td> 
                    <a href='traitement.php?action=delete-unit&index=$index'><i class='fa-solid fa-trash'></i></i></a>
                </td>",
                "</tr>";
                // On ajoute chaque produit du tableau SESSION dont la clé est 'total' à la variable totalGeneral
                $totalGeneral+= $product['total'];
            }
            echo 
            "</tbody>",
            "<tfoot>",
                "<tr class='d-flex justify-content-center py-3'>",
                        "<td class='px-2' colspan=4>Total général : </td>",
                        "<td></td>",
                            "<td class='px-2'><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                "</tr>",
            "</tfoot>",
        "</table>",
        '<p class="py-4">
            <a class="d-flex justify-content-center m-auto btn btn-outline-dark" href="login.php">Commander</a>
        </p>',
        '<p class="">
            <a class="d-flex justify-content-center m-auto mt-3 btn btn-outline-dark" href="traitement.php?action=delete-all">Vider le panier</a>
        </p>';
        }
    ?>
    <?php //var_dump($_SESSION['products'])?>
</div>

<?php include('footer.php');?>