<?php
// views/layouts/header.php

if(empty($_SESSION['idUsuario'])){
    header("Location: index.php?c=usuario&a=login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="app/assets/estilosdashword.css">
    <link rel="stylesheet" href="app/assets/lista.css">
        <link rel="stylesheet" href="app/assets/crearNoticia.css">
        <link rel="stylesheet" href="app/assets/historial.css">
        <link rel="stylesheet" href="app/assets/cartasNoticias.css">
       
    <title>NewsDesk</title>
</head>
<body>

<div class="sidebar">
    <div class="brand">
        <i class="bi bi-newspaper"></i> NewsDesk
    </div>

    <div class="nav-label">Noticias</div>
    <a href="index.php?c=noticia&a=lista">
        <i class="bi bi-list"></i> Lista de noticias
    </a>

    <?php if(in_array(1, array_column($datosUsuario, 'id_rol'))): ?>
        <a href="index.php?c=noticia&a=crear">
            <i class="bi bi-plus-circle"></i> Crear noticia
        </a>
        <div class="nav-label">Corrección</div>
        <a href="index.php?c=noticia&a=correccion">
            <i class="bi bi-check-circle"></i> Para corrección
        </a>
    <?php endif; ?>

    <?php if(in_array(2, array_column($datosUsuario, 'id_rol'))): ?>
        <div class="nav-label">Validación</div>
        <a href="index.php?c=noticia&a=validar">
            <i class="bi bi-check-circle"></i> Para validar
        </a>
    <?php endif; ?>

     <?php if(in_array(2, array_column($datosUsuario, 'id_rol')) || in_array(1, array_column($datosUsuario, 'id_rol'))): ?>
    <div class="nav-label">Borrador</div>
    <a href="index.php?c=noticia&a=borrador">
        <i class="bi bi-file-earmark"></i> Borradores
    </a>
    <?php endif; ?>

    <?php if(in_array(2, array_column($datosUsuario, 'id_rol')) || in_array(1, array_column($datosUsuario, 'id_rol'))): ?>

    <div class="nav-label">Historial</div>
    <a href="index.php?c=noticia&a=historial">
        <i class="bi bi-clock-history"></i> Historial
    </a>

    <?php endif; ?>

    <?php if(in_array(3, array_column($datosUsuario, 'id_rol'))): ?>
        <div class="nav-label">Admin</div>
        <a href="index.php?c=usuario&a=registro">
            <i class="bi bi-people"></i> Usuarios
        </a>
        <div class="nav-label">Configuración</div>
        <a href="index.php?c=config&a=index">
            <i class="bi bi-gear"></i> Configuración
        </a>
    <?php endif; ?>
</div>

<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Dashboard Noticias</h3>
        <form method="POST" action="index.php?c=usuario&a=logout">
            <button type="submit" class="btn btn-secondary">
                Cerrar sesión
            </button>
        </form>
    </div>