<?php
    require_once("db.php");

?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Game Store</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" type="image/png" href="img/favicon.ico"/>

</head>
<body>
    <script src="js/jquery.js"></script>
    <script>
        //Array contenant les images du carroussel
        const slide = ["img/hl.jpg", "img/elde.jpg", "img/fifa.jpg", "img/dredge.jpg", "img/mine.jpg"];
        let numero = 0;

        //Fonction gérant le caroussel d'image avec flèche
        function ChangeSlide(sens) {
            numero = numero + sens;
            if (numero < 0)
                numero = slide.length - 1;
            if (numero > slide.length - 1)
                numero = 0;
            document.getElementById("frontIMG").src = slide[numero];
}
    </script>
    <?php require_once("header.php"); ?>
    <div id="header-space"></div>
    <img id="frontIMG" src="img/hl.jpg">
    <!--"precedent" et "suivant" sont les boutons du caroussel d'image, permettant d'avancer ou de reculer d'une image -->
    <div id="precedent" onclick="ChangeSlide(-1);"><</div>
    <div id="suivant" onclick="ChangeSlide(1)">></div>
    <div class="products-genre">
        <div class="game-action-label">
            <span id="action">Jeux d'Action</span>
            <a id="show-catalogue" href="catalogue.php">Voir catalogue</a>
        </div>
        <div class="games">
            <?php
                $requete = "SELECT * FROM appartenir WHERE ID_Genre = 1 ";
                $result = mysqli_query($conn, $requete);
                //Boucle récupérant tous les ID_JEU où le genre est "Action", et met les ID_JEU dans le tableau "listActionGames"
                while($myrow = $result->fetch_array()){
                    $listActionGames[] = $myrow["ID_JEU"];
                }
                //Boucle récupérant les éléments du tableau "listActionGames" et les affichants
                foreach($listActionGames as $value){
                    $requete = "SELECT * FROM articles WHERE ID_JEU = $value";
                    $result = mysqli_query($conn, $requete);
                    $myrow = $result->fetch_array();
                    echo "<div class='game'>";
                        $requete2 = "SELECT * FROM image WHERE ID_JEU = $myrow[ID_JEU]";
                        $result2 = mysqli_query($conn, $requete2);
                        $myrow2 = $result2->fetch_array();
                        if(mysqli_num_rows($result2) == 0 ){
                            echo("<div class='error-img'>");
                                echo("<span>Pas d'image</span>");
                            echo("</div>");
                        } else{
                            // Affiche l'image du jeu, quand on clique ça nous envoie vers la page détaillée
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

            ?>
        </div>
        
    </div>

    <div class="products-genre">
        <div class="game-action-label">
            <span id="action">Jeux d'Aventure</span>
            <a id="show-catalogue" href="catalogue.php">Voir catalogue</a>
        </div>
        <div class="games">
            <?php
                $requete = "SELECT * FROM appartenir WHERE ID_Genre = 3 ";
                $result = mysqli_query($conn, $requete);
                //Boucle récupérant tous les ID_JEU où le genre est "Aventure", et met les ID_JEU dans le tableau "listAventureGames"
                while($myrow = $result->fetch_array()){
                    $listAventureGames[] = $myrow["ID_JEU"];
                }
                //Boucle récupérant les éléments du tableau "listAventureGames" et les affichants
                foreach($listAventureGames as $value){
                    $requete = "SELECT * FROM articles WHERE ID_JEU = $value";
                    $result = mysqli_query($conn, $requete);
                    $myrow = $result->fetch_array();
                    echo "<div class='game'>";
                        $requete2 = "SELECT * FROM image WHERE ID_JEU = $myrow[ID_JEU]";
                        $result2 = mysqli_query($conn, $requete2);
                        $myrow2 = $result2->fetch_array();
                        if(mysqli_num_rows($result2) == 0 ){
                            echo("<div class='error-img'>");
                                echo("<span>Pas d'image</span>");
                            echo("</div>");
                        } else{
                            // Affiche l'image du jeu, quand on clique ça nous envoie vers la page détaillée
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

            ?>
        </div>
        
    </div>


    <?php
        require_once("footer.php");
    ?>
    
</body>
</html>