<?php
require_once("db.php");
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="img/favicon.ico"/>
    <title>Catalogue</title>
</head>
<body id="catalogue-body">
    <?php 
        require_once("header.php")
    ?>
    <div class="header-takeplace"></div>
    <div class="catalogue">
        <div class="catalogue-parameters">
        </div>

        <div class="catalogue-products">
            <div class="catalogue-games">
                <?php
                    // isset de get de search va vérifier si l'utilisateur a cherché quelque chose dans la searchbar
                    if(isset($_GET["search"])){
                        $value = $_GET["search"];
                        // va vérifier si un nom contenant les caractères entrés par l'utilisateur existe dans la base
                        $requete = "SELECT * FROM articles WHERE Nom LIKE '". "%$value%" ."'";
                        $result = mysqli_query($conn, $requete);
                        if(mysqli_num_rows($result) < 1){
                            // Si il n'y a pas de nom similaire, affiche ça
                            echo("<span id='noGameFound'>Aucun jeu n'a été trouvé !</span>");
                            exit();
                        }
                        // Va afficher les jeux correspondant à la recherche
                        while($myrow = $result->fetch_array()){
                            echo "<div class='game'>";
                                $requete2 = "SELECT * FROM image WHERE ID_JEU = $myrow[ID_JEU]";
                                $result2 = mysqli_query($conn, $requete2);
                                $myrow2 = $result2->fetch_array();
                                // Va vérifier si il existe une image pour le jeu, sinon affiche "Pas d'image"
                                if(mysqli_num_rows($result2) == 0 ){
                                    echo("<div class='error-img'>");
                                        echo("<span>Pas d'image</span>");
                                    echo("</div>");
                                } else{
                                    // data:image/png;base64, base64_encode de myrow2["Lien"] va encoder le blob "Lien" stocké dans la base et le transformer en image
                                    echo '<a href ="detailled.php?id='.$myrow["ID_JEU"].'"><img class="game-img" src="data:image/png;base64,' . base64_encode($myrow2["Lien"]) . '" /> </a>';
                                }
                                echo("<div class='game-infos'");
                                // Bout de code permettant de couper les noms de jeux qui sont trop long, au bout de 30 char ça remplace par des ...
                                if (strlen($myrow["Nom"])> 30){
                                    // Récupère tous le caractères du premier au 30ième de la chaîne "Nom"
                                    $name = substr($myrow["Nom"], 0, 30);
                                    // strrpos va récupérer la position d'un espace dans la chaîne de caractère name si il y en a un
                                    $position_espace = strrpos($name, " ");
                                    // Va récupérer tous les caractères du premier jusqu'à l'espace trouvé (si il y en a un), afin d'éviter de couper le nom du jeu juste après un espace (ex : Hogwarts L)
                                    $name = substr($name, 0, $position_espace);
                                    // Va définir name à la chaîne de caractère allant de 0 à 30, en prenant en compte si il y a un espace ou non, et va mettre "..." une fois les 30 atteins
                                    $name = $name."...";
                                    echo("<span id='game-name'>$name</span>");
        
                                } else{
                                    echo("<span id='game-name'>$myrow[Nom]</span>");
                                }
                                    echo("<span id='game-price'>$myrow[Prix]€</span>");
                                echo("</div>");
        
                            echo "</div>";
                        }
                    } else{
                        // Affiche le catalogue si aucune recherche n'a été faite.
                        $requete = "SELECT * FROM articles";
                        $result = mysqli_query($conn, $requete);
                        while($myrow = $result->fetch_array()){
                            echo "<div class='game'>";
                                $requete2 = "SELECT * FROM image WHERE ID_JEU = $myrow[ID_JEU]";
                                $result2 = mysqli_query($conn, $requete2);
                                $myrow2 = $result2->fetch_array();
                                if(mysqli_num_rows($result2) == 0 ){
                                    echo("<div class='error-img'>");
                                        echo("<span>Pas d'image</span>");
                                    echo("</div>");
                                } else{
                                    // data:image/png;base64, base64_encode de myrow2["Lien"] va encoder le blob "Lien" stocké dans la base et le transformer en image
                                    echo '<a href ="detailled.php?id='.$myrow["ID_JEU"].'"><img class="game-img" src="data:image/png;base64,' . base64_encode($myrow2["Lien"]) . '" /> </a>';
                                }
                                echo("<div class='game-infos'");
                                 // Bout de code permettant de couper les noms de jeux qui sont trop long, au bout de 30 char ça remplace par des ...
                                if (strlen($myrow["Nom"])> 30){
                                     // Récupère tous le caractères du premier au 30ième de la chaîne "Nom"
                                    $name = substr($myrow["Nom"], 0, 30);
                                    // strrpos va récupérer la position d'un espace dans la chaîne de caractère name si il y en a un
                                    $position_espace = strrpos($name, " ");
                                    // Va récupérer tous les caractères du premier jusqu'à l'espace trouvé (si il y en a un), afin d'éviter de couper le nom du jeu juste après un espace (ex : Hogwarts L)
                                    $name = substr($name, 0, $position_espace);
                                    // Va définir name à la chaîne de caractère allant de 0 à 30, en prenant en compte si il y a un espace ou non, et va mettre "..." une fois les 30 atteins
                                    $name = $name."...";
                                    echo("<span id='game-name'>$name</span>");
                                } else{
                                    echo("<span id='game-name'>$myrow[Nom]</span>");
                                }
                                    echo("<span id='game-price'>$myrow[Prix]€</span>");
                                echo("</div>");
                            echo "</div>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <?php 
        require_once("footer.php")
    ?>
</body>
