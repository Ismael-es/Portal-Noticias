<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="app/assets/recuperar.css">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4 recuperar-card" >

        <h5 class="mb-3">Nueva contraseña</h5>

        <?php if(isset($exito)): ?>
            <div class="alert alert-success">
                Contraseña actualizada correctamente
            </div>

            <a href="index.php?c=usuario&a=login" class="btn btn-success w-100">
                Ir al login
            </a>

        <?php else: ?>

            <div id="errores-total" >
            <?php if(isset($errores)): ?>
                <div class="alert alert-danger">
                    <?= $errores ?>
                </div>
            <?php endif; ?>
            </div>

            <form method="POST" action="index.php?c=usuario&a=guardarContraseña" id="formulario-contraseña">

                <div class="mb-3">
                    <label>Nueva contraseña</label>
                    <input type="password" name="password" class="form-control"  pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$" minlength="8" required>
                </div>

                <button class="btn btn-success w-100" name="guardarContraseña" type="submit">Guardar contraseña</button>
                <div class="text-center mt-3">
                <a href="index.php?c=usuario&a=login">
                    Volver al login
                </a>
                </div>

            </form>

        <?php endif; ?>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/Portal-noticias/app/assets/js/validacionNuevaContraseña.js"></script>
</body>
</html>