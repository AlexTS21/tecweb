<?php
namespace myAPI\Create;
use myAPI\DataBase\DataBase; 

class Create extends DataBase {
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

    public function add($product) {
        $data = array(
            'status'  => 'error',
            'message' => 'Ya existe un producto con ese nombre'
        );

        $productData = json_decode(json_encode($product), false);

        if (isset($productData->nombre)) {
            $sql = "SELECT * FROM productos WHERE nombre = '{$productData->nombre}' AND eliminado = 0";
            $result = $this->query($sql);

            if (is_object($result) && $result->num_rows == 0) {
                $this->conexion->set_charset("utf8");

                $sql = "INSERT INTO productos VALUES (null, '{$productData->nombre}', '{$productData->marca}', '{$productData->modelo}', {$productData->precio}, '{$productData->detalles}', {$productData->unidades}, '{$productData->imagen}', 0)";
                
                if ($this->query($sql)) {
                    $data['status'] = "success";
                    $data['message'] = "Producto agregado";
                } else {
                    $data['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion);
                }
            }

            if (is_object($result)) {
                $result->free();
            }
        }

        // Almacena el resultado de la operación en response
        $this->response = $data;
    }
}
?>