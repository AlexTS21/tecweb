<?php
namespace myAPI\Update;
use myAPI\DataBase\DataBase; 

class Update extends DataBase {
    public function __construct($dbName = 'marketzone', $user = 'root', $password = 'IMREDj2128@') {
        $this->response = null;
        parent::__construct($user, $password, $dbName);
    }

    protected function query($sql) {
        $result = mysqli_query($this->conexion, $sql);
        if ($result) {
            $this->response = $result;
        } else {
            $this->response = 'Error en la consulta: ' . mysqli_error($this->conexion);
        }
        return $this->response;
    }

    public function edit($product) {
        // Inicializa el arreglo de respuesta
        $data = array(
            'status'  => 'error',
            'message' => 'La consulta falló'
        );
    
        // Convierte el objeto a JSON y luego a un arreglo asociativo
        $productData = json_decode(json_encode($product), false);
    
        // Verifica que se haya proporcionado el ID
        if (isset($productData->id)) {
            // Construye la consulta de actualización
            $sql = "UPDATE productos SET 
                        nombre = '{$productData->nombre}', 
                        marca = '{$productData->marca}', 
                        modelo = '{$productData->modelo}', 
                        precio = {$productData->precio}, 
                        detalles = '{$productData->detalles}', 
                        unidades = {$productData->unidades}, 
                        imagen = '{$productData->imagen}' 
                    WHERE id = {$productData->id} AND eliminado = 0";
    
            // Ejecuta la consulta y actualiza el estado según el resultado
            if ($this->query($sql)) {
                $data['status'] = "success";
                $data['message'] = "Producto actualizado";
            } else {
                $data['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion);
            }
        } else {
            $data['message'] = "ID del producto no proporcionado";
        }
    
        // Almacena el resultado en response para luego poder usar getData()
        $this->response = $data;
    }
    
}
?>