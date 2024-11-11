<?php
require_once __DIR__ . '/vendor/autoload.php';
use myAPI\Create\Create;
$product = new Create();
$product->add($_POST);  
echo $product->getData();
?>
