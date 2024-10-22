<?php
    include('database.php');
    // SE TRANSFORMA EL STRING DEL JASON A OBJETO
    $producto = file_get_contents('php://input');
    $data = array(
        'status'  => 'error',
        'message' => 'Ya existe un producto con ese nombre'
    );

    if(!empty($producto)) {
        $jsonOBJ = json_decode($producto);
            // Construye la consulta SQL para actualizar el registro usando el ID
        $sql = "UPDATE productos 
            SET nombre = '$jsonOBJ->nombre', 
                marca = '$jsonOBJ->marca', 
                modelo = '$jsonOBJ->modelo', 
                precio = $jsonOBJ->precio, 
                detalles = '$jsonOBJ->detalles', 
                unidades = $jsonOBJ->unidades, 
                imagen = '$jsonOBJ->imagen' 
            WHERE id = $jsonOBJ->id"; // Se usa el ID recibido del formulario

        // Ejecuta la consulta y verifica si fue exitosa
        if ( $conexion->query($sql)) {
            $data['status'] = "succes";
            $data['message'] = "Registro actualizado exitosamente.";
        } else {
            $data['message'] =  "ERROR: No se pudo ejecutar $sql. " . mysqli_error($conexion);
        }
        mysqli_close($conexion);
    }

    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>