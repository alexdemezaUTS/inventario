<?php

require_once __DIR__ . '/../src/Validaciones.php';

$casosNombre = [
    ["Teclado", true],
    ["", false],
    ["     ", false],
    ["Mouse", true],
];

$casosCantidad = [
    ["0", true],       // Cero permitido
    ["5", true],       // Entero positivo
    ["-3", false],     // Negativo no permitido
    ["2.5", false],    // Decimal no permitido
];

$aceptadas = 0;
$rechazadas = 0;
$fallidas = 0;

$grupos = [
    'validarNombreProducto' => $casosNombre,
    'validarCantidadProducto' => $casosCantidad,
];

foreach ($grupos as $funcion => $casos) {
    echo "\nPruebas de $funcion()\n\n";

    foreach ($casos as [$entrada, $esperado]) {
        $resultado = $funcion($entrada);
        $textoEntrada = json_encode(
            $entrada,
            JSON_UNESCAPED_UNICODE
        );

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
}

echo "\nResumen de validaciones:\n";
echo "Aceptadas: $aceptadas\n";
echo "Rechazadas: $rechazadas\n";
echo "Total evaluados: "
    . (count($casosNombre) + count($casosCantidad))
    . "\n";
echo "Pruebas fallidas: $fallidas\n";

exit($fallidas > 0 ? 1 : 0);