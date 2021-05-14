<?php
use justprint\model\{Database, User};
require_once 'vendor/autoload.php';
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
?>
<div class="title">
    <h3>Users Profile</h3>
</div>
<?php if($role=="admin") {?>
    <a href="../justprint/user.php" class="button links">Create a user</a>
<?php }?>
<!--list individual user information-->
<?php
if($role=="admin"){
    $dbcon =Database::getDb();
    $u = new User();
    $users =  $u->getAllUsers(Database::getDb());
    ?>
    <?php foreach($users as $user) { ?>
        <div class="review">
            <p>First Name:</p>
            <p class="reviewtext"><?= $user->first_name; ?></p>
            <p>Last Name:</p>
            <p class="reviewtext"><?= $user->last_name; ?></p>
            <p>Email:</p>
            <p class="reviewtext"><?= $user->email; ?></p>
            <p>Username:</p>
            <p class="reviewtext"><?= $user->username; ?></p>
            <p>Address:</p>
            <p class="reviewtext"><?= $user->address;  ?></p>
            <p>Bio:</p>
            <p class="reviewtext"><?= $user->bio; ?></p>
            <div id="buttons" class="mobile">
                <form action="update-user.php" method="post">
                    <input type="hidden" name="id" value="<?= $user->id; ?>"/>
                    <input type="submit"  name="updateUser" value="Update" class="button"/>
                </form>
                <form action="delete-user.php" method="post">
                    <input type="hidden" name="id"  value="<?= $user->id; ?>"/>
                    <input type="submit"  name="deleteUser" value="Delete" class="button-color links"/>
                </form>
                <a href="single-order.php?id=<?= $user->id; ?>" class="button-color links">Orders</a>
                <?php $_SESSION['userid'] = $user->id; ?>
            </div>
        </div>
    <?php } }else if($role=="user"){
    $user_id = isset($_SESSION['id'] ) ? $_SESSION['id'] : '';
    $dbcon =Database::getDb();
    $u = new User();
    $users =  $u->getUserById($user_id, Database::getDb());
    ?>

    <div class="review">
        <p>First Name:</p>
        <p class="reviewtext"><?= $users->first_name; ?></p>
        <p>Last Name:</p>
        <p class="reviewtext"><?= $users->last_name; ?></p>
        <p>Email:</p>
        <p class="reviewtext"><?= $users->email; ?></p>
        <p>Username:</p>
        <p class="reviewtext"><?= $users->username; ?></p>
        <p>Address:</p>
        <p class="reviewtext"><?= $users->address;  ?></p>
        <p>Bio:</p>
        <p class="reviewtext"><?= $users->bio; ?></p>
        <div id="buttons" class="mobile">
            <form action="./update-user.php" method="post">
                <input type="hidden" name="id" value="<?= $users->id; ?>"/>
                <input type="submit"  name="updateUser" value="Update" class="button"/>
            </form>
            <form action="./delete-user.php" method="post">
                <input type="hidden" name="id"  value="<?= $users->id; ?>"/>
                <input type="submit"  name="deleteUser" value="Delete" class="button-color links"/>
            </form>
        </div>
    </div>
<?php } ?>



