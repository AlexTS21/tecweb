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
</body>
</html>