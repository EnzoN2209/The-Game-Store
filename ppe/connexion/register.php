<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" type="image/png" href="../img/favicon.ico"/>
</head>
<script>
    function showpassword() {
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
    }

    function verifier() {
        var ok = true;
        // check prenom
        var ctrlpren = document.getElementsByName("prenom")[0];

        const strpren = ctrlpren.value;
        const regexpren = new RegExp("^[a-zéèëï ]+$", 'i');
        const respren = regexpren.test(strpren);

        if (strpren == "") {
            ctrlpren.style.border = "1px solid red";
            ctrlpren.style.outline = "1px solid red";
            document.getElementById("emptypren").style.display = "block";

            ok = false;
        } else {
            ctrlpren.style.border = "1px solid black";
            ctrlpren.style.outline = "1px solid black";
            document.getElementById("emptypren").style.display = "none";

            if (respren == false) {
                ctrlpren.style.border = "1px solid red";
                ctrlpren.style.outline = "1px solid red";
                document.getElementById("errpren").style.display = "block";

                ok = false;
            } else {
                ctrlpren.style.border = "1px solid black";
                ctrlpren.style.outline = "1px solid black";
                document.getElementById("errpren").style.display = "none";



            }
        }






        // check login

        var ctrllog = document.getElementsByName("user")[0];

        const strlog = ctrllog.value;
        const regexlog = new RegExp("^[a-zéèëï ]+$", 'i');
        const reslog = regexlog.test(strlog);

        if (strlog == "") {
            ctrllog.style.border = "1px solid red";
            ctrllog.style.outline = "1px solid red";
            document.getElementById("emptylog").style.display = "block";

            ok = false;
        } else {
            ctrllog.style.border = "1px solid black";
            ctrllog.style.outline = "1px solid black";
            document.getElementById("emptylog").style.display = "none";

            if (reslog == false) {
                ctrllog.style.border = "1px solid red";
                ctrllog.style.outline = "1px solid red";
                document.getElementById("errlog").style.display = "block";

                ok = false;

            } else {
                ctrllog.style.border = "1px solid black";
                ctrllog.style.outline = "1px solid black";
                document.getElementById("errlog").style.display = "none";


            }
        }



        // check nom

        var ctrlnom = document.getElementsByName("nom")[0];

        const strnom = ctrlnom.value;
        const regexnom = new RegExp("^[a-zéèëï ]+$", 'i');
        const resnom = regexnom.test(strnom);

        // Verifie si le champ est vide
        if (strnom == "") {
            ctrlnom.style.border = "1px solid red";
            ctrlnom.style.outline = "1px solid red";
            document.getElementById("emptynom").style.display = "block";

            ok = false;
        } else {
            ctrlnom.style.border = "1px solid black";
            ctrlnom.style.outline = "1px solid black";
            document.getElementById("emptynom").style.display = "none";

            if (resnom == false) {
                ctrlnom.style.border = "1px solid red";
                ctrlnom.style.outline = "1px solid red";
                document.getElementById("errnom").style.display = "block";

                ok = false;

            } else {
                ctrlnom.style.border = "1px solid black";
                ctrlnom.style.outline = "1px solid black";
                document.getElementById("errnom").style.display = "none";


            }
        }


        //check password requirment 

        var ctrlpwd = document.getElementsByName("pwd")[0]

        const strpwd = ctrlpwd.value;
        const regexpwd = new RegExp(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,30}$/)
        const respwd = regexpwd.test(strpwd);

        // Verifie si le champ est vide
        if (strpwd == "") {
            ctrlpwd.style.border = "1px solid red";
            ctrlpwd.style.outline = "1px solid red";
            document.getElementById("emptypassword").style.display = "block";

            ok = false;
        } else {
            ctrlpwd.style.border = "1px solid black";
            ctrlpwd.style.outline = "1px solid black";
            document.getElementById("emptypassword").style.display = "none";

            if (respwd == false) {
                ctrlpwd.style.border = "1px solid red";
                ctrlpwd.style.outline = "1px solid red";
                document.getElementById("errpwd").style.display = "block";

                ok = false;

            } else {
                ctrlpwd.style.border = "1px solid black";
                ctrlpwd.style.outline = "1px solid black";
                document.getElementById("errpwd").style.display = "none";


            }
        }



        //check mail requirment

        var ctrlmail = document.getElementsByName("mail")[0]

        const strmail = ctrlmail.value;
        const regexmail = new RegExp(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/)
        const resmail = regexmail.test(strmail);

        // Verifie si le champ est vide
        if (strmail == "") {
            ctrlmail.style.border = "1px solid red";
            ctrlmail.style.outline = "1px solid red";
            document.getElementById("emptymail").style.display = "block";

            ok = false;
        } else {
            ctrlmail.style.border = "1px solid black";
            ctrlmail.style.outline = "1px solid black";
            document.getElementById("emptymail").style.display = "none";

            if (resmail == false) {
                ctrlmail.style.border = "1px solid red";
                ctrlmail.style.outline = "1px solid red";
                document.getElementById("errmail").style.display = "block";

                ok = false;

            } else {
                ctrlmail.style.border = "1px solid black";
                ctrlmail.style.outline = "1px solid black";
                document.getElementById("errmail").style.display = "none";


            }
        }



        //check password verif 


        var pwd = document.getElementById("pwd").value;
        var confpwd = document.getElementById("confpwd").value;

        if (pwd == confpwd) {


            document.getElementById("checkpwd").style.display = "none";

        } else {

            document.getElementById("checkpwd").style.color = "red";
            document.getElementById("checkpwd").style.display = "block";

            ok = false;

        }

        return ok;
    }
