<?php

/**
 * Funciones y validaciones generales del sistema
 */

/**
 * Valida que el nombre tenga al menos 3 caracteres.
 */
function validarNombre(string $nombre): bool {
    return mb_strlen(trim($nombre), 'UTF-8') >= 3;
}

/**
 * Valida que la cantidad sea un número válido y mayor a 0 (no permite 0 ni números negativos).
 */
function validarCantidad(mixed $cantidad): bool {
    if (!is_numeric($cantidad)) {
        return false;
    }
    return (int) $cantidad > 0;
}