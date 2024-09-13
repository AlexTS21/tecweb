<?php
    echo "<h1>Resultado de Edad y Sexo</h1>";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $edad = intval($_POST['edad']);
        $sexo = $_POST['sexo'];

        if ($sexo == 'femenino' && $edad >= 18 && $edad <= 35) {
            echo "<p>Bienvenida, usted está en el rango de edad permitido.</p>";
        } else {
            echo "<p>Error: Usted no cumple con los requisitos de edad o sexo.</p>";
        }
    } else {
        echo "<p>Por favor, envíe el formulario.</p>";
    }
?>