</script>

<body>
    <div class="grid">
        <div class="background">
            <div class="logo"><a href="../index.php"><img class="logo" src="img/logo.png"></a></div>
            <div class="register">
                <form action="inscription.php" method="POST" onsubmit="return verifier()">
                    <div class="spacer"></div>
                    <div style="color: white; font-size: 22px; margin-left:10px" class="connexion">
                        <h3>S'inscrire</h3>
                    </div>
                    <div class="spacer"></div>
                    <div class="gridrow">
                        <div class="gridcolumn">
                            <div class="prenom">
                                <input class="comForm" type="text" name="prenom" placeholder="Prenom" size="30" id="prenom" />
                            </div>

                            <div class="nom">
                                <input class="comForm" type="text" name="nom" placeholder="Nom" size="30" id="nom" />
                            </div>

                        </div>
                        <div class="gridcolumn">
                            <div class="user">
                                <input class="comForm" type="text" name="user" placeholder="Nom d'utilisateur" size="30" id="user" />
                            </div>
                            <div class="mdp">
                                <input class="comForm" type="password" name="pwd" placeholder="Mot de passe" size="30" id="pwd" />
                            </div>

                        </div>
                        <div class="gridcolumn">
                            <div class="prenom">
                                <input class="comForm" type="text" name="mail" placeholder="Email" size="30" id="mail" />
                            </div>
                            <div class="nom">
                                <input class="comForm" type="password" name="confpwd" placeholder="Confirmer mot de passe" size="30" id="confpwd" />
                            </div>

                        </div>
                    </div>
                    <div class=showpass>
                        <input type="checkbox" name="showpass" onclick="showpassword()">
                        <a style="color: white;font-size: 15px;">Montrer le mot de passe</a>
                    </div>
                    <div class="button"><input class="regbutton" type="submit" id="reg" value="Inscription" /></div>
                    <div>

                        <a href="login.php" class="already">Déja un compte ?</a>

                    </div>
                    <div class="spacer"></div>
                    </br>
                    <div class="errormessage">
                        <!-- Champs invalide (Regex) -->
                        <span class="erreur" id="errpren">*Prénom invalide</span>
                        <span class="erreur" id="errnom">*Nom invalide</span>
                        <span class="erreur" id="errlog">*Nom d'utilisateur invalide</span>
                        <span class="erreur" id="errmail">*Email invalide</span>
                        <span class="erreur" id="errpwd">*Le mot de passe ne répond pas aux critères (doit contenir au moins, 12 caractères, 1 majuscule et 1 minuscule, 1 caractère spécial) </span>
                        <span class="erreur" id="checkpwd">*Les mots de passe ne sont pas identiques </span>
                        <!-- Champs vides -->
                        <span class="erreur" id="emptypren">*Veuillez rentrer un prénom</span>
                        <span class="erreur" id="emptynom">*Veuillez rentrer un nom</span>
                        <span class="erreur" id="emptylog">*Veuillez rentrer un nom d'utilisateur</span>
                        <span class="erreur" id="emptymail">*Veuillez rentrer un email</span>
                        <span class="erreur" id="emptypassword">*Veuillez rentrer un mot de passe</span>
                        <?php
                            if (isset($_GET["error"])) {
                                echo "<span id='errormsg'>*Identifiants déjà existants</span>";
                            }
                        ?>
                    </div>

                </form>




            </div>
        </div>
        <div class="background2">

            <img style="width: 100%; height: 100%" src="img/img_grid.jpg">
        </div>
    </div>
</body>

</html>