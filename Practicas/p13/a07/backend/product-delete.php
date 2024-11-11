<?php
require_once __DIR__ . '/vendor/autoload.php';
use myAPI\Delete\Delete;
$product = new Delete();
$product->delete($_POST['id']);  
echo $product->getData();
?>
