<?php
use justprint\model\{Database, Product};
require_once 'vendor/autoload.php';
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
if(isset($_POST['addProduct'])){
    $name = $_POST['name'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $url=$_FILES['image']['name'];
    $target_path = "./images/";
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
        $c = $s->addProduct($name, $type, $description, $price, $url, $db);

        if($c){
            header("Location: index.php");
        } else {
            echo "problem adding a product";
        }
    }


}
?>
<div class="container">
    <!--    Form to Add Product -->
    <form action="" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
        <div>
            <img class="d-block mx-auto mb-4" src="images/smileface%20copy.png" alt="a logo for our Just print store" width="200">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
            <input type="file" name="image" id="upfile" value="<?=isset($url) ? $url : '';?>" required/>
            <div class="invalid-feedback">
                Please upload your images.
            </div>
            <!--                    <input type="submit" value="uplaod" >-->
        </div>
        <div class="form-group">
            <label for="name">Name :</label>
            <input type="text" class="form-control" name="name" id="name" value="" placeholder="Enter name" required>
            <span style=""><?= isset($makeError)? htmlspecialchars($makeError): '' ?></span>
            <div class="invalid-feedback">
                Please enter product name.
            </div>
        </div>
        <div class="form-group">
            <label for="type">Type :</label>
            <input type="text" class="form-control" id="type" name="type" value="" placeholder="Enter type" required>
            <span style=""><?= isset($makeError)? htmlspecialchars($makeError): '' ?></span>
            <div class="invalid-feedback">
                Please enter product type.
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <input type="text" name="description" value="" class="form-control" id="description" placeholder="Enter description" required>
            <span style=""><?= isset($makeError)? htmlspecialchars($makeError): '' ?></span>
            <div class="invalid-feedback">
                Please write a description.
            </div>
        </div>

        <div class="form-group">
            <label for="price">Price :</label>
            <input type="text" name="price" value="" class="form-control" id="price" placeholder="Enter price" required>
            <span style=""><?= isset($makeError)? htmlspecialchars($makeError): '' ?></span>
            <div class="invalid-feedback">
                Please enter a price.
            </div>
        </div>
        <div class="space">
            <a href="index.php" id="btn_back" class="button-color links">Back</a>
            <button type="submit" name="addProduct" class="button" id="btn-submit">Add Product</button>
        </div>
    </form>
</div>
