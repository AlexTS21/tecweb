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
        echo "Nombre: " . $nombre . "<br>";
        echo "Email: " . $email . "<br>";
        echo "Phone: " . $phone . "<br>";
        echo "Story: " . $story . "<br>";
        echo "Color: " . $color . "<br>";
        echo "Has seleccionado las siguientes características:<br>";
        foreach ($featuresSeleccionadas as $feature) {
            echo htmlspecialchars($feature) . "<br>";
        }
        echo "Size: " . $size . "<br>";
    } else {
        echo "Por favor, complete todos los campos.";
    }
} else {
    echo "Método de solicitud no válido.";
}
?>
