<?php
    include('database.php');
    $id = $_POST['id'];
    $query = "SELECT * FROM productos WHERE id=$id";
    $result = mysqli_query($conexion, $query );
    if(!$result){
        die('Query failed');
    }

    $json = array();
    while( $row = mysqli_fetch_array($result)){
        $json[] = array(
            'nombre' => $row['nombre'],
            'precio' => $row['precio'],
            'modelo' => $row['modelo'],
            'unidades' => $row['unidades'],
            'marca' => $row['marca'],
            'detalles' => $row['detalles'],
            'imagen' => $row['imagen'],
            'id' => $row['id']
        );
    }

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
?>