<?php
use justprint\model\{Database, Image};
require_once 'vendor/autoload.php';
require_once "Library/form-functions.php";
session_start();
if(!isset($_SESSION['username'])){
    header('Location:login.php');
}
if($_SESSION['role']=="user"){
    header('Location: ../login/show-user.php');
}
$filename="";
$c = new Image();
$products = $c->getProducts(Database::getDb());
if(isset($_POST['submit'])) {
    //add image
    $filename=$_FILES['filename']['name'];
    $name = $_POST['name'];
    $target_path = "./images/";
    $target_path = $target_path .  $_FILES['filename']['name'];
    if(move_uploaded_file($_FILES['filename']['tmp_name'], $target_path)) {
        echo "The file ".  $_FILES['filename']['name'] . " has been uploaded ";
    } else{
        echo "Please upload your profile photo";
    }

    if ($filename==""||$name=="") {
        $makeError = "please enter a valid info";
    } else {
        $makeError = "success";
        $dbcon = Database::getDb();
        $p = new Image();
        $s = $p->addImage($filename,$name,$dbcon);
        if ($s) {
            header("Location: index.php");
        } else {
            echo "Problem";

        }
    }
}
?>
<div class="wrapper-update">
    <h3>Upload Image</h3>
    <form class="needs-validation" action= "" name="image" id="image" method="post" enctype="multipart/form-data" novalidate>
        <div>
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
            <input type="file" name="filename" id="upfile" value="<?=isset($$filename) ? $$filename : '';?>"/>
        </div>
        <div>
            <label for="product_id">Product Name:</label>
            <select id="product" name="name" value="<?=isset($product) ? $product : '';?>">
                    <?php echo  populateDropdown($products) ?>
            </select>
        </div>
        <div class="pre">
            <button class="button" type="submit" name="submit">Save</button>
            <a href="index.php" class="button-color links">Back to list</a>
        </div>
    </form>
</div>


