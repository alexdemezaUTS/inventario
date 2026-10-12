<?php
require_once __DIR__ . '/../funciones.php';

echo "<h3>Pruebas de validarNombre()</h3>";

$casosNombre = [
    ["Teclado", true],
    ["", false],       
    ["     ", false],            
    ["Mouse", true],
];

$aceptadas = 0;
$rechazadas = 0;

foreach ($casosNombre as [$entrada, $esperado]) {
    $resultado = validarNombre($entrada);
    $textoEntrada = $entrada === "" ? "'' (vacío)" : "'$entrada'";
    
    if ($resultado === true) {
        $aceptadas++;
    } else {
        $rechazadas++;
    }
    
    if ($resultado === $esperado) {
        echo "Prueba de nombre $textoEntrada pasó.<br>\n";
    } else {
        echo "Prueba de nombre $textoEntrada falló. Resultado esperado: " . ($esperado ? 'true' : 'false') . ", resultado obtenido: " . ($resultado ? 'true' : 'false') . "<br>\n";
    }
}

echo "Pruebas de validarNombre()\n";
echo "Prueba de nombre $textoEntrada pasó.\n";
echo "\nResumen de validación de nombres:\n";
echo "Aceptadas: $aceptadas\n";
echo "Rechazadas: $rechazadas\n";
echo "Total evaluados: " . ($aceptadas + $rechazadas) . "\n";