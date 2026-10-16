<?php

require_once __DIR__ . '/../src/validaciones.php';

$casosNombre = [
    ["Teclado", true],
    ["", false],
    ["      ", false],
    ["Mouse", true],
    ["Ab", false],
    [str_repeat("a", 51), false],
];

$casosCantidad = [
    [10, true],
    [0, true],
    [-5, false],
    ["abc", false],
    ["10", true],
    ["1.5", false],
];

$total = 0;
$aprobadas = 0;
$fallidas = 0;

echo "Pruebas de validación:\n\n";

echo "--- Validación de Nombre ---\n";
foreach ($casosNombre as [$entrada, $esperado]) {
    $total++;
    $obtenido = validarNombreProducto($entrada);
    $etiquetaEntrada = ($entrada === '' || trim((string)$entrada) === '') ? "\"$entrada\"" : $entrada;

    if ($obtenido === $esperado) {
        $aprobadas++;
        echo "$etiquetaEntrada: paso\n";
    } else {
        $fallidas++;
        echo "$etiquetaEntrada: no paso (falló)\n";
    }
}

echo "\n--- Validación de Cantidad ---\n";
foreach ($casosCantidad as [$entrada, $esperado]) {
    $total++;
    $obtenido = validarCantidadProducto($entrada);
    $etiquetaEntrada = is_string($entrada) ? "\"$entrada\"" : (string)$entrada;

    if ($obtenido === $esperado) {
        $aprobadas++;
        echo "$etiquetaEntrada: paso\n";
    } else {
        $fallidas++;
        echo "$etiquetaEntrada: no paso (falló)\n";
    }
}

echo "\nPruebas realizadas: $total | Aprobadas: $aprobadas | Fallidas: $fallidas\n";

if ($fallidas > 0) {
    exit(1);
}