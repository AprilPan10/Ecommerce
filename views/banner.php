<?php
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
?>
<div class="wrapper">
    <div id="banner" class="page-wrapper">
        <div id="banner-text">
            <h2>Download,<span class="special">just print it</span> at home</h2>
            <hr>
            <div class="space pre">
                <a href="" class="button-shop links">View shopping cart</a>
                <?php if($role!="user" && $role != "admin") {?>
                <a href="../justprint/signup.php" class="button button-color links">Create your account</a>
                <?php } else { ?><a href="list-users.php" class="button button-color links">Create your account</a> <?php }?>
            </div>
        </div>
        <div id="banner-img">
            <img src="images/Yuppies%20-%20Designing.svg" width="500" />
        </div>
    </div>
</div>
