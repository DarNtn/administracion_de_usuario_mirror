<?php

date_default_timezone_set('America/Guayaquil');

class conexion {
    
    public static $INSERTAR= 1;
    public static $ACTUALIZAR= 2;
    public static $ELIMINAR= 3;
    public static $ACEPTAR= 4;
    public static $RECHAZAR= 5;
    public static $VACACIONES= 5;
    public static $FRANCOS= 1;

    // 0603952151
    function conPdo() {
       //$pdo = new PDO('mysql:host=localhost;port=3306;dbname=camaronera', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET lc_time_names='es_ES',NAMES utf8"));

        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=administracion_colegio', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET lc_time_names='es_ES',NAMES utf8"));
        return $pdo;
    }

    function realizarConsulta($sentencia) {
        try {
            $link = $this->conPdo()->query($sentencia);
            $resultado = $link->fetchAll(PDO::FETCH_ASSOC);
            $rows = array();
            foreach ($resultado as $row) {
                $rows[] = $row;
            }
            if (count($rows) > 0) {
                return $rows;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    function respuestaJson($lista) {
        $consulta = json_encode(array("count" => count($lista),"data" => $lista));
        return $consulta;
    }

    function mensajes($tipo, $texto, $value = NUll, $etiquetas = NUll) {
        $valor = is_null($value) ? "" : $value;
        $html = is_null($etiquetas) ? "" : $etiquetas;

        $arreglo = array('tipo' => $tipo, 'texto' => $texto, 'value' => $valor, 'html' => $html);
        echo $this->respuestaJson($arreglo);
    }

    function realizarIngresoID($sentencia) {
        try {
            $this->conPdo()->query($sentencia);
        } catch (PDOException $e) {
            die($e->getMessage());
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    function realizarIngresoIndex($sentencia) {
         try {
             $conn=$this->conPdo();
            $smf=$conn->prepare($sentencia);
            $smf->execute();
            return $conn->lastInsertId();
        } catch (PDOException $e) {
            die($e->getMessage());
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    function realizarUpdate($sentencia) {
        try {
            if ($this->conPdo()->query($sentencia)) {
                
            } else {
                die($this->mensajes('error', 'No se pudo asignar'));
                die("Error al realizar la actualizacion");
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    function realizarUpdateOk($sentencia) {
        try {
            if ($this->conPdo()->query($sentencia)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

}
