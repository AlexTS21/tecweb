<?php
    // 1. Función para comprobar si un número es múltiplo de 5 y 7
    function esMultiploDe5y7($numero) {
        return ($numero % 5 == 0 && $numero % 7 == 0);
    }


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

//3. Funciones para gnerar el primer multiplo aletorio

function primerMultiploWhile($divisor) {
    do {
        $numero = rand(1, 1000);
    } while ($numero % $divisor !== 0);
    return $numero;
}

function primerMultiploDoWhile($divisor) {
    $numero = rand(1, 1000);
    while ($numero % $divisor !== 0) {
        $numero = rand(1, 1000);
    }
    return $numero;
}

//4. Funcion para generar la tabla de assci
function generarArregloLetras() {
    $arreglo = [];
    for ($i = 97; $i <= 122; $i++) {
        $arreglo[$i] = chr($i);
    }
    return $arreglo;
}


?>
