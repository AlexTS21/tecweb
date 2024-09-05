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
        echo 'Variables válidas: $_myvar, $_7var, $myvar, $var7, $_element1'."<br>";
        echo 'Variables inválidas: myvar, $house*5'."<br>";
        echo 'Las variables necesitan empezar con $ seguidas por un guion bajo (_) o letra, sin caracteres especiales como *'."<br>";
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
        echo 'Al acer que las vairables $b y $c referencien a $a el contenido de a se copio en las demas variabels'."<br>";
    ?>

    <h2>Ejercicio 3</h2>
    <?php
        $a = "PHP5";
        $z[] = &$a;
        $b = "5a version de PHP";
        $c = $b * 10;
        $a .= $b;
        $b *= $c;
        $z[0] = "MySQL";

        echo "Valores de las variables:<br>";
        echo "\$a = ";
        var_dump($a);
        echo "<br>\$b = ";
        var_dump($b);
        echo "<br>\$c = ";
        var_dump($c);
        echo "<br>\$z = ";
        print_r($z);

    ?>
    <h2>Ejercicio 4</h2>

    <?php
        $a = "PHP5";
        $z[] = &$a;
        $b = "5a version de PHP";
        $c = $b * 10;

        echo "Valores usando \$GLOBALS:<br>";
        echo "\$a = " . $GLOBALS['a'] . "<br>";
        echo "\$b = " . $GLOBALS['b'] . "<br>";
        echo "\$c = " . $GLOBALS['c'] . "<br>";
    ?>
<h2>Ejercicio 5</h2>
    
</body>
</html>