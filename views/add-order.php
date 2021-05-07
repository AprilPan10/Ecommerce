<?php
//add an order
use justprint\model\{Database, Cart};
require_once 'vendor/autoload.php';
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
if(isset($_POST['submit'])) {
    $product_id = $_SESSION['productid'];
    $price = $_SESSION['price'];
    $name = $_SESSION['name'];
    $user_id = $_SESSION['id'];
    $dbcon = Database::getDb();
    $u = new Cart();
    $s = $u->addOrder($product_id,$user_id, $name,$price,$dbcon);
    if ($s) {
        header("Location:list-orders.php");
    } else {
        echo "Problem";

    }
}