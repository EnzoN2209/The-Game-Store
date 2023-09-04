<?php
session_start();
include "../db.php";


$dbh = new PDO('mysql:host=localhost;dbname=ppe;port=3308', 'root', ''); //Connexion à la base en PDO (nécessaire pour éviter injections sql)

$username = $_POST['username'];
$password = $_POST['password'];

if ($username != "" && $password != "") {
	$query = ('SELECT * FROM accounts WHERE User =:User'); //Le :User permet de faire référence à la valeur User
	$data = ['User' => $username];
	$prep = $dbh->prepare($query);	//Vérifie la commande sql
	$resultat = $prep->execute($data); //Execute la commande
	$row1 = $prep->rowCount();
	if ($row1 == 1) {

		$row = $prep->fetchAll(); //Répertorie toutes les lignes correspondantes à la requête dans la base et les mets dans un tableau $row

		foreach ($row as $rows) { //Foreach va executer du code pour chaque ligne du tableau $row, et mettre la valeur actuel de la boucle dans $rows
			if ($rows['User'] == $username) {
				$hash = $rows['Password'];

				if (password_verify($password, $hash)) {
					$_SESSION['User'] = $rows['User']; //Affectation des valeurs User, Prenom et ID à la session
					$_SESSION['Prenom'] = $rows['Prenom']; //Affectation des valeurs User, Prenom et ID à la session
					$_SESSION['ID'] = $rows['ID']; //Affectation des valeurs User, Prenom et ID à la session
					header("Location: ../index.php");
					exit();
				} else {
					header("Location: login.php?error=error");
					exit();
				}
			} else {
				header("Location: login.php?error=error");
				exit();
			}
		}
		exit();
	} else {
		header("Location: login.php?error=error");
		exit();
	}
} else {
	header("Location: login.php?error=error");
	exit();
}




?>