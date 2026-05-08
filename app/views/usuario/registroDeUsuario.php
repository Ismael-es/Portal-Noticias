<?php require_once  __DIR__ . "/../layouts/header.php"; ?>
<div class="container d-flex justify-content-center align-items-center vh-100">
     <div class="card shadow p-4" style="width: 400px;">
        <div class="tab-content">

         <!-- REGISTRO -->
         
<div class="tab-pane fade show active" id="registro">


    <?php if(isset($exito)): ?>
        <div class="alert alert-success" role="alert">
            Usuario registrado correctamente
        </div>
    <?php endif; ?>

    <div id="errores-total" >
    <?php if(!empty($errores)): ?>

        <?php if(isset($errores['nombre'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errores['nombre']; ?>
            </div>
        <?php endif; ?>

        <?php if(isset($errores['mail'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errores['mail']; ?>
            </div>
        <?php endif; ?>

        <?php if(isset($errores['contraseña'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errores['contraseña']; ?>
            </div>
        <?php endif; ?>

        <?php if(isset($errores['roles'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errores['roles']; ?>
            </div>
        <?php endif; ?>

    <?php endif; ?>
    </div>

   
    <form action="index.php?c=usuario&a=registro" method="POST" id="formulario-registro">

        <div class="mb-3">
            <label>Nombre y apellido</label>
            <input 
                type="text" 
                name="nombreYape" 
                value="<?php echo $datos['nombreYape'] ?? ''; ?>" 
                class="form-control"
                pattern="^[A-Za-zÀ-ÿÑñ]+(?:\s[A-Za-zÀ-ÿÑñ]+)*$"
                minlength="2"
                required
            >
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input 
                type="email" 
                name="mail" 
                value="<?php echo $datos['mail'] ?? ''; ?>" 
                class="form-control"
                pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                required
            >
        </div>

        <div class="mb-3">
            <label>Contraseña</label>
            <input type="password" name="contraseña" class="form-control"  pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$" minlength="8" required>
        </div>

        <div class="mb-3">
            <label>Seleccione el rol (puede elegir varios)</label>
            <select name="roles[]" required class="form-select" multiple>

                <option value="1"
                    <?php echo (isset($datos['roles']) && in_array(1, $datos['roles'])) ? 'selected' : ''; ?>>
                    Editor
                </option>

                <option value="2"
                    <?php echo (isset($datos['roles']) && in_array(2, $datos['roles'])) ? 'selected' : ''; ?>>
                    Validador
                </option>

            </select>
            <small class="text-muted">Podés seleccionar varios con Ctrl</small>
        </div>

        <button class="btn btn-success" name="enviarRegistro" type="submit">
            Registrar usuario
        </button>

    </form>

  

</div>
           
        </div>
    </div>
</div>

<script src="/Portal-noticias/app/assets/js/validacionRegistroUsuario.js"></script>

<?php require_once  __DIR__ . "/../layouts/pie.php"; ?>