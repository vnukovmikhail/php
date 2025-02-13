<?php
// читать json
$json = file_get_contents('../goods.json');
$json = json_decode($json, true);

// письмо
$message = '';
$message .= '<h1>заказ в магазине</h1>';
$message .= '<p>телефон: '.$_POST['ephone'].'</p>';
$message .= '<p>почта: '.$_POST['email'].'</p>';
$message .= '<p>клиент: '.$_POST['ename'].'</p>';

$cart = $_POST['cart'];
$sum = 0;
foreach($cart as $id => $count) {
    $message .= $json[$id]['name'].'-';
    $message .= $count.'шт.-';
    $message .= $count * $json[$id]['price'].'$';
    $message .= '<br>';
    $sum = $sum + $count * $json[$id]['price'];
}
$message .= 'всего: '.$sum.'$';
print_r($message);

$to = 'vnukovmisa72@gmail.com'.',';
$from = $_POST['email'];
$spectext = '<!DOCTYPE HTML><html><head><title>заказ</title></head><body>';
$headers = 'MIME-Version: 1.0'."\r\n";
$headers .= "From: $from"."\r\n";
$headers .= 'Content-type: text/html; charset=utf-8'."\r\n";

// увы и ах, но для работы необходимо иметь реальный хостинг ._.
$m = mail($to, 'заказ в магазине', $spectext.$message.'</body></html>', $headers);

if($m) {echo 1;} else {echo 0;}