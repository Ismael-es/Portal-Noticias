<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="app/assets/recuperar.css">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4 recuperar-card" >

        <h5 class="mb-3">Recuperar contraseña</h5>

        
        <?php if(isset($exito)): ?>
            <div class="alert alert-success">
                Si el email existe te enviaremos las instrucciones.
            </div>
        <?php endif; ?>

        <div id="errores-total" >
        <?php if(isset($errores)): ?>
            <div class="alert alert-danger"><?= $errores ?></div>
        <?php endif; ?>
        </div>

        <form method="POST" action="index.php?c=usuario&a=recuperar" id="formulario-recuperar">
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="mail" required class="form-control"
                       value="<?= htmlspecialchars($datos['mail'] ?? '') ?>">
            </div>
            <button class="btn btn-success w-100" name="enviarRecuperacion" type="submit">Enviar instrucciones</button>
            <div class="text-center mt-3">
                <a href="index.php?c=usuario&a=login">
                    Volver al login
                </a>
            </div>
        </form>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/Portal-noticias/app/assets/js/validacionRecuperar.js"></script>
</body>
</html>