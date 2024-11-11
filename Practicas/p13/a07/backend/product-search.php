<?php
require_once __DIR__ . '/vendor/autoload.php';
use myAPI\Read\Read;
$product = new Read();
$product->search($_GET['search']);
echo $product->getData();
?>
