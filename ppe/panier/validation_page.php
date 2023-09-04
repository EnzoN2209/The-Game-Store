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
    <title>Validation de commande</title>
    <style>
        body {
            background-color: rgb(32, 32, 32);
            color: white;
        }

        .cadre_validation {
            padding: 10px;
            margin-bottom: 100px;
            width: 100%;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.1); 
        }

        .cadre_validation p {
            font-size: 20px;
            font-weight: bold;
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

    <script>
        function endBuy(){
            localStorage.clear();
            window.location.href = "../index.php";
        }

    </script>
    <link rel="shortcut icon" type="image/png" href="../img/favicon.ico"/>
</head>

<body>
    <h1></h1>
    <div class="container">
        <div class="cadre_validation">
            <h2>Validation de commande</h2>
            <div style="text-align: center; border: 1px solid black; padding: 20px;">
                <p style="font-size: 24px; font-weight: bold;">Votre commande a été validée avec succès !</p>
            </div>
            <div style="text-align: center; margin-top: 20px;">
                <button class="orange-button" onclick="endBuy();">Continuer votre shopping</button>
            </div>
        </div>
    </div>
</body>
</html>
