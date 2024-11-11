<?php
namespace Backend;
require_once 'DataBase.php';

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

    public function delete($id) {
        // Inicializa el arreglo de respuesta
        $data = array(
            'status'  => 'error',
            'message' => 'La consulta falló'
        );
    
        // Realiza la consulta de eliminación lógica
        $sql = "UPDATE productos SET eliminado=1 WHERE id = {$id}";
    
        if ($this->query($sql)) {
            $data['status'] = "success";
            $data['message'] = "Producto eliminado";
        } else {
            $data['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion);
        }
    
        // Almacena el resultado en response para luego poder usar getData()
        $this->response = $data;
    }
}
?>