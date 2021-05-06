<?php
use justprint\model\{Database, Product};
require_once 'vendor/autoload.php';
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
$name = $type = $description = $price =$url= "";

if(isset($_POST['updateProduct'])){
    $id= $_POST['id'];
    $db = Database::getDb();

    $s = new Product();
    $product = $s->getProductById($id, $db);

    $name =  $product->name;
    $type = $product->type;
    $description = $product->description;
    $price = $product->price;
    $url = $product->url;

}
if(isset($_POST['updProduct'])){
    $id= $_POST['sid'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $url=$_FILES['image']['name'];
    $target_path = "images/";
    $target_path = $target_path .  $_FILES['image']['name'];
    if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
        echo "The file ".  $_FILES['image']['name'] . " has been uploaded ";
    } else{
        echo "Please upload your profile photo";
    }
    if ($name==""||$type==""||$description==""|| $price==""||$url=="") {
        $makeError = "please enter a valid info";
    }else{
        $db = Database::getDb();
        $s = new Product();
        $count = $s->updateProduct($id, $name, $type, $description, $price, $url,$db);

        if($count){
            header('Location: index.php');
        } else {
            echo "problem";
        }
    }

}


?>
<div class="container">
    <!--    Form to Update  Car -->
    <form action="" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
        <input type="hidden" name="sid" value="<?= $id; ?>" />
        <div>
            <!--                    update user photo-->
            <img class="d-block mx-auto mb-4" src="images/<?=$url;?>" alt="user photo" width="200">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
            <input type="file" name="image" id="upfile" value="images/<?= $url;?>" required />
            <div class="invalid-feedback">
                Please upload a image.
            </div>
        </div>
        <div class="form-group">
            <label for="name">Name :</label>
            <input type="text" class="form-control" name="name" id="name" value="<?= $name; ?>" placeholder="Enter name" required>
            <span style=""><?= isset($makeError)? htmlspecialchars($makeError): '' ?></span>
            <div class="invalid-feedback">
                Please enter product name.
            </div>
        </div>
        <div class="form-group">
            <label for="type">Type :</label>
            <input type="text" class="form-control" id="type" name="type" value="<?= $type; ?>" placeholder="Enter type" required>
            <span style=""><?= isset($makeError)? htmlspecialchars($makeError): '' ?></span>
            <div class="invalid-feedback">
                Please enter product type.
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <input type="text" name="description" value="<?= $description; ?>" class="form-control" id="description" placeholder="Enter description" required>
            <span style=""><?= isset($makeError)? htmlspecialchars($makeError): '' ?></span>
            <div class="invalid-feedback">
                Please write a description.
            </div>
        </div>

        <div class="form-group">
            <label for="price">Price :</label>
            <input type="text" name="price" value="<?= $price; ?>" class="form-control" id="price" placeholder="Enter price" required>
            <span style=""><?= isset($makeError)? htmlspecialchars($makeError): '' ?></span>
            <div class="invalid-feedback">
                Please enter a price.
            </div>
        </div>
        <div class="space">
            <a href="../justprint/index.php" id="btn_back" class="button-color links">Back</a>
            <button type="submit" name="updProduct" class="button" id="btn-submit">Update Product</button>
        </div>
    </form>
</div>

