<?php
//admin users only
use justprint\model\{Database, Review};
require_once 'vendor/autoload.php';
require_once 'Library/form-functions.php';
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
if($_SESSION['role']=="user"){
    header('Location: ../login/show-user.php');
}
//grab review information
$rate = $nickname = $title = $review = $name="";
$s2 = new Review();
$products = $s2->getProducts(Database::getDb());
if(isset($_POST['updateReview'])){
    $id = $_POST['id'];
    $dbcon =Database::getDb();
    $s =new Review();
    $review = $s->getReviewByID($id,$dbcon);
    $name = $review->name;
    $rate= $review->rate;
    $nickname= $review->nickname;
    $title= $review->title;
    $review= $review->review;
}
//update review
if(isset($_POST['updReview'])){
    $id = $_POST['sid'];
    $name = $_SESSION['productid'];
    $rate = $_POST['rate'];
    $nickname = $_POST['nickname'];
    $title = $_POST['title'];
    $review = $_POST['review'];
    if ($rate == "" || $nickname == "" || $title == "" || $review =="" || $name=="") {
        $makeError = "please enter a valid feedback";
    } else {
        $dbcon = Database::getDb();
        $s = new Review();
        $count = $s->updateReview($id, $name,$rate, $nickname, $title, $review, $dbcon);
        if ($count) {
            header("Location: index.php");
        } else {
            echo "Problem updating";


        }
    }


}
?>
<div class="container">
    <form class="needs-validation" name="profile" id="profile" method="post" novalidate>
        <input type="hidden" name="sid" value="<?= $id; ?>" />
        <div>
        </div>
        <div class="center">
            <!--            update review star-->
            <div class="stars">
                <input type="radio" id="five" name="rate" value="5" <?= ($rate == '5') ? 'checked' : ''; ?> required />
                <label for="five"></label>
                <input type="radio" id="four" name="rate" value="4" <?= ($rate == '4') ? 'checked' : ''; ?> required />
                <label for="four"></label>
                <input type="radio" id="three" name="rate" value="3" <?= ($rate == '3') ? 'checked' : ''; ?> required />
                <label for="three"></label>
                <input type="radio" id="two" name="rate" value="2" <?= ($rate == '2') ? 'checked' : ''; ?> required />
                <label for="two"></label>
                <input type="radio" id="one" name="rate" value="1" <?= ($rate == '1') ? 'checked' : ''; ?> required />
                <label for="one"></label>
                <span style=""><?= isset($makeError)? htmlspecialchars($makeError): '' ?></span>
                <div class="invalid-feedback">
                    Please enter a review rate.
                </div>
            </div>
        </div>
        <div class="row g-3 form">
            <div class="col-12">
                <label for="nickName" class="form-label">Nickname:</label>
                <input type="text" class="form-control" id="nickName" name="nickname" value="<?=$nickname; ?>" required>
                <span style=""><?= isset($makeError)? htmlspecialchars($makeError): '' ?></span>
                <div class="invalid-feedback">
                    Please enter a nickname.
                </div>
            </div>
            <div class="col-12">
                <label for="subject" class="form-label">Review Title:</label>
                <input type="text" class="form-control" id="subject" name="title" value="<?=$title; ?>" required>
                <span style=""><?= isset($makeError)? htmlspecialchars($makeError): '' ?></span>
                <div class="invalid-feedback">
                    Please enter a review title.
                </div>
            </div>
            <div class="col-12">
                <label for="review" class="form-label">Review:</label>
                <textarea class="form-control" name="review" required><?=$review; ?></textarea>
                <span style=""><?= isset($makeError)? htmlspecialchars($makeError): '' ?></span>
                <div class="invalid-feedback">
                    Please enter your feedback.
                </div>
            </div>
            <div class="col-12">
                <button class="button" type="submit" name="updReview">Submit</button>
                <a href="./index.php" class="button-color links">Back to list</a>
            </div>
        </div>
    </form>
</div>

