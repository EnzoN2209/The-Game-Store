<?php
require_once("../db.php");

if(isset($_GET["id"])){
	$idProduit = $_GET["id"];
	$result = $conn->query("SELECT * FROM articles WHERE ID_JEU = $idProduit");
	if($result && $result->num_rows > 0){
		$produit = $result->fetch_assoc();
		echo json_encode($produit);
	} else {
		echo "{}";
	}
} else {
	echo "{}";
}
?>
