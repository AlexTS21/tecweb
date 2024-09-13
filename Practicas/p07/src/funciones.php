<?php
    // 1. Función para comprobar si un número es múltiplo de 5 y 7
    function esMultiploDe5y7($numero) {
        return ($numero % 5 == 0 && $numero % 7 == 0);
    }

?>

// 2. Función para generar secuencias de números aleatorios
function generarNumerosAleatorios() {
    $matriz = [];
    $iteraciones = 0;
    
    do {
        $iteraciones++;
        $numeros = [rand(0, 1000), rand(0, 1000), rand(0, 1000)];
        $matriz[] = $numeros;
    } while (!($numeros[0] % 2 != 0 && $numeros[1] % 2 == 0 && $numeros[2] % 2 != 0));
        
    return [$matriz, $iteraciones];
}
