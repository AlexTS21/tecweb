<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    
    // SE VERIFICA HABER RECIBIDO EL PARÁMETRO DE BÚSQUEDA
    if( isset($_POST['search']) ) {
        $search = $_POST['search'];
        
        // SE REALIZA LA QUERY UTILIZANDO LIKE PARA NOMBRE, MARCA O DETALLES
        $query = "SELECT * FROM productos WHERE nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%'";
        
        if ( $result = $conexion->query($query) ) {
            // SE OBTIENEN TODOS LOS RESULTADOS Y SE AGREGAN AL ARREGLO
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $product = array();
                foreach($row as $key => $value) {
                    $product[$key] = utf8_encode($value); // SE CODIFICAN LOS DATOS A UTF-8
                }
                $data[] = $product; // SE AGREGA CADA PRODUCTO AL ARREGLO DE RESPUESTA
            }
			$result->free();
		} else {
            die('Query Error: '.mysqli_error($conexion));
        }
		$conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>
