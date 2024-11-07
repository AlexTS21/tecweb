<?php
// Definimos el namespace correspondiente
namespace Backend;

// Incluimos la clase Products
include_once __DIR__.'/Products.php';

// Verificamos que el ID del producto a eliminar esté presente

// Creamos una instancia de la clase Products
$product = new Products();

// Llamamos al método delete con el ID recibido
$product->delete($_POST['id']);  // Suponiendo que el ID es enviado por POST

// Usamos el método getData para devolver la respuesta en formato JSON
echo $product->getData();

?>
