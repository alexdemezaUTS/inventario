<?php

require_once __DIR__ . '/../src/validaciones.php';

$casos = [
    ["Teclado", true],
    ["", false],
    ["  ", false],
    ["Mouse", true],

];

foreach ($casos as [$entrada, $esperado]) {
    $obtenido = validarNombreProducto($entrada);
    if ($obtenido === $esperado) {
        echo "PASS\n";
    } else {
        echo "FAIL\n";
    }
}