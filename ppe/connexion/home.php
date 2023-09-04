<?php 
require_once("../db.php");
session_start();

if (isset($_SESSION['ID']) && isset($_SESSION['User'])){
     require_once("header.php")
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link rel="stylesheet" type="text/css" href="../styles.css">
     <link rel="shortcut icon" type="image/png" href="../img/favicon.ico"/>
</head>
<body id="home">

     <div class="header-takeplace"></div>
     <div class="home-background">
          <h1 id="hello">Hello, <?php echo $_SESSION['Prenom']; ?></h1>
          <div class="home-options">
               <a href="logout.php">Déconnexion</a>
               <a href="changepassword.php">Changer de mot de passe</a>
          </div>

     </div>

</body>
</html>

<?php 
     } else{
          header("Location: login.php");
          exit();
     }


?>

