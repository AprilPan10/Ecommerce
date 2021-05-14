<?php
use justprint\model\{Database, User};
require_once 'vendor/autoload.php';

//Redirect if logged in
if(isset($_SESSION['username'])){
    header('Location: list-users.php');
}
$error = false;
if(isset($_POST['login'])){

    //get values from form and assign to local variable
    $uname = $_POST['uname'];
    $pass = $_POST['password'];
    $dbcon = Database::getDb();
    $u = new User();
    $users =  $u->getAllUsers(Database::getDb());
    foreach ($users as $user){
        //create s session it credential is valid
        if($uname == $user->username && password_verify($pass, $user->password)){
            $_SESSION['username'] = $uname;
            $_SESSION['id'] = $user->id;
            $_SESSION['role'] = $user->role;
            header('Location: login.php');
        } else {
            $error = true;
        }
    }
}
?>
<div class="container block">
    <h3>Login form</h3>
    <main>
        <form method="post" action="" class="needs-validation" novalidate>
            <div class="row g-3">
                <div class="col-12 space">
                    <label for="username" class="form-label">Username</label>
                    <input type="text"  class="form-control" name="uname" required/>
                    <div class="invalid-feedback">
                        Please enter a valid username.
                    </div>
                </div>
                <div class="col-12 space">
                    <label class="form-label" for="password">Password</label>
                    <input type="password"  class="form-control" name="password" required />
                    <div class="invalid-feedback">
                        Please enter a valid password.
                    </div>
                </div>
            </div>
            <div><?php if($error){
                    echo '<p class="space">Invalid username or password</p>';
                } ?></div>
            <div class="space-b">
                <input type="submit" name="login" value="Login" class="button"/>
            </div>
        </form>
        <div class="link space">
            <a href="signup.php">Sign Up</a>
        </div>
    </main>
</div>


