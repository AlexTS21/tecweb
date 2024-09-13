<?php
    include 'src/funciones.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Practica 7</title>
</head>
<body>
     <!-- Comprobar si un número es múltiplo de 5 y 7 -->
     <h2>1. Múltiplo de 5 y 7</h2>
    <h3>Agrega tu numero en la url: </h3>
    <?php
    if (isset($_GET['numero'])) {
        $numero = intval($_GET['numero']);
        if (esMultiploDe5y7($numero)) {
            echo "<p>$numero es múltiplo de 5 y 7.</p>";
        } else {
            echo "<p>$numero no es múltiplo de 5 y 7.</p>";
        }
    }
    ?>

     <!-- 2.Generar numeros aletorios -->
     <h1>Generación de Números Aleatorios</h1>
    <?php
        list($matriz, $iteraciones) = generarNumerosAleatorios();
        $cantidadNumeros = 0;
        
        echo "<table border='1'>";
        foreach ($matriz as $fila) {
            echo "<tr>";
            foreach ($fila as $numero) {
                echo "<td>$numero</td>";
                $cantidadNumeros++;
            }
            echo "</tr>";
        }
        echo "</table>";
        
        echo "<p>$cantidadNumeros números obtenidos en $iteraciones iteraciones.</p>";
    ?>

     <!-- 3.Divisor aletorio-->
     <h1>Primer divisor aletorio</h1>
    <?php
    if (isset($_GET['divisor'])) {
        $divisor = intval($_GET['divisor']);
        
        // Usando while
        $numeroWhile = primerMultiploWhile($divisor);
        echo "<p>Usando while: $numeroWhile es múltiplo de $divisor.</p>";
        
        // Usando do-while
        $numeroDoWhile = primerMultiploDoWhile($divisor);
        echo "<p>Usando do-while: $numeroDoWhile es múltiplo de $divisor.</p>";
        
    } else {
        echo "Por favor, proporciona un divisor en la URL.";
    }
    ?>

</body>
</html>