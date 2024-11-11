<?php
require_once __DIR__ . '/vendor/autoload.php';
use myAPI\Read\Read;
$product = new Read();
$product->single($_POST['id']);  
echo $product->getData();
?>
