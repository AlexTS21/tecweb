<?php
namespace Backend;
include_once __DIR__.'/Products.php';
$product = new Products();
$product->edit($_POST['id']);
echo $product->getData();
?>
