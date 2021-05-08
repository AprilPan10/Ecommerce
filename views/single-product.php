<?php
use justprint\model\{Database, Product, Review, Image};
require_once 'vendor/autoload.php';
session_start();
$user_id = isset($_SESSION['id'] ) ? $_SESSION['id'] : '';
$name = $type = $description = $price = "";
if(isset($_GET['id'])){
    $id= $_GET['id'];
    $db = Database::getDb();
    $_SESSION['productid'] = $_GET['id'];
    $s = new Product();
    $product = $s->getProductById($id, $db);
    $name =  $product->name;
    $_SESSION['name']=$name;
    $type = $product->type;
    $description = $product->description;
    $price = $product->price;
    $_SESSION['price']=$price;
}
?>
<?php
$product_id = isset($_GET['id'] ) ? $_GET['id'] : '';
$r = new Review();
$reviews= $r->getAllReviews(Database::getDb());
$p = new Image();
$filename="";
$images= $p->getAllImages(Database::getDb());
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
?>
<div class="space">
    <?php if($role=="admin") { ?>
        <a href="add-images.php" class="button links">Upload a image</a>
    <?php }?>
</div>
<div class="row">
    <div class="column">
        <div class="card-image">
            <div id="container" >
                <!--    slider show-->
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./images/<?= $product->url; ?>" alt="Product" class="d-block" height="500" width="500">
                        </div>
                        <?php foreach($images as $image) { if( $image->product_id == $product_id ){ ?>
                            <div class="carousel-item" active>
                                <img src='./images/<?= $image->filename; ?>' class="d-block" height="500" width="500">
                            </div>
                        <?php } } ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"><img src="./images/previous-svgrepo-com.svg"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"><img src="./images/next-svgrepo-com%20(1).svg"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <!--    single image display-->
                <div id="gallery">
                    <?php foreach($images as $image) { if( $image->product_id == $product_id ){ ?>
                        <img src='./images/<?= $image->filename; ?>' width="100" class="img-fluid" height="100">
                        <?php if($role=="admin") {?>
                            <div class="buttons">
                                <form action="update-image.php" method="post">
                                    <input type="hidden" name="id" value="<?= $image->id; ?>"/>
                                    <input type="submit"  name="updateImage" value="Update" class="button sml"/>
                                </form>
                                <form action="../justprint/views/delete-image.php" method="post">
                                    <input type="hidden" name="id"  value="<?= $image->id; ?>"/>
                                    <input type="submit"  name="deleteImage" value="Delete" class="button-color links sml"/>
                                </form>
                            </div>
                        <?php } }?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="card">
            <h1><?= $name; ?></h1>
            <h4>Details</h4>
            <p>Type: <?= $type; ?></p>
            <p><?= $description; ?></p>
            <?php if($role=="user" ||$role == "admin") {?>
            <form action="add-order.php" method="post">
                <input type="hidden" name="id" value="<?= $id; ?>"/>
                <input type="submit"  name="submit" value="$<?= $price; ?> - Purchase" class="button centers"/>
            </form>
            <?php } else {   ?>
            <form action="login.php" method="post">
                <input type="hidden" name="id" value="<?= $id; ?>"/>
                <input type="submit"  name="submit" value="$<?= $price; ?> - Purchase" class="button centers"/>
            </form>
            <?php } ?>
        </div>
    </div>
</div>
<h3 class="title">Review List</h3>
<?php if($role=="user") {?>
    <a href="add-review.php" class="button links">Add a review</a>
<?php } ?>
<div>
    <!--    how to display review-->
    <?php foreach($reviews as $review) { if($review->status == "true"  && $review->product_id == $product_id && $role !="admin"){ ?>
    <div class="review">
        <?php
        $star1 = "<img src='./images/star1.png' class='stars-images' width='150'>";
        $star2 = "<img src='./images/star2.png' class='stars-images' width='150'>";
        $star3 = "<img src='./images/star3.png' class='stars-images' width='150'>";
        $star4 = "<img src='./images/star4.png' class='stars-images' width='150'>";
        $star5 = "<img src='./images/star5.png' class='stars-images' width='150'>";
        if($review->rate == 1){
            echo $star1;
        }
        if($review->rate == 2){
            echo $star2;
        }
        if($review->rate == 3){
            echo $star3;
        }
        if($review->rate == 4){
            echo $star4;
        }
        if($review->rate == 5){
            echo $star5;
        }
        ?>
        <p>Nickname:</p>
        <p class="reviewtext"><?= $review->nickname; ?></p>
        <p>Review Title:</p>
        <p class="reviewtext"><?= $review->title; ?></p>
        <p>Review:</p>
        <p class="reviewtext"><?= $review->review; ?></p>
        <?php if($user_id==$review->user_id && $role=="user" ) { ?>
            <form action="../justprint/views/delete-review.php" method="post">
                <input type="hidden" name="id" value="<?= $review->id; ?>"/>
                <input type="submit"  name="deleteReview" value="Delete" class="button button-color btn-center"/>
            </form>
        <?php } } }?>
        <?php if($role=="admin") {
        foreach($reviews as $review) { if($review->product_id == $product_id){ ?>
        <div class="review">
            <?php
            $star1 = "<img src='./images/star1.png' class='stars-images' width='150'>";
            $star2 = "<img src='./images/star2.png' class='stars-images' width='150'>";
            $star3 = "<img src='./images/star3.png' class='stars-images' width='150'>";
            $star4 = "<img src='./images/star4.png' class='stars-images' width='150'>";
            $star5 = "<img src='./images/star5.png' class='stars-images' width='150'>";
            if($review->rate == 1){
                echo $star1;
            }
            if($review->rate == 2){
                echo $star2;
            }
            if($review->rate == 3){
                echo $star3;
            }
            if($review->rate == 4){
                echo $star4;
            }
            if($review->rate == 5){
                echo $star5;
            }
            ?>
            <p>Nickname:</p>
            <p class="reviewtext"><?= $review->nickname; ?></p>
            <p>Review Title:</p>
            <p class="reviewtext"><?= $review->title; ?></p>
            <p>Review:</p>
            <p class="reviewtext"><?= $review->review; ?></p>
            <p>Comments Status:</p>
            <p class="reviewtext"><?php if($review->status == "false"){echo "This is comment is not approve yet!" ;} else{echo "This comments have been approved, Everyone will see!"; } ?></p>
            <div id="buttons" class="mobile">
                <form action="update-review.php" method="post">
                    <input type="hidden" name="id" value="<?= $review->id; ?>"/>
                    <input type="submit"  name="updateReview" value="Update" class="button"/>
                </form>
                <form action="../justprint/views/delete-review.php" method="post">
                    <input type="hidden" name="id" value="<?= $review->id; ?>"/>
                    <input type="submit"  name="deleteReview" value="Delete" class="button button-color"/>
                </form>
                <form action="../justprint/views/approve-review.php" method="post">
                    <input type="hidden" name="id" value="<?= $review->id; ?>"/>
                    <input type="submit"  name="approveReview" value="Approve" class="button button-color"/>
                </form>
            </div>
            <?php } } }?>

        </div>
