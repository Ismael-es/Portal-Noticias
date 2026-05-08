<?php



require_once __DIR__ . "/../../config/db.php"; 

require_once __DIR__ . "/../database/conexion.php";

class noticiaModelo{

    private $conexion;

   public function __construct() {
        $db= new dataBase();
        $this->conexion= new conexion($db);
    }

      public function traerDatosNoticia($idDeEstado,$idNoticia=null){
       

        if($idNoticia!=null){
        $sql="SELECT noticia.id, noticia.titulo, noticia.descripcion, noticia.imagen, noticia.fechaCreacion, noticia.fechaPublicacion, estado.id AS idEstado,usuario.id AS idCreador ,estado.nombre AS nombreEstado,  usuario.nombreYapellido AS nombreUsuario
         FROM noticia
        INNER JOIN estado ON noticia.id_estado=estado.id
        INNER JOIN usuario ON noticia.id_autor=usuario.id WHERE id_estado=$idDeEstado AND noticia.id=$idNoticia";

         $datosDeLasNoticias= $this->conexion->ejecutarConsulta($sql);

         
        return $datosDeLasNoticias;


        }else{

        $sql="SELECT noticia.id, noticia.titulo, noticia.descripcion, noticia.imagen, noticia.fechaCreacion, noticia.fechaPublicacion, usuario.id AS idCreador ,estado.nombre AS nombreEstado,  usuario.nombreYapellido AS nombreUsuario
         FROM noticia
        INNER JOIN estado ON noticia.id_estado=estado.id
        INNER JOIN usuario ON noticia.id_autor=usuario.id WHERE id_estado=$idDeEstado";

        $datosDeLasNoticias= $this->conexion->ejecutarConsulta($sql);

        return $datosDeLasNoticias;

        }

      




    }

     public function guardarNoticia($datos){

        $titulo=  trim($datos['titulo']);
        $descripcion = trim($datos['descripcion']);
        $estadoInicial =  $datos['estadoInicial'] ?? null;
        $idAutor=$datos['autorNoticia']  ?? null;

        $directorio_fisico = __DIR__ . "/../../public/uploads/"; 
        $directorio_url = "uploads/"; 

        if(!is_dir($directorio_fisico)){
             mkdir($directorio_fisico, 0755, true);
        }

        $errores=[];

        if (empty($titulo)){
             $errores['titulo'] = "Debe ingresar el titulo";
        }else if(strlen($titulo)<10 || strlen($titulo)>100){
               $errores['titulo'] = "El titulo debe tener entre 10 y 100 caracteres";
        }
        if (empty($descripcion)){
                 $errores['descripcion']  = "Debe ingresar la descripcion";
        }else if(strlen($descripcion)<50){
                 $errores['descripcion']  = "La descripcion debe tener al menos 50 caracteres";
        }
           
        if (empty($estadoInicial)) 
            $errores['estadoInicial'] = "Debe ingresar un estado inicial";

        if (empty($idAutor)) 
            $errores['autorNoticia'] = "Debe ingresar un autor para la noticia";

        if(!empty($errores)){
            return $errores;
        }

         



        if(!empty($_FILES['imagen']['name'])){



            $file_nombre = $_FILES['imagen']['name'];
            $file_temp_nombre= $_FILES['imagen']['tmp_name'];
            $file_size = $_FILES['imagen']['size'];
            $file_extension   = strtolower(pathinfo($file_nombre, PATHINFO_EXTENSION));

            $sqlParametros="SELECT valor FROM parametros WHERE nombre='tamMax'";
            $resultadoParametro=$this->conexion->ejecutarConsulta($sqlParametros);

            $tamMax = (int)$resultadoParametro[0]['valor'];


            $extensionesPermitidas = ['jpg', 'png'];

                if (!in_array($file_extension, $extensionesPermitidas)) {
                    $errores['imagen'] = "Solo se permiten imágenes JPG o PNG";
                }

                if ($file_size > $tamMax) {
                $errores['imagen'] = "La imagen no debe superar los 2MB";
                }

                if (!empty($errores)) {
                    $this->conexion->cerrarConexion();
                return $errores;
                }

                 
               // SI VES QUE NO INGRESA UNA NOTCIA Y VES QUE ESTA TODO BIEN, ES PORQUE SQL NO PERMITE EL USO RESTRICTIVO DE COMILLAS, SI TU DESCRIPCION O TITULO TEIENEN COMILLAS NO TE DEJA INSERTAR UNA NOTICIA

            $nuevo_file_name  = uniqid('img-', true) . '.' . $file_extension;

            $destinoFisicoFinal=$directorio_fisico.$nuevo_file_name;
            $destination_url = $directorio_url. $nuevo_file_name;

            if (move_uploaded_file($file_temp_nombre, $destinoFisicoFinal)) {
                     $sql="INSERT INTO noticia(titulo,descripcion,imagen,id_estado,id_autor) VALUES ('$titulo', '$descripcion', '$destination_url','$estadoInicial','$idAutor')";
                  $this->conexion->ejecutarInstruccion($sql);
                  
                   
                       return true;
                } else {
                    $errores['imagen'] = "Error al subir la imagen";
                    return $errores;
                }


            }else {
             $destination_url = null; 

             $sql="INSERT INTO noticia(titulo,descripcion, imagen,id_estado,id_autor) VALUES ('$titulo', '$descripcion', '$destination_url','$estadoInicial','$idAutor')";
               $this->conexion->ejecutarInstruccion($sql);
            
                  return true;
            }


             





    }

