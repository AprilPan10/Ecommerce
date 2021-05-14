<?php
//users and and admin both can use it
use justprint\model\{Database, Review};
require_once 'vendor/autoload.php';
require_once "Library/form-functions.php";
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
if($_SESSION['role']=="admin"){
    header('Location: ../login/show-user.php');
}
$rate="";
$c = new Review();
$products = $c->getProducts(Database::getDb());
if(isset($_POST['submit'])) {
    $name = $_SESSION['productid'];
    $user = $_SESSION['id'];
    $rate = $_POST['rate'];
    $nickname = $_POST['nickname'];
    $title = $_POST['title'];
    $review = $_POST['review'];
    $status = "false";
    if ($rate == "" || $nickname == "" || $title == "" || $review ==""||$name==""||$user=="") {
        $makeError = "please enter a valid feedback";
    } else {
        $makeError = "Thanks for your feedback";
        $dbcon = Database::getDb();
        $r = new Review();
        $s = $r->addReview($name,$user,$rate, $nickname, $title, $review, $status,$dbcon);
        if ($s) {
            header("Location: index.php");
        } else {
            echo "Problem";

        }
    }
}
?>
<div class="container">
    <form class="needs-validation" name="profile" id="profile" method="post" novalidate>
        <div class="center">
            <!--            review star-->
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
                <div class="invalid-feedback">
                    Please enter a review rate.
                </div>
            </div>
        </div>
        <div class="row g-3 form">
            <div class="col-12">
                <label for="nickName" class="form-label">Nickname:</label>
                <input type="text" class="form-control" id="nickName" name="nickname" value="<?=isset($nickname) ? $nickname : '';?>" required>
                <div class="invalid-feedback">
                    Please enter a nickname.
                </div>
            </div>
            <div class="col-12">
                <label for="subject" class="form-label">Review Title:</label>
                <input type="text" class="form-control" id="subject" name="title" value="<?=isset($title) ? $title : '';?>" required>
                <div class="invalid-feedback">
                    Please enter a review title.
                </div>
            </div>
            <div class="col-12">
                <label for="review" class="form-label">Review:</label>
                <textarea class="form-control" name="review" value="<?=isset($review) ? $review : '';?>" required></textarea>
                <div class="invalid-feedback">
                    Please enter your feedback.
                </div>
            </div>
            <div class="pre">
                <button class="button" type="submit" name="submit">Submit</button>
                <a href="index.php" class="button-color links">Back to list</a>
            </div>
        </div>
    </form>

</div>


