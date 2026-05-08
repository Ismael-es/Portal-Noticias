<?php require_once __DIR__ . "/../layouts/header.php"; ?>
 
 <div class="secciones">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Para Coreccion</h3>
    </div>
    <div class="page-sub">Solo el Editor puede modificar estas noticias</div>
    <div class="row g-3">

     <?php if(empty($correcion)){ ?>

      <div class="alert alert-info py-2">
          NO HAY NOTICIAS SUBIDAS A CORECCION
        </div>

      

    <?php }else{  ?>

      <?php foreach($correcion as $noticia){ ?>
  
      <div class="col-md-6">
        <div class="card-box p-4">
          <span class="pill pill-validacion mb-2 d-inline-block">En coreccion</span>
          <h5 class="mt-2 titulo-noticia" ><?php echo $noticia['titulo']; ?></h5>
            <?php if(!empty($noticia['imagen'])){ ?>
              <img src="public/<?php echo $noticia['imagen']; ?>" width="400" heigth="400" alt="imagen noticia" class="img-fluid mb-2">
            <?php }else{ ?>
            <div class="alert alert-info py-2">
                 SIN IMAGEN
            </div>
            <?php } ?>
          <p class="text-muted texto-descripcion" ><?php echo $noticia['descripcion']; ?></p>
          <div class="mb-3 divNombreUser">Autor: <strong class="text-dark"><?php echo $noticia['nombreUsuario']; ?>
          </strong> Fecha Creacion · <?php echo $noticia['fechaCreacion']; ?>
          </div>
          <span class="badge bg-warning text-dark badge-custom" ><?php echo $noticia['nombreEstado']; ?></span>
          <div class="d-flex gap-2">
            <form action="index.php?c=noticia&a=editar" method="post">
               <input type="hidden" name="idNoticia" value="<?php echo $noticia['id']; ?>">
              <button class="btn btn-success btn-sm" type="submit" name="editarBoton">Editar noticia</button>
            </form>
           
          </div>
        </div>
      </div>
   
    <?php } } ?>
    
    </div>
  </div>
<?php require_once __DIR__ . "/../layouts/pie.php"; ?>