<?php
//for admin users only
use justprint\model\{Database, Image};
require_once 'vendor/autoload.php';
require_once 'Library/form-functions.php';
session_start();
if(!isset($_SESSION['username'])){
    header('Location:login.php');
}
if($_SESSION['role']=="user"){
    header('Location: index.php');
}
//get image
$filename=$name="";
$p2 = new Image();
$products = $p2->getProducts(Database::getDb());
if(isset($_POST['updateImage'])){
    $id = $_POST['id'];
    $dbcon =Database::getDb();
    $p =new Image();
    $image = $p->getImageByID($id,$dbcon);
    $filename=$image->filename;
    $name = $image->name;
}
//update images
if(isset($_POST['updImage'])){
    $id = $_POST['sid'];
    $name = $_POST['name'];
    $filename=$_FILES['filename']['name'];
    $target_path = "./images/";
    $target_path = $target_path .  $_FILES['filename']['name'];
    if(move_uploaded_file($_FILES['filename']['tmp_name'], $target_path)) {
        echo "The file ".  $_FILES['filename']['name'] . " has been uploaded ";
    } else{
        echo "Please upload your profile photo";
    }
    if ($filename=="") {
        $makeError = "please enter a photo";
    } else {
        $dbcon = Database::getDb();
        $u = new Image();
        $count = $u->updateImage($id,$name,$filename,$dbcon);
        if ($count) {
            header("Location: index.php");
        } else {
            echo "Problem updating";


        }
    }
}
?>
    <div class="wrapper-update">
        <h1>Upload Image</h1>
        <form class="needs-validation" action= "" name="image" id="image" method="post" enctype="multipart/form-data" novalidate>
            <div>
                <!--                update individual image-->
                <input type="hidden" name="sid" value="<?= $id; ?>" />
                <img class="d-block mx-auto mb-4" src="./images/<?=$filename;?>" alt="user photo" width="200">
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                <input type="file" name="filename" id="upfile" value="./images/<?= $filename;?>"/>
            </div>
            <div>
                <label for="product_id">Product Name:</label>
                <select id="product" name="name">
                    <?php echo  populateDropdown($products) ?>
                </select>
            </div>
            <div class="pre">
                <button class="button" type="submit" name="updImage">Save</button>
                <a href="index.php" class="button-color links">Back to list</a>
            </div>
        </form>
    </div>
