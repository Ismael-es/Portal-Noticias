<?php

class dataBase{

    private $servidor="localhost";
    private $usuario="root";
    private $contraseña=""; // ver contraseña
    private $base_datos="portalnoticias";
    private $conexion;

   public function __construct() {
    
        $this->conexion= mysqli_connect($this->servidor,$this->usuario,$this->contraseña,$this->base_datos);

        if(!$this->conexion){
            throw new Exception("Error al intentar conectarse". mysqli_connect_error());
            
        }



}

    public function getConexion(){
        return $this->conexion;
    }
}


?>