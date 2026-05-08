<?php


require_once __DIR__ . "/../../config/db.php"; 

require_once __DIR__ . "/../database/conexion.php";

class ParametrosModelo {


    private $conexion;


    public function __construct(){
        $db= new dataBase();
        $this->conexion= new conexion($db);
    }

    public function traerParametros(){

    $sql="SELECT id, nombre, valor FROM parametros";
    $resultado=$this->conexion->ejecutarConsulta($sql);

    return $resultado;
        
    }

       public function modificarParametros($datos){
        $dias=trim($datos['dias']);
        $tamaño=(int)$datos['tamaño'] * 1048576;

         $errores=[];

         if(empty($dias) || empty($tamaño)){
             $errores['config'] = "los datos no deben estar vacios";
            }

        if($dias<1){
            $errores['dias']="los dias de expiracion deben ser mayores a 1";
        }

        if(!empty($errores)){
            return $errores;
        }else{

            $sqlDias = "UPDATE parametros SET valor = $dias WHERE nombre = 'maxDiasPublicacion'";
            $this->conexion->ejecutarInstruccion($sqlDias);

            $sqlTamaño = "UPDATE parametros SET valor = $tamaño WHERE nombre = 'tamMax'";
            $this->conexion->ejecutarInstruccion($sqlTamaño);

       

            return [];

        }

    }

}



?>