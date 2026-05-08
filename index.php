<?php
session_start();

// Cargo los controladores necesarios
require_once "app/controllers/NoticiaController.php";
require_once "app/controllers/UsuarioController.php";
require_once "app/controllers/ConfigController.php";

// Como PHP puro no tiene rutas, hago un pequeño enrutador manual
// para cargar el controlador y la acción correspondiente

// Traigo los parámetros de la URL, con valores por defecto
// Si se inicia la página sin parámetros, carga NoticiaController y el método login()
$controlador = $_GET['c'] ?? 'noticia';
$accion      = $_GET['a'] ?? 'login';

// Este mapa relaciona los nombres de la URL con sus clases correspondientes
$controladoresDisponibles = [
    'noticia' => NoticiaController::class,
    'usuario' => UsuarioController::class,
    'config'  => ConfigController::class,
];



// Instancio el controlador correspondiente
// Ej: si controlador=usuario, se crea un objeto UsuarioController
$controladorInstanciado = new $controladoresDisponibles[$controlador]();




// Llamo al método correspondiente
// Ej: si accion=login, ejecuta $controladorInstanciado->login()
$controladorInstanciado->$accion();
?>