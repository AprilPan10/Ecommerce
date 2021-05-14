<?php
//admin and users can both add user
use justprint\model\{Database, User};
require_once 'vendor/autoload.php';
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
if($_SESSION['role']=="user"){
    header('Location: ../login/show-user.php');
}
$image="";
if(isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name= $_POST['last_name'];
    $role="user";
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password=$_POST['password'];
    $address =$_POST['address'];
    $bio=$_POST['bio'];
    //add user images
    $image=$_FILES['image']['name'];
    $target_path = "Uploads/";
    $target_path = $target_path .  $_FILES['image']['name'];
    if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
        echo "The file ".  $_FILES['image']['name'] . " has been uploaded ";
    } else{
        echo "Please upload your profile photo";
    }

    if ($first_name==""||$last_name==""||$email==""|| $username==""||$password==""||$address==""||$bio==""||$image=="") {
        $makeError = "please enter a valid info";
    }else if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
        $email_error = " please enter valid email";
        header("location");
    }else {
        $makeError = "success";
        $dbcon = Database::getDb();
        $u = new User();
        $s = $u->addUser($first_name,$last_name,$role,$email,$username,$password,$address,$bio,$image,$dbcon);
        if ($s) {
            header("Location: list-users.php");
        } else {
            echo "Problem";

        }
    }
}

?>
<div class="container">
    <main>
        <form class="needs-validation" action= "" name="profile" id="profile" method="post" enctype="multipart/form-data" novalidate>
            <div class="row g-3">
                <div class="col-md-5 col-lg-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="image-title">Your image</span>
                    </h4>
                    <div>
                        <img class="d-block mx-auto mb-4" src="images/smileface%20copy.png" alt="a logo for our Just print store" width="200">
                        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                        <input type="file" name="image" id="upfile" value="<?=isset($image) ? $image : '';?>" required/>
                        <div class="invalid-feedback">
                            Please upload your images.
                        </div>
                        <!--                    <input type="submit" value="uplaod" >-->
                    </div>
                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Your Profile</h4>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">First name</label>
                            <input type="text" class="form-control" id="firstName" name="first_name" value="<?=isset($first_name) ? $first_name : '';?>" required/>
                            <span style=""><?= isset($makeError)? htmlspecialchars($makeError): '' ?></span>
                            <div class="invalid-feedback">
                                Please enter a valid first name.
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="lastName" name="last_name" value="<?=isset($last_name) ? $last_name : '';?>" required/>
                            <span style=""><?= isset($makeError)? htmlspecialchars($makeError): '' ?></span>
                            <div class="invalid-feedback">
                                Please enter a valid last name.
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Email <span class="text-muted"></span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="<?=isset($email) ? $email : '';?>" required/>
                            <span><?= isset($email_error)? htmlspecialchars($email_error): ''; ?></span>
                            <div class="invalid-feedback">
                                Please enter a valid email address for your account.
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="userName" class="form-label">User name</label>
                            <input type="text" class="form-control" id="userName" name="username" value="<?=isset($username) ? $username : '';?>" required/>
                            <span style=""><?= isset($makeError)? htmlspecialchars($makeError): '' ?></span>
                            <div class="invalid-feedback">
                                Please enter a valid user name.
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="password" class="form-label">Password <span class="text-muted"></span></label>
                            <input type="password" class="form-control" id="password" name="password" value="<?=isset($password) ? $password : '';?>" required/>
                            <span style=""><?= isset($makeError)? htmlspecialchars($makeError): '' ?></span>
                            <div class="invalid-feedback">
                                Update your new password
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?=isset($address) ? $address : '';?>" placeholder="1234 Main St" required/>
                            <span style=""><?= isset($makeError)? htmlspecialchars($makeError): '' ?></span>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="Bio" class="form-label">Bio</label>
                            <textarea class="form-control" name="bio" required></textarea>
                            <div class="invalid-feedback">
                                Please enter your bio.
                            </div>
                            <span style=""><?= isset($makeError)? htmlspecialchars($makeError): '' ?></span>
                        </div>
                    </div>
                    <div class="buttons">
                        <button class="button" type="submit" name="submit">Save</button>
                        <a href="list-users.php" class="button-color links">Back to list</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>




