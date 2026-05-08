
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login y Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="app/assets/login.css">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4 carta-login">

        <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
                <button class="nav-link active">Login</button>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active">

                <div id="errores-total" >
                <?php if(isset($errores)):
                    foreach($errores as $mensaje): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($mensaje) ?></div>
                <?php endforeach; ?>
                <?php endif; ?>
                </div>

               
                

                <form method="POST" action="index.php?c=usuario&a=login" id="formulario-login">

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="mail" required class="form-control"
                               value="<?= htmlspecialchars($datos['mail'] ?? '') ?>">
                    </div>

                    <div class="mb-3">
                        <label>Contraseña</label>
                        <input type="password" name="contraseña" required class="form-control">
                    </div>

                    <button class="btn btn-success" name="iniciarSesion" type="submit">Entrar</button>
                    <div class="text-center mt-3">
                        <a href="index.php?c=usuario&a=recuperar" class="link-olvidar">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/Portal-noticias/app/assets/js/validaciones.js"></script>
</body>
</html>