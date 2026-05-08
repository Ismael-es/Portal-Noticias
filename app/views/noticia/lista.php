<?php require_once __DIR__ . "/../layouts/header.php"; ?>

<div class="secciones">

    <!-- Tabla -->
    <div class="card p-3 shadow-sm">
        <table class="table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Estado</th>
                    <th>Autor</th>
                    <th>Fecha creación</th>
                    <th>Fecha publicación</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($publicadas)): ?>
                    <tr>
                        <td colspan="7">
                            <div class="alert alert-info py-2">
                                NO HAY NOTICIAS PUBLICADAS
                            </div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach($publicadas as $noticia): ?>
                        <tr>
                            <td><?= $noticia['titulo'] ?></td>
                            <td><?= $noticia['descripcion'] ?></td>
                            <td>
                                <?php if(!empty($noticia['imagen'])): ?>
                                    <img src="public/<?= $noticia['imagen'] ?>" alt="Imagen noticia" class="img-thumbnail">
                                <?php else: ?>
                                    Sin imagen
                                <?php endif; ?>
                            </td>
                            <td><span class="badge bg-success"><?= $noticia['nombreEstado'] ?></span></td>
                            <td><?= $noticia['nombreUsuario'] ?></td>
                            <td><?= $noticia['fechaCreacion'] ?></td>
                            <td><?= $noticia['fechaPublicacion'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . "/../layouts/pie.php"; ?>