
<?php require_once __DIR__ . "/../layouts/header.php"; ?>

  <div class="secciones">
  <div class="page-title">Historial de auditoría</div>
  <div class="page-sub">Trazabilidad completa de cambios de estado</div>


  <div class="row g-4 align-items-start">


     <?php foreach($datosHistorial as $datosAuditoria): ?>
    <div class="col-md-6 ">
      <div class="card-box p-4 " >

       
        <div class="d-flex justify-content-between align-items-start mb-3 flex-wrap gap-2">
          <div>
            <h5 class="mb-1"><?php echo $datosAuditoria[0]['tituloNoticia']; ?></h5>
            <small class="text-muted"><?php echo $datosAuditoria[0]['nombreUsuario']; ?></small>
          </div>
          <span class="pill pill-publicada"><?php echo $datosAuditoria[0]['estadoNuevo']; ?></span>
        </div>
        <hr>
        <div class="tl">

          <?php foreach($datosAuditoria as $dato): ?>

          <div class="tl-item">
            <div class="tl-dot"></div>
            <div><strong class="texto-estado">Noticia en estado <?php echo $dato['estadoNuevo']; ?></strong></div>
            <div class="fyh"><?php echo $dato['fechaYhora'] ?> <strong><?php echo $dato['nombreUsuario']; ?></strong></div>
            <div class="mt-1">
              <span class="pill pill-validacion" ><?php echo $dato['estadoAnterior']; ?></span>
              → <span class="pill pill-publicada"><?php echo $dato['estadoNuevo']; ?></span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      </div>
    </div>
    <?php endforeach; ?>
    
   </div>


  </div>
 
  <?php require_once __DIR__ . "/../layouts/pie.php"; ?>