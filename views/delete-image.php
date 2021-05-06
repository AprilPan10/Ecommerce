<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location:login.php');
}
if(!isset($_SESSION['username'])){
    header('Location:../login.php');
}
use justprint\model\{Database, Image};
require_once '../vendor/autoload.php';

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $dbcon =Database::getDb();
    $p = new Image();
    $count = $p->deleteImage($id,$dbcon);
    if($count){
        header("Location: ../index.php");
    }else {
        echo "problem";
    }
}
