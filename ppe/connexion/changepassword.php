<?php
require_once("../db.php");
session_start();

if (isset($_SESSION['ID']) && isset($_SESSION['User'])) {
     require_once("header.php")
?>
     <!DOCTYPE html>

     <head>
          <meta charset="UTF-8">
          <link rel="stylesheet" href="styles.css">
     </head>

     <body>
          <script>
          </script>
          <div class="header-container">
               <a href="../index.php"><img id="logo" src="img/logo.png"></a>
               <div class="searchBar">
                    <form class="search-form" action="../catalogue.php" method="get">
                         <input id="searchBAR" name="search" type="text" value="" />
                    </form>
               </div>
               <div class="menu">
                    <a href="../panier/panier.php"><img id="cart-img" src="cart.png"></a>
                    <a href="login.php"><img id="account-img" src="account.png"></a>
               </div>
          </div>
     </body>

     </html>
     <!DOCTYPE html>
     <html>

     <head>

          <script>
               function showpassword() { //Script pour afficher le mot de passe 
                    var x = document.getElementById("pwd");
                    if (x.type === "password") {
                         x.type = "text";
                    } else {
                         x.type = "password";
                    }
                    var y = document.getElementById("confpwd");
                    if (y.type === "password") {
                         y.type = "text";
                    } else {
                         y.type = "password";
                    }
                    var y = document.getElementById("cpwd");
                    if (y.type === "password") {
                         y.type = "text";
                    } else {
                         y.type = "password";
                    }
               }

               function verifier() {
                    var ok = true;

                    //check password requirment 
                    var ctrlcpwd = document.getElementsByName("pwd")[0]

                    const strcpwd = ctrlcpwd.value;
                    const regexcpwd = new RegExp(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,30}$/)
                    const rescpwd = regexcpwd.test(strcpwd);

                    if (rescpwd == false) {
                         ctrlcpwd.style.border = "1px solid red";
                         ctrlcpwd.style.outline = "1px solid red";
                         document.getElementById("cerrpwd").style.display = "block";

                         ok = false;

                    } else {
                         ctrlcpwd.style.border = "1px solid black";
                         ctrlcpwd.style.outline = "1px solid black";
                         document.getElementById("cerrpwd").style.display = "none";


                    }

                    //check password verif 

                    var pwd = document.getElementById("pwd").value;
                    var confpwd = document.getElementById("confpwd").value;

                    if (document.getElementById("pwd").value == document.getElementById("confpwd").value) {
                         document.getElementById("ccheckpwd").style.display = "none";

                    } else {
                         document.getElementById("ccheckpwd").style.display = "block";

                         ok = false;

                    }

                    return ok;
               }
          </script>


          <title>HOME</title>
          <link rel="stylesheet" type="text/css" href="../styles.css">
          <link rel="shortcut icon" type="image/png" href="../img/favicon.ico" />
     </head>

     <body id="home">

          <div class="header-takeplace"></div>
          <form class="changepwd-background" action="change.php" method="POST" onsubmit="return verifier()">
               <h3 id="hello">Changer le mot de passe de, <u><?php echo $_SESSION['Prenom']; ?></u></h3>
               <div class="home-options">
                    <input class="comForm" type="password" name="actpwd" placeholder="Mot de passe actuel" size="30" id="cpwd" />
                    <input class="comForm" type="password" name="pwd" placeholder="Mot de passe" size="30" id="pwd" />
                    <input class="comForm" type="password" name="confpwd" placeholder="Confirmer mot de passe" size="30" id="confpwd" />
               </div>
               <div class=showpass>
                    <input type="checkbox" name="showpass" onclick="showpassword()">
                    <a style="color: white;font-size: 15px;">Montrer le mot de passe</a>
               </div>
               <div><input class="regbutton" type="submit" id="send" value="Valider" /></div>
               <div class="errormessage">
                    <span class="erreur" id="cerrpwd">*Le mot de passe doit contenir au moins, 12 caractères, 1 majuscule et 1 minuscule, 1 caractère spécial</span>
                    <span class="erreur" id="ccheckpwd">*Les mots de passe ne sont pas identiques</span>
               </div>


          </form>

     </body>

     </html>

<?php
} else {
     header("Location: login.php");
     exit();
}


?>