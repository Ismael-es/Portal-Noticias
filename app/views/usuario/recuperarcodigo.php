<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingresar código</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="app/assets/recuperar.css">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4 recuperar-card" >

        <h5 class="mb-3">Ingresar código</h5>

        <div id="errores-total" >
        <?php if(isset($errores)): ?>
            <div class="alert alert-danger">
                <?= $errores ?>
            </div>
        <?php endif; ?>
        </div>

        <form method="POST" action="index.php?c=usuario&a=validarCodigo" id="formulario-codigo">
           
            <div class="mb-3">
                <label>Código</label>
                <input type="text" name="codigo" class="form-control" pattern="[0-9]+" required maxlength="6">
            </div>

            <button class="btn btn-success w-100" name="enviarCodigo" type="submit">Validar código</button>
             <div class="text-center mt-3">
                <a href="index.php?c=usuario&a=login">
                    Volver al login
                </a>
                </div>

        </form>

    </div>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/Portal-noticias/app/assets/js/validacionCodigo.js"></script>
</html>