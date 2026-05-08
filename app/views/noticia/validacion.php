<?php require_once  __DIR__ . "/../layouts/header.php"; ?>

    <div class="secciones">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Para Validar</h3>
    </div>
    <div class="page-sub">Solo el Validador puede publicar estas noticias</div>
    <div class="row g-3">

     <?php if(empty($validar)){ ?>

      <div class="alert alert-info py-2">
          NO HAY NOTICIAS SUBIDAS A VALIDACION
        </div>

      

    <?php }else{  ?>

      <?php foreach($validar as $noticia){ ?>
      <div class="col-md-6">
        <div class="card-box p-4">
          <span class="pill pill-validacion mb-2 d-inline-block">En borrador</span>
          <h5 class="mt-2 titulo-noticia" ><?php echo $noticia['titulo']; ?></h5>
            <?php if(!empty($noticia['imagen'])){ ?>
              <img src="public/<?php echo $noticia['imagen']; ?>" alt="imagen noticia" width="400" heigth="400" class="img-fluid mb-2">
            <?php }else{ ?>

             <div class="alert alert-info py-2">
                   SIN IMAGEN
                </div>


            <?php } ?>
          <p class="text-muted texto-descripcion"><?php echo $noticia['descripcion']; ?></p>
          <div class="mb-3 divNombreUser">Autor: <strong class="text-dark"><?php echo $noticia['nombreUsuario']; ?>
          </strong> Fecha Creacion · <?php echo $noticia['fechaCreacion']; ?>
          </div>
          <span class="badge bg-warning text-dark badge-custom"><?php echo $noticia['nombreEstado']; ?></span>
          <div class="d-flex gap-2">
            <form action="index.php?c=noticia&a=cambiarEstado" method="post">
                  <input type="hidden" name="idNoticia" value="<?php echo $noticia['id']; ?>">
                  <?php 
                        $tituloRepetido = false;

                        foreach($publicadas as $publicada){
                            if(trim(strtolower($publicada['titulo'])) == trim(strtolower($noticia['titulo']))){
                                $tituloRepetido = true;
                                break;
                            }
                        }
                  ?>
              <?php if($noticia['idCreador'] == $_SESSION['idUsuario']): ?>
                <!-- Si es el creador, los botones abren el modal -->
                  <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalNoPermitido<?php echo $noticia['id']; ?>">Publicar</button>
                  <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalNoPermitido<?php echo $noticia['id']; ?>" >Para corrección</button>
              <?php else: ?>
                  <?php if($tituloRepetido): ?>
                     <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalNoPermitido<?php echo $noticia['id']; ?>">Publicar</button>
                    
                  <?php else: ?>

                     <button class="btn btn-success btn-sm" type="submit" name="publicarBoton">Publicar</button>

                  <?php endif; ?>
                <!-- Si NO es el creador, envían el formulario normal -->
                <button class="btn btn-outline-warning btn-sm" type="submit" name="coreccionBoton">Para corrección</button>
            <?php endif; ?>
             
            </form>

              <div class="modal fade" id="modalNoPermitido<?php echo $noticia['id']; ?>" tabindex="-1"  data-bs-backdrop="static">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title">Acción no permitida</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">
                              <div class="alert mb-0 
                                  <?php echo $tituloRepetido ? 'alert-danger' : 'alert-warning'; ?>">

                                  <?php if( $tituloRepetido && $noticia['idCreador'] == $_SESSION['idUsuario']): ?>
                                        No podés validar tu propia noticia y además el título ya existe.
                                  <?php elseif($tituloRepetido): ?>
                                          el título ya existe.
                                  <?php else: ?>
                                         No podés validar tu propia noticia.
                                  <?php endif; ?>

                                </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                          </div>
                      </div>
                  </div>
              </div>
           
          </div>
          </div>
      </div>
      <?php } } ?>
    </div>
  </div>


<?php require_once __DIR__ . "/../layouts/pie.php"; ?>