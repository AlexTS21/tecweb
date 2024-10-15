<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');

    if (!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JSON A OBJETO
        $jsonOBJ = json_decode($producto);

        // VERIFICAMOS SI EL JSON SE PARSEÓ CORRECTAMENTE
        if ($jsonOBJ === null) {
            echo json_encode(['status' => 'error', 'message' => 'Error al procesar el JSON.']);
            exit();
        }

        // PREPARAMOS LOS DATOS DEL PRODUCTO
        $nombre = $jsonOBJ->nombre;

        // COMPROBAR SI EL PRODUCTO YA EXISTE POR NOMBRE Y NO HA SIDO ELIMINADO
        $checkQuery = "SELECT id FROM productos WHERE nombre = ? AND eliminado = 0";

        if ($checkStmt = $conexion->prepare($checkQuery)) {
            $checkStmt->bind_param("s", $nombre);
            $checkStmt->execute();
            $checkStmt->store_result();

            // SI EXISTE ALGÚN REGISTRO CON ESE NOMBRE Y NO ESTÁ ELIMINADO
            if ($checkStmt->num_rows > 0) {
                echo json_encode(['status' => 'error', 'message' => 'El producto ya existe y no ha sido eliminado.']);
                $checkStmt->close();
                exit();
            }

            $checkStmt->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al preparar la consulta de verificación.']);
            exit();
        }

        // CONTINUAMOS CON LA INSERCIÓN SI EL PRODUCTO NO EXISTE
        $marca = $jsonOBJ->marca;
        $modelo = $jsonOBJ->modelo;
        $precio = $jsonOBJ->precio;
        $detalles = isset($jsonOBJ->detalles) ? $jsonOBJ->detalles : null;
        $unidades = $jsonOBJ->unidades;
        $imagen = isset($jsonOBJ->imagen) ? $jsonOBJ->imagen : 'ruta/a/imagen/por/defecto.jpg';  // Imagen por defecto si no se especifica

        // PREPARAR LA CONSULTA DE INSERCIÓN
        $query = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $conexion->prepare($query)) {
            $stmt->bind_param("sssdsis", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen);

            // EJECUTAR LA CONSULTA Y VERIFICAR SI FUE EXITOSA
            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Producto agregado con éxito.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al agregar el producto.']);
            }

            $stmt->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al preparar la consulta de inserción.']);
        }

        // CERRAR LA CONEXIÓN
        $conexion->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se ha recibido ningún dato.']);
    }
?>
