<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejericios</title>
</head>
<body>
    <H1>Respuesta a los ejercicios de la practica</H1>
    <h2>Ejercicio 1</h2>
    <?php
        echo "<h3>Variables válidas: \$_myvar, \$_7var, \$myvar, \$var7, \$_element1</h3>";
        echo "<h3>Variables inválidas: myvar, \$house*5</h3>";
        echo "<h3>Las variables necesitan empezar con \$ seguidas por un guion bajo (_) o letra, sin caracteres especiales como *</h3>";
    ?>

    <h2>Ejericio 2</h2>
    <?php
        $a = "ManejadorSQL";  
        $b = 'MySQL';  
        $c = &$a;  // Asignación por referencia

        // Imprimir los valores de las variables con concatenación
        echo '$a: ' . $a . ' $b: ' . $b . ' $c: ' . $c . "<br>";

        $a = "PHP server";  
        $b = &$a; 

        // Imprimir los valores de las variables actualizados
        echo '$a: ' . $a . ' $b: ' . $b . ' $c: ' . $c . "<br>";
    ?>
</body>
</html>