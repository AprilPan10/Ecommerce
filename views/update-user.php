<?php
//both admin and users can update
use justprint\model\{Database, User};
require_once 'vendor/autoload.php';
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
//get user profile
$first_name=$last_name=$email=$username=$password=$address=$bio=$image="";
$u2 = new User();
if(isset($_POST['updateUser'])){
    $id = $_POST['id'];
    $dbcon =Database::getDb();
    $u =new User();
    $user = $u->getUserByID($id,$dbcon);
    $first_name=$user->first_name;
    $last_name=$user->last_name;
    $email=$user->email;
    $username=$user->username;
    $password=$user->password;
    $address=$user->address;
    $bio=$user->bio;
    $image=$user->image;
}
if($_SESSION['role']=="admin"){
    if(isset($_POST['updUser'])){
        $id = $_POST['sid'];
        $first_name = $_POST['first_name'];
        $last_name= $_POST['last_name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $address =$_POST['address'];
        $bio=$_POST['bio'];
        $image=$_FILES['image']['name'];
        $target_path = "Uploads/";
        $target_path = $target_path .  $_FILES['image']['name'];
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            echo "The file ".  $_FILES['image']['name'] . " has been uploaded ";
        } else{
            echo "Please upload your profile photo";
        }
        if ($first_name==""||$last_name==""||$email==""|| $username==""||$address==""||$bio==""||$image=="") {
            $makeError = "please enter a valid feedback";
        } else {
            $dbcon = Database::getDb();
            $u = new User();
            $count = $u->updateUser($id,$first_name,$last_name,$email,$username,$password,$address,$bio,$image,$dbcon);
            if ($count) {
                header("Location: list-users.php");
            } else {
                echo "Problem updating";


            }
        }


    }

}else{
    //update user profile
    if(isset($_POST['updUser'])){
        $id = $_POST['sid'];
        $first_name = $_POST['first_name'];
        $last_name= $_POST['last_name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password=$_POST['password'];
        $address =$_POST['address'];
        $bio=$_POST['bio'];
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
        } else {
            $dbcon = Database::getDb();
            $u = new User();
            $count = $u->updateUser($id,$first_name,$last_name,$email,$username,$password,$address,$bio,$image,$dbcon);
            if ($count) {
                header("Location: list-users.php");
            } else {
                echo "Problem updating";


            }
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
                        <!--                    update user photo-->
                        <img class="d-block mx-auto mb-4" src="Uploads/<?=$image;?>" alt="user photo" width="200">
                        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                        <input type="file" name="image" id="upfile" value="<?= $image;?>" required/>
                        <div class="invalid-feedback">
                            Please upload your images.
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Your Profile</h4>
                    <input type="hidden" name="sid" value="<?= $id; ?>" />
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">First name</label>
                            <input type="text" class="form-control" id="firstName" name="first_name" value="<?= $first_name;?>" required/>
                            <div class="invalid-feedback">
                                Please enter a valid first name.
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="lastName" name="last_name" value="<?= $last_name;?>" required/>
                            <div class="invalid-feedback">
                                Please enter a valid last name.
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Email <span class="text-muted"></span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="<?=$email;?>" required/>
                            <div class="invalid-feedback">
                                Please enter a valid email address for your account.
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="userName" class="form-label">User name</label>
                            <input type="text" class="form-control" id="userName" name="username" value="<?= $username;?>" required/>
                            <div class="invalid-feedback">
                                Please enter a valid user name.
                            </div>
                        </div>
                        <?php if($role=="user") {?>
                            <div class="col-12">
                                <label for="password" class="form-label">Password <span class="text-muted"></span></label>
                                <input type="password" class="form-control" id="password" name="password" value="" required/>
                                <div class="invalid-feedback">
                                    Update your new password
                                </div>
                            </div>
                        <?php }?>

                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?=$address;?>" placeholder="1234 Main St" required/>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="Bio" class="form-label">Bio</label>
                            <textarea class="form-control" name="bio" required><?=$bio;?></textarea>
                            <div class="invalid-feedback">
                                Please enter your bio.
                            </div>
                        </div>
                    </div>
                    <button class="button" type="submit" name="updUser">Save</button>
                    <a href="list-users.php" class="button-color links">Back to list</a>
        </form>
</div>
</div>
</main>
</div>



