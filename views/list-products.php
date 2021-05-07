<?php
use justprint\model\{Database, Product};
require_once 'vendor/autoload.php';
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
$dbcon = Database::getDb();
$s = new Product();
$products =  $s->getAllProducts(Database::getDb());
if(isset($_POST['id'])){
    $id = $_POST['id'];
}

?>
<?php if($role=="admin") {?>
    <div class="space">
        <a href="add-product.php" id="btn_addProduct" class="button-link">Add Product</a><br/>
    </div>
<?php }?>
<div class="container">
        <div class="row">
            <?php foreach ($products as $product) { ?>
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img src='./images/<?= $product->url; ?>' alt="Product" class="Product" height="200" />
                        <div class="caption">
                            <a href="single-product.php?id=<?= $product->id; ?>"><?= $product->name; ?></a>
                             <h4>$<?= $product->price; ?></h4>
                        </div>
                        <?php if($role=="admin") {?>
                                <div id="buttons" class="mobile">
                                    <div>
                                        <form action="update-product.php" method="post">
                                            <input type="hidden" name="id" value="<?= $product->id; ?>"/>
                                            <input type="submit" class="button" name="updateProduct" value="Update"/>
                                        </form>
                                    </div>
                                    <div>
                                        <form action="../justprint/views/delete-product.php" method="post">
                                            <input type="hidden" name="id" value="<?=  $product->id; ?>"/>
                                            <input type="submit" class="button-color" name="deleteProduct" value="Delete"/>
                                        </form>
                                </div>
                        </div>
                        <?php }?>
                        <?php if($role!="admin") {?>
                            <?php if($role=="user") {?>
                                <form action="add-order.php" method="post">
                                    <input type="hidden" name="id" value="<?= $product->id; ?>"/>
                                    <input type="submit"  name="submit" value="Buy" class="button"/>
                                </form>
                            <?php } else {   ?>
                                <form action="login.php" method="post">
                                    <input type="hidden" name="id" value="<?= $product->id; ?>"/>
                                    <input type="submit"  name="submit" value="Buy" class="button"/>
                                </form>
                            <?php } ?>
                        <?php }?>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>
</div>

