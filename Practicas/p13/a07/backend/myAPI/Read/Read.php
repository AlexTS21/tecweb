<?php
namespace myAPI\Read;
use myAPI\DataBase\DataBase; 

class Read extends DataBase {
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

    public function single($id) {
        $data = array();
        $sql = "SELECT * FROM productos WHERE id = {$id}";
        $result = $this->query($sql);

        if (is_object($result) && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (!is_null($row)) {
                foreach ($row as $key => $value) {
                    $data[$key] = utf8_encode($value);
                }
            }
            $result->free();
        } else {
            die('Error en la consulta: ' . mysqli_error($this->conexion));
        }

        // Almacena los datos obtenidos en la propiedad response
        $this->response = $data;
    }

    public function singleByName($name) {
        $data = array();
        $sql = "SELECT * FROM productos WHERE name = {$nombre}";
        $result = $this->query($sql);

        if (is_object($result) && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (!is_null($row)) {
                foreach ($row as $key => $value) {
                    $data[$key] = utf8_encode($value);
                }
            }
            $result->free();
        } else {
            die('Error en la consulta: ' . mysqli_error($this->conexion));
        }

        // Almacena los datos obtenidos en la propiedad response
        $this->response = $data;
    }

    public function list() {
        // Inicializa el arreglo de respuesta
        $data = array();
    
        // Realiza la consulta para obtener todos los productos no eliminados
        $sql = "SELECT * FROM productos WHERE eliminado = 0";
        $result = $this->query($sql);
    
        // Verifica si hubo resultados y procesa los datos
        if (is_object($result) && $result->num_rows > 0) {
            // Obtiene todos los resultados como un arreglo asociativo
            $rows = $result->fetch_all(MYSQLI_ASSOC);
    
            if (!is_null($rows)) {
                // Codifica a UTF-8 y mapea los datos al arreglo de respuesta
                foreach ($rows as $num => $row) {
                    foreach ($row as $key => $value) {
                        $data[$num][$key] = utf8_encode($value);
                    }
                }
            }
            $result->free();
        } else {
            die('Error en la consulta: ' . mysqli_error($this->conexion));
        }
    
        // Almacena el resultado en response para luego poder usar getData()
        $this->response = $data;
    }

    public function search($search) {
        // Inicializa el arreglo de respuesta
        $data = array();
    
        // Construye la consulta para buscar en múltiples campos
        $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
        $result = $this->query($sql);
    
        // Verifica si hubo resultados y procesa los datos
        if (is_object($result) && $result->num_rows > 0) {
            // Obtiene todos los resultados como un arreglo asociativo
            $rows = $result->fetch_all(MYSQLI_ASSOC);
    
            if (!is_null($rows)) {
                // Codifica a UTF-8 y mapea los datos al arreglo de respuesta
                foreach ($rows as $num => $row) {
                    foreach ($row as $key => $value) {
                        $data[$num][$key] = utf8_encode($value);
                    }
                }
            }
            $result->free();
        } else {
            die('Error en la consulta: ' . mysqli_error($this->conexion));
        }
    
        // Almacena el resultado en response para luego poder usar getData()
        $this->response = $data;
    }

}
?>