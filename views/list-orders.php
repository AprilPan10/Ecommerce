<?php
//list orders
use justprint\model\{Database, Cart,User};
require_once 'vendor/autoload.php';
$user_id = isset($_SESSION['id'] ) ? $_SESSION['id'] : '';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
$dbcon =Database::getDb();
$u = new Cart();
$orders =  $u->getAllOrders(Database::getDb());
//$userid =$_SESSION['userid'];
$total = 0;
?>
    <h3 class="title">Order List</h3>
<?php foreach($orders as $order) { ?>
    <?php if($user_id==$order->user_id && $order->status == "unpaid") { ?>
    <div class="orderlist">
        <p>Order Number: <?= $order->id; $_SESSION['orderid'] = $order->id;?></p>
        <p>Product Id: <?= $order->product_id; ?></p>
        <p>User Id: <?= $order->user_id; ?></p>
        <p>Product Price: <?= $order->price; ?></p>
        <p>Product Name: <?= $order->name; ?></p>
        <p>Status: <?= $order->status; ?></p>
        <form action="../justprint/views/delete-order.php" method="post">
            <input type="hidden" name="id" value="<?= $order->id; ?>"/>
            <input type="submit"  name="submit" value="Delete" class="button"/>
        </form>
    </div>
       <?php $total = $total + (double)$order->price; ?>
<?php  } } ?>
<?Php
//$_SESSION['price']=array(); // Declaring session array
//array_push($_SESSION['price'],$orders); // Items added to cart

?>
<div><h4 class="title">Order Total:  </br> $ <?php

        echo $total;
?>
    </h4></div>
<!--<p>Product Price: --><?php //$price = array($_SESSION['price']); var_dump($price); foreach ($price as $key){echo $key;} ?><!--</p>-->

<?php
/*define('PAYPAL_API_URL', 'https://api-m.sandbox.paypal.com');

$PAYPAL = array(
    'client_id' => '',
    'client_secret' => '',
    'redirect_uri' => ''
);
get_token($PAYPAL);
create_order($PAYPAL);
function get_token($config) {
    $url = PAYPAL_API_URL . '/v1/oauth2/token';
    $headers = array(
        'Accept: application/json',
        'Accept-Language: en_US'
    );
    $opts = array(
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_USERPWD => $config['client_id'] . ':' . $config['client_secret'],
        CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
        CURLOPT_RETURNTRANSFER => true
    );
    $c = curl_init();
    curl_setopt_array($c, $opts);
    $result = json_decode(curl_exec($c));
    $_SESSION['paypal']['token'] = $result->access_token;
    curl_close($c);
}

function create_order($config) {
    $url = PAYPAL_API_URL . '/v2/checkout/orders';
    $headers = array(
        "Content-Type: application/json",
        "Authorization: Bearer " . $_SESSION['paypal']['token']
    );
    $data = array(
        'intent' => "CAPTURE",
        'purchase_units' => array(
            array(
                'amount' => array(
                    'currency_code' => "CAD",
                    'value' =>  (string)$_SESSION['amount']
                )
            )
        ),
        'application_context' => array(
            'brand_name' => 'Just print store',
            'user_action' => 'PAY_NOW',
            'return_url' => $config['redirect_uri']
        )
    );

    // print json_encode($data);
    $opts = array(
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_RETURNTRANSFER => true
    );
    $c = curl_init();
    curl_setopt_array($c, $opts);
    $result = json_decode(curl_exec($c));
    curl_close($c);
    print ' <div class="center"><a rel="' . $result->links[1]->rel . '" href="' . $result->links[1]->href . '"  class="button-link links">Paypal</a></div>';
    $_SESSION['orderid'] = $result->id;
}
*/?>
