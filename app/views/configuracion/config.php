<?php require_once  __DIR__ . "/../layouts/header.php"; ?>

<div class="secciones">
  <div class="page-title">Configuración</div>
  <div class="page-sub">Parámetros globales del sistema</div>

  <div class="card-box p-4 config">
    
   
    <form method="post" action="index.php?c=config&a=guardar" id="formulario-configuracion">

     
      <?php if(isset($exito)): ?>
        <div class="alert alert-success">
          Configuración guardada correctamente
        </div>
      <?php endif; ?>


      <div id="errores-total">
      <?php if(!empty($errores)): ?>
        
        <?php if(isset($errores['dias'])): ?>
          <div class="alert alert-danger">
            <?php echo $errores['dias']; ?>
          </div>
        <?php endif; ?>

        <?php if(isset($errores['config'])): ?>
          <div class="alert alert-danger">
            <?php echo $errores['config']; ?>
          </div>
        <?php endif; ?>

      <?php endif; ?>
      </div>

    
      <div class="mb-3">
        <label class="form-label">
          Días hasta expiración de una noticia publicada
        </label>

        <input type="number"
          class="form-control"
          name="dias"
          style="max-width:140px"
          required
          min="1"
          value="<?php 
            echo $parametros[0]['valor']  ?? $datos['dias'] ?? ''; 
          ?>">
        
        <div class="expirar-noticia">
          Luego de este período la noticia pasa a "Expirada" automáticamente.
        </div>
      </div>

    
      <div class="mb-3">
        <label class="form-label">
          Tamaño máximo de imagen (MB)
        </label>

        <input type="number"
          class="form-control" name="tamaño" style="max-width:140px"
          required
          value="<?php 
            echo isset($parametros[1]['valor']) ? $parametros[1]['valor'] / 1048576 : ($datos['tamaño'] ?? '');
          ?>">
      </div>

      <button class="btn-purple" name="guardar" type="submit">
        Guardar cambios
      </button>

    </form>
  </div>
</div>
<script src="/Portal-noticias/app/assets/js/validacionConfig.js"></script>

  <?php require_once  __DIR__ . "/../layouts/pie.php"; ?>