    public function traerDatosNoticiaHistorial(){
       

 
       $sql = "SELECT noticia.id AS idNoticia, noticia.titulo AS tituloNoticia , usuario.nombreYapellido AS nombreUsuario,
        auditoria.fechaYhora, e1.nombre AS estadoAnterior, e2.nombre AS estadoNuevo 
        FROM auditoria 
        INNER JOIN usuario ON auditoria.id_usuario=usuario.id
        INNER JOIN noticia ON auditoria.id_noticia=noticia.id
        INNER JOIN estado e1 ON auditoria.id_estado_antiguo=e1.id
        INNER JOIN estado e2 ON auditoria.id_estado_nuevo=e2.id
        ORDER BY auditoria.fechaYhora DESC";

        $datosDeLasNoticiasAuditoria= $this->conexion->ejecutarConsulta($sql);

        return $datosDeLasNoticiasAuditoria;

        

      




    }

    public function cambiarEstado($Noticia,$idEstado,$idUsuario){

        $idNoticia=$Noticia['idNoticia'];

        $sqlEstadoActual = "SELECT id_estado FROM noticia WHERE id = $idNoticia";
        $resultado = $this->conexion->ejecutarConsulta($sqlEstadoActual);
        $estadoAnterior = $resultado[0]['id_estado'];

        if($idEstado==4){
             $sql="UPDATE noticia SET id_estado=$idEstado, fechaPublicacion=NOW() WHERE id=$idNoticia";
        }else{
             $sql="UPDATE noticia SET id_estado=$idEstado WHERE id=$idNoticia";
        }

        $this->conexion->ejecutarInstruccion($sql);

        $sqlAuditoria = "INSERT INTO auditoria (id_noticia,id_usuario, id_estado_antiguo ,id_estado_nuevo) VALUES ('$idNoticia', '$idUsuario', '$estadoAnterior','$idEstado')";

        return $this->conexion->ejecutarInstruccion($sqlAuditoria);


        


    }

