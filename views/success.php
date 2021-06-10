<?php

?>

<?php
define('PAYPAL_API_URL', 'https://api-m.sandbox.paypal.com');

$PAYPAL = array(
    'client_id' => '',
    'client_secret' => '',
    'redirect_uri' => 'https://justprint.space/success.php'
);
get_token($PAYPAL);
capture_order($PAYPAL);
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
function capture_order($config) {
    $value = isset($_GET['token']) ? $_GET['token'] : '';
    $url = PAYPAL_API_URL . '/v2/checkout/orders/'.$value.'/capture ';
    $headers = array(
        "Content-Type: application/json",
        "Authorization: Bearer " . $_SESSION['paypal']['token'],
        // "PayPal-Request-Id: 7b92603e-77ed-4896-8e78-5dea2050476a"
    );

    $opts = array(
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true
    );
    $c = curl_init();
    curl_setopt_array($c, $opts);
    $result = json_decode(curl_exec($c));
    curl_close($c);
    $status = isset($result) ? $result : '';
    if (property_exists($status, 'status')){
        if($status->status == "COMPLETED"){
        echo '<div class="title"><h4> Thanks for ordering with us!</h4></div></br>';

        
        }
    }
}


