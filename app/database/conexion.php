
<?php

require_once  __DIR__ . "/../../config/db.php";

class conexion{
    private $conexion;

    public function __construct(dataBase $db){

        $this->conexion= $db->getConexion();

    }

     public function getConexion(){
        return $this->conexion;
    }

    public function ejecutarInstruccion($instruccion){
        try {
            $resultado = mysqli_query($this->conexion, $instruccion);

            if ($resultado === false) {
                $error_mysql = mysqli_error($this->conexion);
                throw new Exception("Error en la instruccion SQL: " . $error_mysql);
            } else {
                $id = mysqli_insert_id($this->conexion);
                
                if ($id > 0) {
                    return $id; 
                } else {
                    return true; 
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage(); 
            return false;
        }
    }

    public function ejecutarConsulta($instruccion){
        try {
            $sentencia=mysqli_query($this->conexion, $instruccion);

            if($sentencia){
                $datos=[];
                while($fila=mysqli_fetch_assoc($sentencia)){
                    $datos[]=$fila;
                }
                return $datos;
            }else{
            $error_mysql=mysqli_error($this->conexion);
            throw new Exception("Error en la consulta SQL". $error_mysql);
            
        }

        } catch (Exception $e) {
            echo $e->getMessage();
             return [];
        }

    }


    public function cerrarConexion(){
        $this->conexion->close();
    }

}


?>