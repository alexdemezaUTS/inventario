<?php
require_once __DIR__ . '/../funciones.php';

echo "Pruebas de validarNombre()\n\n";

$casosNombre = [
    ["Teclado", true],
    ["", false],
    ["     ", false],
    ["Mouse", true],
];

$aceptadas = 0;
$rechazadas = 0;
$fallidas = 0;

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

echo "\nResumen de validación de nombres:\n";
echo "Aceptadas: $aceptadas\n";
echo "Rechazadas: $rechazadas\n";
echo "Total evaluados: " . count($casosNombre) . "\n";
echo "Pruebas fallidas: $fallidas\n";

exit($fallidas > 0 ? 1 : 0);