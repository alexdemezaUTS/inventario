<?php

require_once __DIR__ . '/../funciones.php';
require_once __DIR__ . '/../src/Validaciones.php';

$aceptadas = 0;
$rechazadas = 0;
$fallidas = 0;

// Pruebas de nombre
echo "Pruebas de validarNombre()\n\n";

$casosNombre = [
    ["Teclado", true],
    ["", false],
    ["     ", false],
    ["Mouse", true],
];

foreach ($casosNombre as [$entrada, $esperado]) {
    $resultado = validarNombre($entrada);
    $textoEntrada = json_encode($entrada, JSON_UNESCAPED_UNICODE);

    if ($resultado === true) {
        $aceptadas++;
    } else {
        $rechazadas++;
    }

    $paso = $resultado === $esperado;

    if (!$paso) {
        $fallidas++;
    }

    echo ($paso ? "PASS" : "FAIL")
        . " | validarNombre($textoEntrada)"
        . " | esperado: " . var_export($esperado, true)
        . " | obtenido: " . var_export($resultado, true)
        . "\n";
}

// Pruebas de cantidad
echo "\nPruebas de validarCantidadProducto()\n\n";

$casosCantidad = [
    ["5", true],       // Entero positivo
    ["-3", false],     // Número negativo
    ["2.5", false],    // Número decimal
    ["abc", false],    // Texto
];

foreach ($casosCantidad as [$entrada, $esperado]) {
    $resultado = validarCantidadProducto($entrada);
    $textoEntrada = json_encode($entrada, JSON_UNESCAPED_UNICODE);

    if ($resultado === true) {
        $aceptadas++;
    } else {
        $rechazadas++;
    }

    $paso = $resultado === $esperado;

    if (!$paso) {
        $fallidas++;
    }

    echo ($paso ? "PASS" : "FAIL")
        . " | validarCantidadProducto($textoEntrada)"
        . " | esperado: " . var_export($esperado, true)
        . " | obtenido: " . var_export($resultado, true)
        . "\n";
}

// Resumen general
echo "\nResumen de validación de nombres y cantidades:\n";
echo "Aceptadas: $aceptadas\n";
echo "Rechazadas: $rechazadas\n";
echo "Total evaluados: "
    . (count($casosNombre) + count($casosCantidad))
    . "\n";
echo "Pruebas fallidas: $fallidas\n";

exit($fallidas > 0 ? 1 : 0);