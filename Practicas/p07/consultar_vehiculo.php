
<?php
    echo "<h1>Resultado de Consulta Vehicular</h1>";
    $vehiculos = [
        'ABC1234' => [
            'Auto' => ['marca' => 'HONDA', 'modelo' => '2020', 'tipo' => 'camioneta'],
            'Propietario' => ['nombre' => 'Alfonzo Esparza', 'ciudad' => 'Puebla, Pue.', 'direccion' => 'C.U., Jardines de San Manuel']
        ],
        'XYZ5678' => [
            'Auto' => ['marca' => 'MAZDA', 'modelo' => '2019', 'tipo' => 'sedan'],
            'Propietario' => ['nombre' => 'Ma. del Consuelo Molina', 'ciudad' => 'Puebla, Pue.', 'direccion' => '97 oriente']
        ],
        'LMN3456' => [
            'Auto' => ['marca' => 'TOYOTA', 'modelo' => '2021', 'tipo' => 'hatchback'],
            'Propietario' => ['nombre' => 'Roberto Gómez', 'ciudad' => 'Cholula, Pue.', 'direccion' => 'Boulevard Forjadores']
        ],
        'QRS7890' => [
            'Auto' => ['marca' => 'FORD', 'modelo' => '2018', 'tipo' => 'sedan'],
            'Propietario' => ['nombre' => 'Ana María López', 'ciudad' => 'Atlixco, Pue.', 'direccion' => 'Av. Juárez']
        ],
        'TUV4567' => [
            'Auto' => ['marca' => 'NISSAN', 'modelo' => '2017', 'tipo' => 'camioneta'],
            'Propietario' => ['nombre' => 'Carlos Méndez', 'ciudad' => 'Puebla, Pue.', 'direccion' => 'Col. Santa María']
        ],
        'WXY2345' => [
            'Auto' => ['marca' => 'CHEVROLET', 'modelo' => '2020', 'tipo' => 'hatchback'],
            'Propietario' => ['nombre' => 'Patricia Ramírez', 'ciudad' => 'Puebla, Pue.', 'direccion' => 'Calle 10']
        ],
        'ZAB6789' => [
            'Auto' => ['marca' => 'HYUNDAI', 'modelo' => '2019', 'tipo' => 'sedan'],
            'Propietario' => ['nombre' => 'Luis Pérez', 'ciudad' => 'Cholula, Pue.', 'direccion' => 'Av. Las Torres']
        ],
        'CDE8901' => [
            'Auto' => ['marca' => 'KIA', 'modelo' => '2022', 'tipo' => 'camioneta'],
            'Propietario' => ['nombre' => 'Laura Martínez', 'ciudad' => 'Puebla, Pue.', 'direccion' => 'Calle de la 3']
        ],
        'FGH1234' => [
            'Auto' => ['marca' => 'SUBARU', 'modelo' => '2021', 'tipo' => 'hatchback'],
            'Propietario' => ['nombre' => 'Miguel González', 'ciudad' => 'Puebla, Pue.', 'direccion' => 'Avenida del Sol']
        ],
        'IJK5678' => [
            'Auto' => ['marca' => 'JEEP', 'modelo' => '2020', 'tipo' => 'camioneta'],
            'Propietario' => ['nombre' => 'Sofia Hernández', 'ciudad' => 'Atlixco, Pue.', 'direccion' => 'Calle 5 de Febrero']
        ],
        'LMN1234' => [
            'Auto' => ['marca' => 'VOLKSWAGEN', 'modelo' => '2018', 'tipo' => 'sedan'],
            'Propietario' => ['nombre' => 'Pedro Ruiz', 'ciudad' => 'Puebla, Pue.', 'direccion' => 'Avenida 14']
        ],
        'OPQ6789' => [
            'Auto' => ['marca' => 'MAZDA', 'modelo' => '2021', 'tipo' => 'hatchback'],
            'Propietario' => ['nombre' => 'Cristina García', 'ciudad' => 'Puebla, Pue.', 'direccion' => 'Calle 11']
        ],
        'RST2345' => [
            'Auto' => ['marca' => 'TOYOTA', 'modelo' => '2022', 'tipo' => 'camioneta'],
            'Propietario' => ['nombre' => 'Jorge Martínez', 'ciudad' => 'Cholula, Pue.', 'direccion' => 'Calle de las Flores']
        ],
        'UVW6789' => [
            'Auto' => ['marca' => 'NISSAN', 'modelo' => '2020', 'tipo' => 'sedan'],
            'Propietario' => ['nombre' => 'Isabel Vega', 'ciudad' => 'Puebla, Pue.', 'direccion' => 'Avenida Revolución']
        ],
        'XYZ3456' => [
            'Auto' => ['marca' => 'FORD', 'modelo' => '2021', 'tipo' => 'hatchback'],
            'Propietario' => ['nombre' => 'Antonio Soto', 'ciudad' => 'Atlixco, Pue.', 'direccion' => 'Calle Juárez']
        ],
        'YZA7890' => [
            'Auto' => ['marca' => 'CHEVROLET', 'modelo' => '2019', 'tipo' => 'sedan'],
            'Propietario' => ['nombre' => 'Gabriela Díaz', 'ciudad' => 'Puebla, Pue.', 'direccion' => 'Avenida 16']
        ],
        'BCD4567' => [
            'Auto' => ['marca' => 'HYUNDAI', 'modelo' => '2021', 'tipo' => 'hatchback'],
            'Propietario' => ['nombre' => 'Fernando López', 'ciudad' => 'Puebla, Pue.', 'direccion' => 'Calle de la 5']
        ]
    ];

    if (isset($_POST['matricula'])) {
        $matricula = $_POST['matricula'];
        if (array_key_exists($matricula, $vehiculos)) {
            echo "<h2>Detalles del Auto con Matrícula: $matricula</h2>";
            echo "<pre>";
            print_r($vehiculos[$matricula]);
            echo "</pre>";
        } else {
            echo "<p>No se encontró ningún auto con la matrícula proporcionada.</p>";
        }
    } elseif (isset($_POST['todos'])) {
        echo "<h2>Todos los Autos Registrados</h2>";
        echo "<pre>";
        print_r($vehiculos);
        echo "</pre>";
    } else {
        echo "<p>Por favor, proporcione una matrícula para consultar o seleccione la opción para mostrar todos los autos.</p>";
    }
?>

