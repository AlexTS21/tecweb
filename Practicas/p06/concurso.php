<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario usando $_POST
    $nombre = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $story = htmlspecialchars($_POST['story']);
    $color = htmlspecialchars($_POST['color']);
    $featuresSeleccionadas = $_POST['features']; 
    $size = htmlspecialchars($_POST['size']);
    
    // Validar que los campos no estén vacíos
    if (!empty($nombre) && !empty($email)) {
        $output = "
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 20px;
            }
            .container {
                max-width: 800px;
                margin: 0 auto;
                background: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
            h1 {
                color: #333;
            }
            p {
                font-size: 1.1em;
                color: #555;
            }
            .error {
                color: red;
            }
        </style>
        <div class='container'>
            <h1>Información Recibida</h1>
            <p><strong>Nombre:</strong> " . $nombre . "</p>
            <p><strong>Email:</strong> " . $email . "</p>
            <p><strong>Phone:</strong> " . $phone . "</p>
            <p><strong>Story:</strong> " . $story . "</p>
            <p><strong>Color:</strong> " . $color . "</p>
            <p><strong>Has seleccionado las siguientes características:</strong></p>";
        
        foreach ($featuresSeleccionadas as $feature) {
            $output .= "<p>" . htmlspecialchars($feature) . "</p>";
        }
        
        $output .= "<p><strong>Size:</strong> " . $size . "</p>
        </div>";
        
        echo $output;
    } else {
        echo "<div class='error'>Por favor, complete todos los campos.</div>";
    }
} else {
    echo "<div class='error'>Método de solicitud no válido.</div>";
}
?>

