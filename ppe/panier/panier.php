<!DOCTYPE html>
<html>
<?php
require_once("../db.php");
?>
<?php
require_once("header.php");
?>
<?php
session_start();
?>
<head>
    <title>Panier</title>
    <style>
        body {
            background-color: rgb(32, 32, 32);
            color: white;
        }

        .container {
            display: flex;
            justify-content: space-between;
        }

        .cadre_panier {
            padding: 10px;
            margin-bottom: 10px;
            width: 35%;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.1); 
        }

        .cadre_résumé {
            padding: 10px;
            margin-bottom: 100px;
            width: 25%;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.1); 
        }

        .resume-buttons {
            text-align: center;
            margin-top: 10px;
        }

        .orange-button {
            background-image: linear-gradient(to left, #ff2020, #ff8000);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .orange-button:hover {
            background-image: linear-gradient(to bottom, #FFA500, #FF8C00);
        }

        input[type="number"] {
            color: white;
            background-color: rgb(32, 32, 32) ;
        }
    </style>
    <link rel="shortcut icon" type="image/png" href="../img/favicon.ico"/>


    <?php
        if (!isset($_SESSION['ID']) && !isset($_SESSION['User'])){
            header("Location: ../connexion/login.php");
        }


    ?>
</head>

<body>
    <div id="header-space"></div>
    <h1></h1>
    <div class="container">
        <div class="cadre_panier">
            <h2>Panier</h2>
            <table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix unitaire (€)</th>
                        <th>Quantité</th>
                    </tr>
                </thead>
                <tbody id="panier">
                </tbody>
            </table>
            <button class="orange-button" onclick="deleteItems()">Supprimer le panier</button>
        </div>

        <div class="cadre_résumé">
            <h2>Résumé</h2>
            <table>
                <tbody id="resume">
                </tbody>
            </table>
        
            <div class="resume-buttons">
                <button class="orange-button" onclick="window.location.href='beforebuying.php'">Valider la commande</button>
                <hr>
                <button class="orange-button" onclick="window.location.href='../index.php'">Continuer votre shopping</button>
            </div>
        </div>
    </div>

    <script>
        // Récupérez les données du panier depuis le localStorage
        var panier = JSON.parse(localStorage.getItem("panier")) || {};

        // Parcourez les éléments du panier et ajoutez-les à la table "Panier"
        var tbodyPanier = document.getElementById("panier");
        var total = 0;
        for (var idProduit in panier) {
            // Récupérez les informations du produit depuis le serveur
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "getProduit.php?id=" + idProduit, false);
            xhr.send();
            var produit = JSON.parse(xhr.responseText);

            // Calculez le prix total pour ce produit
            var prixTotal = panier[idProduit] * produit.Prix;

            // Ajoutez une nouvelle ligne à la table "Panier" pour ce produit
            var tr = document.createElement("tr");
            var tdNom = document.createElement("td");
            tdNom.textContent = produit.Nom;
            var tdPrixUnitaire = document.createElement("td");
            tdPrixUnitaire.textContent = produit.Prix;
            var tdQuantite = document.createElement("td");

            // Créez un nouvel élément input pour la quantité
            var inputQuantite = document.createElement("input");
            inputQuantite.type = "number";
            inputQuantite.value = panier[idProduit];
            inputQuantite.min = "0";
            inputQuantite.style.width = "50px"; // Adjust the width of the quantity input

            // Écoutez l'événement de changement de la quantité
            inputQuantite.addEventListener("change", createChangeQuantityHandler(idProduit));

            tdQuantite.appendChild(inputQuantite);

            tr.appendChild(tdNom);
            tr.appendChild(tdPrixUnitaire);
            tr.appendChild(tdQuantite);
            tbodyPanier.appendChild(tr);
            // Ajoutez le prix total pour ce produit au prix total de la commande
            total += prixTotal;
        }

        // Affichez le prix total de la commande dans le cadre "Résumé"
        var tbodyResume = document.getElementById("resume");

        // Créez une nouvelle ligne dans le tableau "Résumé" pour afficher le prix total
        var trTotal = document.createElement("tr");
        var tdTotalLabel = document.createElement("td");
        tdTotalLabel.textContent = "Total (€)";
        var tdTotal = document.createElement("td");
        tdTotal.colSpan = 2;
        tdTotal.textContent = total;

        trTotal.appendChild(tdTotalLabel);
        trTotal.appendChild(tdTotal);

        tbodyResume.appendChild(trTotal);

        // Fonction pour la modification individuelle des quantités
        function createChangeQuantityHandler(productId) {
            return function(event) {
                // Récupérez la nouvelle quantité saisie par l'utilisateur
                var nouvelleQuantite = parseInt(event.target.value);

                // Vérifiez si la nouvelle quantité est inférieure à zéro
                if (nouvelleQuantite < 0) {
                    nouvelleQuantite = 0;
                }

                // Mettez à jour la quantité dans le panier
                panier[productId] = nouvelleQuantite;

                // Enregistrez les modifications du panier dans le localStorage
                localStorage.setItem("panier", JSON.stringify(panier));

                // Rechargez la page pour afficher les changements
                window.location.reload();
            };
        }

        function deleteItems() {
            // Suppression totale du panier
            localStorage.clear();
            window.location.reload();
        }
    </script>
</body>
</html>
