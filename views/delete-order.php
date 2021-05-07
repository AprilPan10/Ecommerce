<?php
use justprint\model\{Database, Cart};
require_once '../vendor/autoload.php';
session_start();
if(!isset($_SESSION['username'])){
    header('Location:../login.php');
}
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $dbcon =Database::getDb();
    $r = new Cart();
    $count = $r->deleteOrder($id,$dbcon);
    if($count){
        header("Location: ../index.php");
    }else {
        echo "problem";
    }
}
