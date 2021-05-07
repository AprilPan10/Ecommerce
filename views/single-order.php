<?php
use justprint\model\{Database, Cart};
require_once 'vendor/autoload.php';
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
$user_id = isset($_SESSION['id'] ) ? $_SESSION['id'] : '';
$name = $type = $description = $price = "";
if(isset($_GET['id'])){
    $id= $_GET['id'];
    $dbcon =Database::getDb();
    $u = new Cart();
    $orders =  $u->getAllOrders(Database::getDb());
    $userid =$_SESSION['userid'];
}
$total = 0;
?>
<h3 class="title">Order List</h3>
<?php foreach($orders as $order) { ?>
    <?php if($id==$order->user_id) {?>
        <div class="orderlist">
            <p>Order Number: <?= $order->id; $_SESSION['orderid'] = $order->id;?></p>
            <p>Product Id: <?= $order->product_id; ?></p>
            <p>User Id: <?= $order->user_id; ?></p>
            <p>Product Price: <?= $order->price; ?></p>
            <p>Product Name: <?= $order->name; ?></p>
            <form action="../justprint/views/delete-order.php" method="post">
                <input type="hidden" name="id" value="<?= $order->id; ?>"/>
                <input type="submit"  name="submit" value="Delete" class="button"/>
            </form>
        </div>
    <?php } }  ?>


