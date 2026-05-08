<?php
// controllers/UsuarioController.php

require_once __DIR__ . "/../models/usuario.php";
require __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class UsuarioController {

    private $modelo;
    private $modeloUsuario;
     public $datos_de_usuario= [];
    public $errores = [];
    public $datos   = [];
    public $exito   = false;

    public function __construct() {
        $this->modelo = new UsuarioModelo();
        $this->modeloUsuario = new UsuarioModelo();
       if (!empty($_SESSION['idUsuario'])) {
         $this->datos_de_usuario = $this->modelo->traerDatosUser($_SESSION['idUsuario']);
    }
    }

    public function login() {
        if (isset($_POST['iniciarSesion'])) {
            $resultado = $this->modelo->loguearUser($_POST);

            if (isset($resultado['idUsuario'])) {
                $_SESSION['idUsuario'] = $resultado['idUsuario'];
                header("Location: index.php?c=noticia&a=lista");
                exit();
            } else {
               $errores= $this->errores = $resultado;
               $datos= $this->datos   = $_POST;
            }
        }
        

       require_once __DIR__ . "/../views/usuario/login.php";
    }

    public function registro() {
      
        if (isset($_POST['enviarRegistro'])) {
            $resultado = $this->modelo->registrarUser($_POST);

            if ($resultado === true) {
               $exito= $this->exito = true;
            } else {
               $errores=$this->errores = $resultado;
               $datos= $this->datos   = $_POST;
            }
        }

         $datosUsuario = $this->datos_de_usuario;

        require_once  __DIR__ . "/../views/usuario/registroDeUsuario.php";
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?c=usuario&a=login");
        exit();
    }



    public function recuperar() {

        if (isset($_POST['enviarRecuperacion'])) {

            $mail = trim($_POST['mail'] ?? '');

            if (empty($mail)) {
              $errores= $this->errores['mail'] = "El email es obligatorio";
            } else {

                $usuario = $this->modelo->buscarPorMail($mail);

                if ($usuario) {

              
                    $codigo = rand(100000, 999999);

                        $_SESSION['recuperacion'] = [
                            'mail' => $mail,
                            'codigo' => $codigo,
                            'expira' => time() + 600 
                        ];

            

              
                    require __DIR__ . '/../../vendor/autoload.php';

                    $mailer = new PHPMailer(true);

                    try {
                        $mailer->isSMTP();
                        $mailer->Host = 'smtp.gmail.com';
                        $mailer->SMTPAuth = true;
                        $mailer->Username = 'retrofariaslucero@gmail.com';
                        $mailer->Password = 'gbsvtllewknqdyhy';
                        $mailer->SMTPSecure = 'tls';
                        $mailer->Port = 587;

                        $mailer->setFrom('retrofariaslucero@gmail.com', 'Portal Noticias');
                        $mailer->addAddress($mail, $usuario['nombreYapellido']);

                        $mailer->isHTML(true);
                        $mailer->Subject = 'Codigo de recuperacion';
                        $mailer->Body = "
                            <h3>Recuperar contraseña</h3>
                            <p>Tu código es:</p>
                            <h2>$codigo</h2>
                            <p>Este código vence en 10 minutos</p>
                        ";

                        $mailer->send();
                    

                        require __DIR__ . "/../views/usuario/recuperarcodigo.php";
                        

                    } catch (Exception $e) {
                      $errores=  $this->errores['mail'] = "Error al enviar el correo";
                    }

                } else {
                   $errores= $this->errores['mail'] = "No existe una cuenta con ese email";
                }
            }
        }

        require_once __DIR__ . "/../views/usuario/recuperar.php";
    }


  public function validarCodigo() {


   if (isset($_POST['enviarCodigo'])) {

    $codigo = $_POST['codigo'] ?? '';
    $data = $_SESSION['recuperacion'] ?? null;

    if (!$data) {
       $errores= $this->errores['codigo'] = "Sesión expirada";
    } elseif ($data['expira'] < time()) {
       $errores=  $this->errores['codigo'] = "Código vencido";
    } elseif ($codigo != $data['codigo']) {
      $errores=  $this->errores['codigo'] = "Código incorrecto";
    } else {

       
        $_SESSION['recuperacion_validada'] = true;

        require __DIR__ . "/../views/usuario/nuevacontraseña.php";
        
    }
   }
    require_once __DIR__ . "/../views/usuario/recuperarcodigo.php";
}

public function guardarContraseña() {

   


    if (empty($_SESSION['recuperacion_validada'])) {
        header("Location: index.php?c=usuario&a=recuperar");
        exit;
    }

     if (isset($_POST['guardarContraseña'])) {

    $password = $_POST['password'] ?? '';

    if (empty($password)) {
        $errores= $this->errores['password'] = "La contraseña es obligatoria";
    } else {

        $mail = $_SESSION['recuperacion']['mail'];
        $usuario = $this->modelo->buscarPorMail($mail);

        if ($usuario) {

            $passHash = password_hash($password, PASSWORD_DEFAULT);
            $this->modelo->actualizarPassword($usuario['id'], $passHash);

            unset($_SESSION['recuperacion']);
            unset($_SESSION['recuperacion_validada']);

          $exito=  $this->exito = true;

            require_once __DIR__ . "/../views/usuario/login.php";
        }
    }

    require_once __DIR__ . "/../views/usuario/nuevacontraseña.php";
}


}

}


?>