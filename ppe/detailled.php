<?php
    require_once("db.php");
    require_once("header.php");
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title><?php
        // Défini des variables pour chaque élément
        $id = $_GET['id'];
        $requete = "SELECT * FROM articles WHERE ID_JEU = $id";
        $result = mysqli_query($conn, $requete);
        $myrow = $result->fetch_array();
        $name = $myrow['Nom'];
        $description = $myrow['Description'];
        echo "$name";
    ?></title>
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" type="image/png" href="img/favicon.ico"/>
    <script>
        // Fonction pour ajouter un ID de produit au panier
        function ajouterAuPanier(idProduit){
            // Vérifiez si le panier existe déjà
            var panier = JSON.parse(localStorage.getItem("panier")) || {};
            // Vérifiez si le produit est déjà dans le panier
            if(panier.hasOwnProperty(idProduit)){
                panier[idProduit]++;
            } else {
                panier[idProduit] = 1;
            }
             // Mettez à jour le panier dans le localStorage
            localStorage.setItem("panier", JSON.stringify(panier));
            // Redirigez l'utilisateur vers la page de panier d'achat
        }
    </script> 
</head>
<body style="background-color: rgb(51, 51, 51);">

    <div class="card">
        <?php
            // Récupère l'image du jeu
            $requete2 = "SELECT * FROM image WHERE ID_JEU = $myrow[ID_JEU]";
            $result2 = mysqli_query($conn, $requete2);
            $myrow2 = $result2->fetch_array();
            // Récupére la/les plateformes sur laquelle le jeu est disponible
            $requete3 = "SELECT * FROM disponible WHERE ID_JEU = $myrow[ID_JEU]";
            $result3 = mysqli_query($conn, $requete3);
            while($myrow3 = $result3->fetch_array()){
                // Ajoute chaque ID de plateforme dans le tableau "arr"
                $arr[] = $myrow3["ID_Plateforme"];
            }
            for($i = 0;$i < count($arr); $i++){
                // Récupère le nom correspondant à l'ID de chaque plateforme
                $requete3 = "SELECT * FROM plateforme WHERE ID_Plateforme = $arr[$i]";
                $result3 = mysqli_query($conn, $requete3);
                $myrow3 = $result3->fetch_array();
                // Ajoute le nom au tableau "arrPlat"
                $arrPlat[$i] = $myrow3["Nom"];
            }
            // implode va séparer chaque élément du tableau "arrPlat" avec des ,
            $plateformes = implode(",",$arrPlat);
            // data:image/png;base64, base64_encode de myrow2["Lien"] va encoder le blob "Lien" stocké dans la base et le transformer en image
            echo '<img class="card-back-img" src="data:image/png;base64,' . base64_encode($myrow2["Lien"]) . '" />';
            echo '<div class="card-infos">';
                // data:image/png;base64, base64_encode de myrow2["Lien"] va encoder le blob "Lien" stocké dans la base et le transformer en image
                echo '<img class="card-img" src="data:image/png;base64,' . base64_encode($myrow2["Lien"]) . '" />';
                echo '<div class="card-infos-game">';
                    echo '<div class="card-infos-game-inner">';
                        echo "<span id='card-infos-game-inner-name'>$name</span>";
                        echo '<span id="card-infos-game-inner-price">'.$myrow["Prix"].'€</span> ';
                        // $plateformes contient les plateformes du tableau précedemment crée, avec chaque plateforme séparée par des virgules
                        echo '<span id="card-infos-game-inner-plateformes">Disponible sur '.$plateformes.'</span> ';
                        echo '<button id="card-infos-game-inner-cart" onclick="ajouterAuPanier('.$id.')">Ajouter au panier</span> ';
                    echo "</div>";

                echo "</div>";
            echo "</div>";
            echo "<div class='card-description'>";
                echo "<span id='description-title'>Description</span>";
                echo "<span id='description-text'>".$description."</span>";
            echo "</div>";
            
        ?>
    </div>
    <?php
        require_once("footer.php");
    ?>
</body>
</html>