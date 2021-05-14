<?php
use justprint\model\{Database, Cart};
require_once '../vendor/autoload.php';
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
if(!isset($_SESSION['username'])){
    header('Location:../login.php');
}
if(isset($_POST['id'])){
    $id = $_POST['id'];
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($id == $_POST['id']) {
            unset($_SESSION['cart'][$key]);
        }
    }
    $dbcon =Database::getDb();
    $r = new Cart();
    $count = $r->deleteOrder($id,$dbcon);
    if($count){
        if($role == "user"){
            header("Location: ../list-orders.php");
        }else{
            header("Location: ../list-users.php");
        }

    }else {
        echo "problem";
    }
}
