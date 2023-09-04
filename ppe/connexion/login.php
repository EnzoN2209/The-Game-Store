<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" type="image/png" href="../img/favicon.ico"/>
    <title>Connexion</title>
</head>
<script>
    function showpassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

<body>
    <?php
        session_start();
        if (isset($_SESSION['ID']) && isset($_SESSION['User'])){
            header("Location: home.php");
        }

    ?>
    <div class="grid">
        <div class="background">
            <div class="logo"><a href="../index.php"><img class="logo" src="img/logo.png"></a></div>
            <div class="register">
                <div class="login">
                    <form class="connect" action="connexion.php" method="POST">
                        <div class="spacer"></div>
                        <div style="color: white; font-size: 22px; margin-left:10px" class="connexion">
                            <h3>Se connecter</h3>
                        </div>
                        <div class="spacer"></div>
                        <div class="spacer"></div>
                        <div class="user">
                            <input class="comForm" type="text" name="username" placeholder="Nom d'utilisateur" size="30" id="username" />
                        </div>
                        <div class="mdp">
                            <input class="comForm" type="password" name="password" placeholder="Mot de passe" size="30" id="password" />
                        </div>
                        <div class=showpass>
                            <input type="checkbox" name="showpass" onclick="showpassword()">
                            <a style="color: white;font-size: 15px;">Montrer le mot de passe</a>
                        </div>

                        <div class="button"><input class="logbutton" type="submit" id="log" value="Connexion" /></div>

                        <div class="forgot">

                            <a href="forgot.php" class="forgotpassword">Mot de pass oublié</a>
                            <a href="register.php" class="createacc">Pas encore de compte ?</a>
                        </div>
                        <div style="height:40px"></div>
                        <?php
                        if (isset($_GET["error"])) {
                            echo "<span id='errormsg'>*Identifiants invalides</span>";
                        }
                        ?>
                    </form>

                </div>


            </div>
        </div>
        <div class="background2">

            <img style="width: 100%; height: 100%" src="img/img_grid.jpg">
        </div>
    </div>

</body>

</html>