    public function expirarNoticias(){

        $sqlDias = "SELECT valor FROM parametros WHERE nombre = 'maxDiasPublicacion'";
        $resultado = $this->conexion->ejecutarConsulta($sqlDias);
        $dias = $resultado[0]['valor'];

        $sqlNoticias = "SELECT id FROM noticia WHERE id_estado = 4 AND DATEDIFF(NOW(), fechaPublicacion) >= $dias";
        $noticias = $this->conexion->ejecutarConsulta($sqlNoticias);

         if(!$noticias) return;

         foreach ($noticias as $valor) {
            $idNoticia=$valor['id'];
            
            $sql="UPDATE noticia SET id_estado=5 WHERE id='$idNoticia'";
            $this->conexion->ejecutarInstruccion($sql);


         }

    }

     public function guardarNoticiaEditada($datos){
       $idNoticia   = trim($datos['idNoticia']   ?? '');
$titulo      = trim($datos['titulo']      ?? '');
$descripcion = trim($datos['descripcion'] ?? '');
$estado      = trim($datos['estado']      ?? '');
      

        $directorio_fisico = __DIR__ . "/../../public/uploads/"; 
        $directorio_url = "uploads/"; 

        if(!is_dir($directorio_fisico)){
             mkdir($directorio_fisico, 0755, true);
        }

        $errores=[];

        if (empty($titulo)){
             $errores['titulo'] = "Debe ingresar el titulo";
        }else if(strlen($titulo)<10 || strlen($titulo)>100){
               $errores['titulo'] = "El titulo debe tener entre 10 y 100 caracteres";
        }
        if (empty($descripcion)){
                 $errores['descripcion']  = "Debe ingresar la descripcion";
        }else if(strlen($descripcion)<50){
                 $errores['descripcion']  = "La descripcion debe tener al menos 50 caracteres";
        }
           
        if (empty($estado)) 
            $errores['estado'] = "Debe ingresar un estado ";

       

        if(!empty($errores)){
            return $errores;
        }


        if(!empty($_FILES['imagen']['name'])){



            $file_nombre = $_FILES['imagen']['name'];
            $file_temp_nombre= $_FILES['imagen']['tmp_name'];
            $file_size = $_FILES['imagen']['size'];
            $file_extension   = strtolower(pathinfo($file_nombre, PATHINFO_EXTENSION));

            $sqlParametros="SELECT valor FROM parametros WHERE nombre='tamMax'";
            $resultadoParametro=$this->conexion->ejecutarConsulta($sqlParametros);

            $tamMax = (int)$resultadoParametro[0]['valor'];


            $extensionesPermitidas = ['jpg', 'png'];

                if (!in_array($file_extension, $extensionesPermitidas)) {
                    $errores['imagen'] = "Solo se permiten imágenes JPG o PNG";
                }

                if ($file_size > $tamMax) {
                $errores['imagen'] = "La imagen no debe superar los 2MB";
                }

                if (!empty($errores)) {
                return $errores;
                }



            $nuevo_file_name  = uniqid('img-', true) . '.' . $file_extension;

            $destinoFisicoFinal=$directorio_fisico.$nuevo_file_name;
            $destination_url = $directorio_url. $nuevo_file_name;

            if (move_uploaded_file($file_temp_nombre, $destinoFisicoFinal)) {

                $imagenAnterior = trim($datos['imagenAnterior']);
                        if(!empty($imagenAnterior)){
                            $rutaFisica = __DIR__ . "/../../public/" . $imagenAnterior;
                            if(file_exists($rutaFisica)){
                                unlink($rutaFisica); 
                            }
                         }

                     $sql = "UPDATE noticia SET titulo='$titulo', descripcion='$descripcion', imagen='$destination_url', id_estado='$estado' WHERE id=$idNoticia";
                     $this->conexion->ejecutarInstruccion($sql);
                     
                       return true;
                } else {
                    $errores['imagen'] = "Error al subir la imagen";
                }


            }else {
            
                  $sql = "UPDATE noticia SET titulo='$titulo', descripcion='$descripcion', id_estado='$estado' WHERE id='$idNoticia'";
            
               $this->conexion->ejecutarInstruccion($sql);
            
                  return true;
            }


             





    }



}

?>