<?php
// controllers/ConfigController.php

require_once __DIR__ . "/../models/config.php";
require_once __DIR__ . "/../models/usuario.php";

class ConfigController {

    private $modelo;
    private $modeloUsuario;
    public $errores    = [];
    public $datos      = [];
    public $exito      = false;
    public $parametros = [];
    public $datos_de_usuario = [];

    public function __construct() {
        $this->modelo = new ParametrosModelo();
        $this->modeloUsuario = new UsuarioModelo();
        $this->datos_de_usuario = $this->modeloUsuario->traerDatosUser($_SESSION['idUsuario']);
    }

    public function index() {
      $parametros=  $this->parametros = $this->modelo->traerParametros();
        $datosUsuario= $this->datos_de_usuario;
        require_once __DIR__ . "/../views/configuracion/config.php";
    }

    public function guardar() {
        if (isset($_POST['guardar'])) {
           
            $resultado = $this->modelo->modificarParametros($_POST);

            if (empty($resultado)) {
              $exito=  $this->exito = true;
            } else {
               $errores= $this->errores = $resultado;
               $datos= $this->datos   = $_POST;
            }
        }
         $datosUsuario= $this->datos_de_usuario;

      $parametros= $this->parametros = $this->modelo->traerParametros();
    
      
        require_once __DIR__ . "/../views/configuracion/config.php";
    }
}