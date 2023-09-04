<?php
require_once("../db.php");

//Connexion en PDO, requis pour empêcher Injections SQL
$dbh = new PDO('mysql:host=localhost;dbname=ppe;port=3308', 'root', '',);

$prenom = $_POST["prenom"];
$nom = $_POST["nom"];
$username = $_POST["user"];
$mail = $_POST["mail"];
$password = $_POST["pwd"];


$requete = "SELECT * FROM accounts WHERE User = '$username'";
$result = mysqli_query($conn, $requete);
//La condition va vérifier s'il existe déjà un compte pourtant le même nom, auquel cas l'utilisateur est redirigé sur register.php
if(mysqli_num_rows($result) != 0){
    header("Location: register.php?error=error");
    exit();
} else{
    //passsword_hash va hasher le mot de passe entré par l'utilisateur avec la solution de hashage Bcrypt 
    $passwordhash = password_hash($password,  PASSWORD_BCRYPT);
    $query = $dbh->prepare('INSERT INTO accounts(`Prenom`, `Nom`, `User`, `Mail`, `Password`)
    VALUES(:Prenom, :Nom, :User, :Mail, :Password)');
    //Les bindValue vont affecter les valeurs à la requête INSERT, tout en vérifiant qu'il n'y ai pas d'injections
    $query->bindValue(':Prenom', $prenom);
    $query->bindValue(':Nom', $nom);
    $query->bindValue(':User', $username);
    $query->bindValue(':Mail', $mail);
    $query->bindValue(':Password', $passwordhash);
    $query->execute();
}
header("Location: login.php");




?>
