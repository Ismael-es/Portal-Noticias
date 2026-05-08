<?php

require_once __DIR__ . "/../models/noticia.php";
require_once __DIR__ . "/../models/usuario.php";

class NoticiaController {

    private $modelo;
     private $modeloUsuario;
    private $datos_de_usuario = [];
    public $errores = [];
    public $datos   = [];
    public $exito   = false;

     public function __construct() {
        $this->modelo = new noticiaModelo();
        $this->modeloUsuario = new UsuarioModelo();
        
       $this->datos_de_usuario = $this->modeloUsuario->traerDatosUser($_SESSION['idUsuario']);
         $this->expirarNoticias();
          
    }
    private function expirarNoticias() {
        $this->modelo->expirarNoticias();
    }
   
    private function traerPorEstado($estado) {
        $resultado = $this->modelo->traerDatosNoticia($estado);
        return $resultado ? $resultado : [];
    }


    private function traerDatosNoticiaHistorial() {
        $resultado = $this->modelo->traerDatosNoticiaHistorial();
        return $resultado ? $resultado : [];
    }

    private function cargarDatosAutor() {
         $datosUsuario = $this->datos_de_usuario;
    $datosUsuario=$this->datos_de_usuario = $this->modeloUsuario->traerDatosUser($_SESSION['idUsuario']);
}

    private function cargarDatos() {
           $this->cargarDatosAutor();
       $this->borrador  = $this->traerPorEstado(1);
        $this->validar   = $this->traerPorEstado(2);
       $this->correcion= $this->traerPorEstado(3);
        $this->publicadas= $this->traerPorEstado(4);
       $this->anuladas  = $this->traerPorEstado(6);
    }

     public function lista() {
       
         $this->cargarDatos();
        $publicadas=$this->publicadas;
         $datosUsuario = $this->datos_de_usuario;
        require_once __DIR__ . "/../views/noticia/lista.php";
    }
    
    public function correccion() {
       $this->cargarDatos();
       $correcion= $this->correcion;
         $datosUsuario = $this->datos_de_usuario;
    require_once __DIR__ . "/../views/noticia/correccion.php";
    }

    public function borrador() {
        $this->cargarDatos();
        $borrador=$this->borrador;
          $datosUsuario = $this->datos_de_usuario;
    require_once __DIR__ . "/../views/noticia/borrador.php";
    }
    public function validar() {
        $this->cargarDatos();
         $validar= $this->validar;
         $publicadas= $this->publicadas;
           $datosUsuario = $this->datos_de_usuario;
    require_once __DIR__ . "/../views/noticia/validacion.php";
    }

   public function historial() {
        
          $datosUsuario = $this->datos_de_usuario;
        
        $resultado = $this->traerDatosNoticiaHistorial();
        
       
        $noticiasAgrupadas = [];
        foreach($resultado as $fila) {
            $idNoticia = $fila['idNoticia'];
            $noticiasAgrupadas[$idNoticia][] = $fila;
        }
        
        $datosHistorial=$this->datosHistorial = $noticiasAgrupadas;
        require_once __DIR__ . "/../views/noticia/historial.php";
}
     
     
        public function crear() {
              $datosUsuario = $this->datos_de_usuario;
              
          if(isset($_POST['enviarNoticia'])){
            $resultado = $this->modelo->guardarNoticia($_POST);

                if ($resultado === true) {
                   $exito=$this->exito = true;
                } else {
                  $errores= $this->errores = $resultado;  
                    $datos=$this->datos   = $_POST;     
                }
            }

        require_once __DIR__ . "/../views/noticia/noticiaCrear.php"; 
     }

     public function cambiarEstado() {
    $estado  = null;
    $destino = 'lista';

    switch(true) {
        case isset($_POST['anularBoton']):
            $estado  = 6;
            $destino = 'borrador';
            break;
        case isset($_POST['validarBoton']):
            $estado  = 2;
            $destino = 'borrador';
            break;
        case isset($_POST['publicarBoton']):
            $estado  = 4;
            $destino = 'validar';
            break;
        case isset($_POST['coreccionBoton']):
            $estado  = 3;
            $destino = 'validar';
            break;
    }

    if ($estado) {
        $this->modelo->cambiarEstado($_POST, $estado, $_SESSION['idUsuario']);
    }

    $this->$destino();
}

public function editar() {
    $this->cargarDatos();
      $datosUsuario = $this->datos_de_usuario;

    if (isset($_POST['idNoticia']) && !isset($_POST['editarNoticia'])) {
      $noticia=  $this->noticia = $this->modelo->traerDatosNoticia(3, $_POST['idNoticia'])[0] ?? [];
        require_once __DIR__ . "/../views/noticia/editarNoticia.php";
        return;
    }


    if (isset($_GET['id'])) {
       $noticia= $this->noticia = $this->modelo->traerDatosNoticia(3, $_GET['id'])[0] ?? [];
    }

   
    if (isset($_POST['editarNoticia'])) {
        $resultado = $this->modelo->guardarNoticiaEditada($_POST);

        if ($resultado === true) {
          $exito=  $this->exito  = true;
           $noticia= $this->noticia = $this->modelo->traerDatosNoticia(3, $_POST['idNoticia'])[0] ?? [];
        } else {
          $errores=  $this->errores = $resultado;
            $datos=$this->datos   = $_POST;
        }
    }
    require_once __DIR__ . "/../views/noticia/editarNoticia.php";
}
}

?>