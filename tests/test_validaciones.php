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

$grupos = [
    ['validarNombreProducto', 'nombres', $casosNombre],
    ['validarCantidadProducto', 'cantidades', $casosCantidad],
];

$totalFallidas = 0;

foreach ($grupos as [$funcion, $tipo, $casos]) {
    $aceptadas = 0;
    $rechazadas = 0;
    $fallidas = 0;

    echo "Pruebas de $funcion()\n\n";

    foreach ($casos as [$entrada, $esperado]) {
        $resultado = $funcion($entrada);
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
            . " | $funcion($textoEntrada)"
            . " | esperado: " . var_export($esperado, true)
            . " | obtenido: " . var_export($resultado, true)
            . "\n";
    }

    echo "\nResumen de validación de $tipo:\n";
    echo "Aceptadas: $aceptadas\n";
    echo "Rechazadas: $rechazadas\n";
    echo "Total evaluados: " . count($casos) . "\n";
    echo "Pruebas fallidas: $fallidas\n\n";

    $totalFallidas += $fallidas;
}

exit($totalFallidas > 0 ? 1 : 0);