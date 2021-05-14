<?php
//add an order
use justprint\model\{Database, Cart};
require_once 'vendor/autoload.php';
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
if(isset($_POST['submit'])) {
    $product_id = $_SESSION['productid'];
    if(isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], "id");

      /*  if(in_array($_POST['id'], $item_array_id)){
            echo "<script>alert('Product is already added in the cart..!')</script>";
            echo "<script>window.location = 'index.php'</script>";
        }else{*/

            $count = count($_SESSION['cart']);
            $item_array = array(
                'id' => $_SESSION['productid']
            );

            $_SESSION['cart'][$count] = $item_array;
       // }

    }else{

        $item_array = array(
            'id' => $_SESSION['productid']
        );

        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
    }
    $price = $_SESSION['price'];
    $name = $_SESSION['name'];
    $user_id = $_SESSION['id'];
    $status = "unpaid";
    $dbcon = Database::getDb();
    $u = new Cart();
    $s = $u->addOrder($product_id,$user_id, $name,$price,$status,$dbcon);
    if ($s) {
        header("Location:list-orders.php");
    } else {
        echo "Problem";

    }
}

