<?php

date_default_timezone_set('America/Guayaquil');

class php_conexion {
    var $db_connection;
    function conn() {
        $db_host = "localhost:3306";
        $db_user = "root";
        $db_esquema = "administracion_colegio";
        $db_password = "mysqldb";

        $this->db_connection = mysqli_connect($db_host, $db_user, $db_password, $db_esquema);
        if (mysqli_connect_error()) {
            die("Failed to connect to MySQL: " . mysqli_connect_error());
        }
        // mysqli_autocommit($this->db_connection,FALSE);
        // $this->db_connection->autocommit(false);
        return $this->db_connection;
    }

    function obtenerConexion () {
      return $this->db_connection;
    }

    function realizarConsulta($consulta) {
        $conn = $this->conn();
        $conn->query("SET lc_time_names = 'es_EC'");
        $result = $conn->query($consulta);
        $rows = array();
        if($result){
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
                return $rows;
            } else {
                return null;
            }
        }
    }

    function realizarIngreso($ingreso) {
        $link = $this->conn();
        mysqli_query($link, $ingreso);
        return mysqli_affected_rows($link);
    }

    function realizarIngresoId($ingreso) {
        $link = $this->conn();
        mysqli_query($link, $ingreso);
        $datos = mysqli_insert_id($link);
        return $datos;
    }
    
    public function historial($usuario, $tabla, $tipo, $idAfectado, $descripcion) {
        $this->realizarIngreso("INSERT INTO historiales VALUES(null,'$usuario',' $tabla', '$tipo','$idAfectado','$descripcion',curdate())");
    }

    public function respuestaJson($lista) {
        $consulta = json_encode(
                array(
                    "data" => $lista
        ));
        return $consulta;
    }

    public function mensajes($tipo, $mensaje) {
        $arreglo = array('estado' => $tipo, 'mensaje' => $mensaje);
        echo $this->respuestaJson($arreglo);
    }

    public function response($tipo, $mensaje) {
      $arreglo = array('estado' => $tipo, 'mensaje' => $mensaje);
      return $this->respuestaJson($arreglo);
  }

}
