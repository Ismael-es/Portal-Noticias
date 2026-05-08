

<?php require_once __DIR__ . "/../layouts/header.php"; ?>

<div class="page-title">Crear noticia</div>
<div class="page-sub">Completá los campos requeridos y guardá o enviá a validación</div>

<div class="card-box p-4 divForm" >

    <form action="index.php?c=noticia&a=crear" method="POST" enctype="multipart/form-data" id="formulario-CrearNoticia">

        <div class="alert alert-info py-2">
            Solo usuarios con rol <strong>Editor</strong> pueden crear noticias.
            La publicación requiere un <strong>Validador</strong>.
        </div>

        <div id="errores-total" >
        <?php if(isset($exito)): ?>
            <div class="alert alert-success">¡Noticia creada correctamente!</div>
        <?php endif; ?>

        <?php if(isset($errores['titulo'])): ?>
            <div class="alert alert-danger"><?= $errores['titulo'] ?></div>
        <?php endif; ?>

        <?php if(isset($errores['descripcion'])): ?>
            <div class="alert alert-danger"><?= $errores['descripcion'] ?></div>
        <?php endif; ?>

        <?php if(isset($errores['estadoInicial'])): ?>
            <div class="alert alert-danger"><?= $errores['estadoInicial'] ?></div>
        <?php endif; ?>

        <?php if(isset($errores['autorNoticia'])): ?>
            <div class="alert alert-danger"><?= $errores['autorNoticia'] ?></div>
        <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Título *</label>
            <input type="text" class="form-control" id="inp-titulo" name="titulo"
                   value="<?= htmlspecialchars($datos['titulo'] ?? '') ?>"
                   placeholder="Entre 10 y 100 caracteres…"
                   minlength="10" maxlength="100" required>
            <div class="char-info bad" id="c-titulo">0 / 100 — mínimo 10</div>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción *</label>
            <textarea class="form-control" id="inp-desc" name="descripcion"
                      placeholder="Mínimo 50 caracteres…"
                      minlength="50" required><?= htmlspecialchars($datos['descripcion'] ?? '') ?></textarea>
            <div class="char-info bad" id="c-desc">0 caracteres — mínimo 50</div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Autor (editor) *</label>
                <select class="form-select" required name="autorNoticia">
                    <option value="" disabled selected>Seleccione</option>
                    <option value="<?= $_SESSION['idUsuario'] ?>">
                        <?= $datosUsuario[0]['nombreYapellido'] ?>
                    </option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Estado inicial</label>
                <select class="form-select" name="estadoInicial" required>
                    <option value="" disabled selected>Seleccione</option>
                    <option value="1" <?= ($datos['estadoInicial'] ?? '') == 1 ? 'selected' : '' ?>>Borrador</option>
                </select>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Imagen (opcional — JPG/PNG, máx. 2 MB)</label>
            <input type="file" class="form-control" accept=".jpg,.jpeg,.png" name="imagen">
            <img id="img-prev">
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <button name="enviarNoticia" class="btn-purple" type="submit">Guardar borrador</button>
        </div>

    </form>
</div>
<script src="/Portal-noticias/app/assets/js/validacionCrearNoticia.js"></script>

<?php require_once __DIR__ . "/../layouts/pie.php"; ?>
