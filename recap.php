<?php
    session_start();
    $h1 = "Récapitulatif de la commande";
    $title = "Récapitulatif de la commande";
    include('header.php');
    //On créee une session ou on poursuit avec une session déjà créee (la session est dans header.php)
?>
<body>
    <div class="container">
        <?php
            // Si le tableau dont la clé 'products' n'est pas défini ou si le tableau de la SESSION dont la clé 'products' est vide
            //Alors on affiche qu'aucun produit n'est en session (aucun produit n'a été ajouté au tableau)
            
            if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
                echo "<p class='text-center'>Vous n'avez ajouté aucun produit...</p>";
            } else {
                if (isset($_SESSION['delete'])): echo $_SESSION['delete']; endif; 
                //En-tête du tableau
                echo "<table class='m-auto table table-responsive'>",
                        "<thead>",
                            "<tr>",
                                '<th scope="col">Modifier la quantité</th>',
                                '<th scope="col">#</th>',
                                '<th scope="col">Nom</th>',
                                '<th scope="col">Prix</th>',
                                '<th scope="col">Quantité</th>',
                                '<th scope="col">Total</th>',
                                '<th scope="col">Supprimer le produit</th>',
                            '</tr>',
                        '</thead>',
                        '<tbody>';
                // On crée la variable totalGeneral pour pouvoir lui attribuer le total de chaque produit pour avoir le total général
                $totalGeneral = 0;
                //Pour chaque élement du tableau SESSION dont la clé est 'products' on crée un tableau graphique
                // On utilise $index dans les colonnes où l'on va récupérer une action avec $_GET "?action=..." est envoyé dans $_GET tout autant que "&index=" qui lui récupère l'index de la colonne en question
                foreach ($_SESSION['products'] as $index => $product) {
                    echo "<tr>",
                            "<td class='text-center'> 
                                <a href='traitement.php?action=increase&index=$index'><i class='fa-solid fa-plus pe-2'></i></a>
                                <a href='traitement.php?action=decrease&index=$index'><i class='fa-solid fa-minus'></i></a>
                            </td>",
                            '<td class="px-2">'.$index."</td>",
                            '<td class="px-2">'.$product['name']."</td>",
                            // On modifie l'affichage du prix
                            '<td class="px-2">'.number_format($product['price'], 2, ",","%nbsp;")."€</td>",
                            '<td class="px-2">'.$product['qtt']."</td>",
                            '<td class="px-2">'.number_format($product['total'], 2, ",","%nbsp;")."€</td>",
                            "<td> 
                                <a href='traitement.php?action=delete-unit&index=$index'>Supprimer</a>
                            </td>",
                        "</tr>";
                    // On ajoute chaque produit du tableau SESSION dont la clé est 'total' à la variable totalGeneral
                    $totalGeneral+= $product['total'];
                }
                echo "<tr>",
                        "<td class='px-2' colspan=4>Total général : </td>",
                        "<td></td>",
                            "<td class='px-2'><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                    "</tr>",
                "</tbody>",
            "</table>",
            '<p>
                <a style="width: 200px"; class="d-flex justify-content-center m-auto mt-3" href="traitement.php?action=delete-all">Supprimer tous les produits</a>
            </p>';
            }
        ?>
        <?php //var_dump($_SESSION['products'])?>
    </div>
    <?php include('js.php');?>
    <pre>
    </pre>
</body>
</html>