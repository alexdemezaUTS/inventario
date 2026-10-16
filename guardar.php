<?php

require_once __DIR__ . '/src/validaciones.php';
require_once __DIR__ . '/config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$nombre = $_POST['nombre'] ?? '';
$cantidad = $_POST['cantidad'] ?? '';

if ($nombre === '' || $cantidad === '') {
    header('Location: index.php?estado=incompleto');
    exit;
}
if (!validarNombreProducto($nombre)) {
    header('Location: index.php?estado=nombre_invalido');
    exit;
}
$nombre = trim($nombre);

if (!validarCantidadProducto($cantidad)) {
    header('Location: index.php?estado=cantidad_invalida');
    exit;
}

$sentencia = $conexion->prepare(
    'INSERT INTO productos (nombre, cantidad)
     VALUES (:nombre, :cantidad)'
);

$sentencia->execute([
    'nombre' => $nombre,
    'cantidad' => (int) $cantidad
]);

header('Location: index.php?estado=guardado');
exit;