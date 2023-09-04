<?php
require_once("../db.php");
session_start();
$dbh = new PDO('mysql:host=localhost;dbname=ppe;port=3308', 'root', '');


$username = $_SESSION['User']; // recupere le Nom d'utilisateur par la session 
$password = $_POST["pwd"]; // recupere le mor de passe 
$actualpassword = $_POST["actpwd"]; // recupere le mot de passe actuel par la session 

$passwordhash = password_hash($password,  PASSWORD_BCRYPT);

if ($actualpassword != "") { 
    $query = ('SELECT * FROM accounts WHERE User =:User'); // :User pour le $data
    $data = ['User' => $username];
    $prep = $dbh->prepare($query); //Prepare le query pour eviter les injecion sql
    $resultat = $prep->execute($data); //execute le query preparé
    $row1 = $prep->rowCount();

    if ($row1 == 1) {
        $row = $prep->fetchAll();
        foreach ($row as $rows) {
            if ($rows['User'] == $username) {
                $hash = $rows['Password'];
                if (password_verify($actualpassword, $hash)) { // Verifie le mot de passe actuel via le hash
                    $query = 'UPDATE accounts SET Password = :Password WHERE User = :User'; // Met a jour la base avec le nouveau mot de passe 
                    $data = ['User' => $username, 'Password' => $passwordhash];
                    $prep = $dbh->prepare($query);
                    $resultat = $prep->execute($data);
                    header("Location: home.php");
                    exit();

                }else {
                    header("Location: changepassword.php?error=Mot de passe d'origine pas correct");
                    exit();
                }
            }else {
				header("Location: changepassword.php?error=Username incorrect");
				exit();
			}
        }
    } else{
        header("Location: changepassword.php?error=Nom d'utilisateur déjà pris");
        exit();  
    }
} else{
    header("Location: changepassword.php?error=Mot de passe actuel doit être indiqué");
    exit();
}