<?php
require_once __DIR__ . '/vendor/autoload.php';
use myAPI\Update\Update;
$product = new Update();
$product->edit($_POST);
echo $product->getData();
?>
