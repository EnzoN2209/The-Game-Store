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
    <title>Vérification de paiement</title>

    <style>
        /* Styles CSS pour la mise en page */

        body {
            background-color: rgb(32, 32, 32);
            color: white;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 10px); /* Modifier la hauteur du conteneur */
        }

        .verification {
            padding: 20px;
            margin-top: 10px; /* Ajouter une marge supérieure de 10px */
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .verification h2 {
            margin-top: 0;
        }

        .verification p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            background-color: rgb(32, 32, 32);
            color: white;
        }

        .button-group {
            margin-top: 20px;
            text-align: center;
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
    </style>
    <link rel="shortcut icon" type="image/png" href="../img/favicon.ico"/>
</head>

<body>
    <div class="container">
        <div class="verification">
            <h2>Vérification de paiement</h2>
            <form id="payment-form">
                <div class="form-group">
                    <label for="first-name">Prénom</label>
                    <input type="text" id="first-name" name="first-name" required>
                </div>
                <div class="form-group">
                    <label for="last-name">Nom</label>
                    <input type="text" id="last-name" name="last-name" required>
                </div>

                <div class="form-group">
                    <label for="email">adresse mail</label>
                    <input type="email" id="email" name="email" required> <!-- Utiliser le type "email" pour valider le format de l'adresse e-mail -->
                </div>
                <div class="form-group">
                    <label for="card-number">Numéro de carte</label>
                    <input type="text" id="card-number" name="card-number" required pattern="[0-9]{13,16}"> <!-- Utiliser un motif regex pour valider le numéro de carte -->
                </div>
                <div class="form-group">
                    <label for="card-name">Nom sur la carte (Prénom Nom)</label>
                    <input type="text" id="card-name" name="card-name" required pattern="^[a-zA-Z]+ [a-zA-Z]+$" placeholder="Prénom Nom">
                </div>

                <div class="form-group">
                    <label for="ccv">CCV (3 chiffres)</label>
                    <input type="text" id="ccv" name="ccv" required pattern="[0-9]{3}"> <!-- Utiliser un motif regex pour valider le CCV -->
                </div>
                <div class="form-group">
                    <label for="expiration-date">Date d'expiration (JJ/MM/AAAA)</label>
                     <input type="text" id="expiration-date" name="expiration-date" required pattern="^(0[1-9]|1[0-9]|2[0-9]|3[0-1])/(0[1-9]|1[0-2])/((20)\d{2}|(21[0-9][0-9]))$" placeholder="JJ/MM/AAAA">
                </div>

                <div class="button-group">
                    <button type="submit" class="orange-button">Valider</button>
                    <button type="button" class="orange-button" onclick="cancelPayment()">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function cancelPayment() {
            // Code à exécuter lors de l'annulation du paiement
            // Rediriger l'utilisateur vers une autre page ou effectuer d'autres actions nécessaires
        }

        document.getElementById("payment-form").addEventListener("submit", function(event) {
            event.preventDefault();
            // Code à exécuter lors de la validation du paiement
            // Effectuer les vérifications nécessaires, envoyer les données à un serveur, etc.
        });
    </script>
</body>
</html>
