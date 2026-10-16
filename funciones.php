<?php

require_once __DIR__ . '/src/validaciones.php';

/** Valida nombres de entre 3 y 50 caracteres. */
function validarNombre(string $nombre): bool
{
    return validarNombreProducto($nombre);
}

/** Valida cantidades enteras iguales o mayores que cero. */
function validarCantidad(mixed $cantidad): bool
{
    return validarCantidadProducto($cantidad);
}