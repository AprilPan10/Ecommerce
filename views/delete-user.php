<?php
//admin and users can both do
use justprint\model\{Database, User};
require_once 'vendor/autoload.php';
session_start();
if(!isset($_SESSION['username'])){
    header('Location:login.php');
}
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $dbcon =Database::getDb();
    $u = new User();
    $count = $u->deleteUser($id,$dbcon);
    if($count){
        header("Location: logout.php");
    }else {
        echo "problem";
    }
}
