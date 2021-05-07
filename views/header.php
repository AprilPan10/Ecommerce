<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Just Print</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/carousel/">
    <script data-search-pseudo-elements defer src="https://kit.fontawesome.com/52eb7513f8.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="wrapper">
    <header id="header">
        <div class="page-wrapper">
            <div class="header-wrapper">
                <div id="logo">
                    <h2 id="site-name">

                        <a href="../justprint/index.php">
                            <img src="images/justPrint_logo%20copy.png" alt="a logo of just print" width="250"/>

                        </a>
                    </h2>
                </div>
                <nav id="main-navigation">
                    <h3 class="hidden">Main navigation</h3>

                    <button class="menu-toggle" onclick="toggleMenu()"><img src="images/icons8-menu.png" width="50"/></button>
                    <ul class="menu">
                        <li><a href="../justprint/index.php">Home</a></li>
                        <li><a href="list-users.php">My Account</a></li><!-- log in as user-->
                        <li><a href="login.php" class="button-link">Log in</a></li>
                        <li><a href="logout.php">Log out</a></li>
                        <li><a href="list-orders.php"><img src="images/shopping-cart.svg" width="50" class="shopping-cart"/></a></li>
                        <li><?php
                            if(isset($_SESSION["orders"])){
                                echo $_SESSION["orders"];
                            } else {
                                echo 0;
                            }
                            ?></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
</div>
<body>
