<?php



require_once __DIR__ . "/../../config/db.php";
require_once __DIR__ . "/../database/conexion.php";

class UsuarioModelo {

     private $conexion;

    public function __construct() {
        $db= new dataBase();
        $this->conexion= new conexion($db);
    }
    public function traerDatosUser($idUsuario){

    $sqlDatosUser="SELECT usuario.id,usuario.nombreYapellido,usuario.mail,usuario_roles.id_usuario, usuario_roles.id_rol FROM usuario_roles INNER JOIN usuario ON usuario_roles.id_usuario=usuario.id WHERE usuario.id=$idUsuario";
    $datosDeUsario=$this->conexion->ejecutarConsulta($sqlDatosUser);
    return $datosDeUsario;

    }

    public function registrarUser($datos){

     $nombreYape =  trim($datos['nombreYape']);
    $mail = trim($datos['mail']);
    $contraseña = trim($datos['contraseña']);
    $roles = $datos['roles'] ?? [];

    $errores=[];

    
        if (empty($nombreYape))     $errores['nombreYape']     = "Debe ingresar el nombre y apellido";
        if (empty($mail))      $errores['mail']      = "Debe ingresar el mail";
        if (empty($contraseña)) $errores['contraseña'] = "Debe ingresar la contraseña";
       

        if (!empty($nombreYape) && !preg_match("/^[A-Za-zÀ-ÿÑñ]+(?:\s[A-Za-zÀ-ÿÑñ]+)*$/", $nombreYape))
            $errores['nombre'] = "El nombre y apellido solo puede contener letras";

        if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
            $errores['mail'] = "Ingrese un mail válido";

        if (!empty($contraseña) && !preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/", $contraseña))
            $errores['contraseña'] = "La contraseña debe tener mínimo 8 caracteres, una mayúscula y un número";
        if (empty($roles)) {
            $errores['roles'] = "Debe seleccionar al menos un rol";
        }

        if(!empty($errores)){
             $this->conexion->cerrarConexion();
            return $errores;
        }

        $nombreYape = mysqli_real_escape_string($this->conexion->getConexion(),$nombreYape);
        $mail =  mysqli_real_escape_string($this->conexion->getConexion(),$mail);
        $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);

        $consulta="SELECT mail FROM usuario WHERE mail='$mail'";

        $mailDuplicado = $this->conexion->ejecutarConsulta($consulta);

        if($mailDuplicado && count($mailDuplicado)>0){
              $this->conexion->cerrarConexion();
              $errores['mail'] = "Este email ya ha sido registrado";

              return $errores;


        }

     
        $instruccion= "INSERT INTO usuario (nombreYapellido, mail, contraseña) VALUES ('$nombreYape', '$mail', '$contraseña')";
           $idUsuario= $this->conexion->ejecutarInstruccion($instruccion);

        

           foreach ($roles as $rol) {
                 $this->conexion->ejecutarInstruccion("INSERT INTO usuario_roles (id_usuario, id_rol) VALUES ('$idUsuario', '$rol')");
            }

            $this->conexion->cerrarConexion();

             return true;
        

       

    }

     public function loguearUser($datos){

     $mail = trim($datos['mail']);
    $contraseña = trim($datos['contraseña']);

     $errores=[];

    
    
        if (empty($mail))      $errores['mail']      = "Debe ingresar el mail";
        if (empty($contraseña)) $errores['contraseña'] = "Debe ingresar la contraseña";

        



    if(!empty($errores)){
             $this->conexion->cerrarConexion();
            return $errores;
    }else{

      $mail =  mysqli_real_escape_string($this->conexion->getConexion(),$mail);
    $contraseña =  mysqli_real_escape_string($this->conexion->getConexion(),$contraseña);

    
     $sql = "SELECT * FROM `usuario` WHERE mail='$mail'";
    $resultado = $this->conexion->ejecutarConsulta($sql); 

    if($resultado &&  count($resultado)>0 ){

        $usuario=$resultado[0];

        if($usuario['mail']==$mail){

         if (password_verify($contraseña, $usuario['contraseña'])) {
                  $this->conexion->cerrarConexion();
                return ['idUsuario' => $usuario['id']];



        }else{
           $this->conexion->cerrarConexion();
            return ['contraseña' => 'Email o contraseña incorrectos'];
        }

    }else{
           $this->conexion->cerrarConexion();
            return ['mail' => 'mail incorrecto'];
    }

    }else{
          return ['mail' => 'usted no se ha registrado todavia'];
    }   

        }
    }  
    
    public function buscarPorMail($mail) {
    $mail = trim($mail);
    $sql  = "SELECT id, nombreYapellido, mail FROM usuario WHERE mail = '$mail'";
    $resultado = $this->conexion->ejecutarConsulta($sql);
    return $resultado ? $resultado[0] : null;
        }   

    public function actualizarPassword($idUsuario, $passwordHash) {
    $sql = "UPDATE usuario SET contraseña = '$passwordHash' WHERE id = $idUsuario";
    $this->conexion->ejecutarInstruccion($sql);

    }


}


?>