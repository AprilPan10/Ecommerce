<?php
use justprint\model\{Database, Product};
require_once '../vendor/autoload.php';
session_start();
if(!isset($_SESSION['username'])){
    header('Location:../login.php');
}

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $db = Database::getDb();

    $s = new Product();
    $count = $s->deleteProduct($id, $db);
    if($count){
        header("Location: ../index.php");
    }
    else {
        echo " problem deleting";
    }


}
