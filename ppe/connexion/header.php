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
                <input id="searchBAR" name="search" type="text" value="<?php
                    // Va récupérer la recherche qui se trouve dans GET et la mettre dans la barre de recherche
                    if(isset($_GET['search'])){
                        echo "$_GET[search]";
                    }
                ?>" />
            </form>
        </div>
        <div class="menu">
            <a href="../panier/panier.php"><img id="cart-img" src="cart.png"></a>
            <a href="login.php"><img id="account-img" src="account.png"></a>
        </div>
    </div>
</body>
</html>