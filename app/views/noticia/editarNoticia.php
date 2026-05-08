<?php require_once __DIR__ . "/../layouts/header.php"; ?>

<div class="page-title">Editar noticia</div>
<div class="page-sub">Completá los campos requeridos o enviá a validación o borrador</div>

<div class="card-box p-4 divForm" >

    <form action="index.php?c=noticia&a=editar" method="POST" enctype="multipart/form-data" id="formulario-EditarNoticia">

        <input type="hidden" name="idNoticia" value="<?= $noticia['id'] ?? $datos['idNoticia'] ?? '' ?>">
        <input type="hidden" name="imagenAnterior" value="<?= $noticia['imagen'] ?? $datos['imagenAnterior'] ?? '' ?>">

        <div class="alert alert-info py-2">
            Solo usuarios con rol <strong>Editor</strong> pueden editar noticias.
            La publicación requiere un <strong>Validador</strong>.
        </div>

        <div id="errores-total" >
        <?php if(isset($exito)): ?>
            <div class="alert alert-success">¡Noticia editada correctamente!</div>
        <?php endif; ?>

        <?php if(isset($errores['titulo'])): ?>
            <div class="alert alert-danger"><?= $errores['titulo'] ?></div>
        <?php endif; ?>

        <?php if(isset($errores['descripcion'])): ?>
            <div class="alert alert-danger"><?= $errores['descripcion'] ?></div>
        <?php endif; ?>

        <?php if(isset($errores['estado'])): ?>
            <div class="alert alert-danger"><?= $errores['estado'] ?></div>
        <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Título *</label>
            <input type="text" class="form-control" id="inp-titulo" minlength="10" maxlength="100" name="titulo"
                   value="<?= htmlspecialchars($noticia['titulo'] ?? $datos['titulo'] ?? '') ?>"
                   placeholder="Entre 10 y 100 caracteres…"
                   oninput="cuenta('inp-titulo','c-titulo',10)">
            <div class="char-info bad" id="c-titulo">0 / 100 — mínimo 10</div>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción *</label>
            <textarea class="form-control" id="inp-desc" name="descripcion" rows="5" minlength="50"
                      placeholder="Mínimo 50 caracteres…" required
                      oninput="cuenta('inp-desc','c-desc',50)"><?= htmlspecialchars($noticia['descripcion'] ?? $datos['descripcion'] ?? '') ?></textarea>
            <div class="char-info bad" id="c-desc">0 caracteres — mínimo 50</div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Estado</label>
                <select class="form-select" required name="estado">
                    <option value="" disabled selected>Seleccione</option>
                    <option value="1" <?= ($noticia['idEstado'] ?? $datos['estado'] ?? '') == 1 ? 'selected' : '' ?>>Borrador</option>
                    <option value="2" <?= ($noticia['idEstado'] ?? $datos['estado'] ?? '') == 2 ? 'selected' : '' ?>>Lista para validación</option>
                </select>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Imagen (opcional — JPG/PNG, máx. 2 MB)</label>
            <?php $imagenMostrar = $noticia['imagen'] ?? $datos['imagenAnterior'] ?? ''; ?>
            <?php if(!empty($imagenMostrar)): ?>
                <div class="mb-2">
                    <img src="public/<?= $imagenMostrar ?>"
                         width="200" alt="imagen actual" class="img-fluid" >
                    <p class="textoSmall">Imagen actual — si subís una nueva la reemplaza</p>
                </div>
            <?php endif; ?>
            <input type="file" class="form-control" accept=".jpg,.jpeg,.png" name="imagen">
            <img id="img-prev" >
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <button class="btn-purple" type="submit" name="editarNoticia">Guardar</button>
        </div>

    </form>
</div>

<script src="/Portal-noticias/app/assets/js/validacionEditarNoticia.js"></script>

<?php require_once __DIR__ . "/../layouts/pie.php"; ?>