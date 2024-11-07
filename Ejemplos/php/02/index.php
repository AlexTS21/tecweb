<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once __DIR__.'/Menu.php';

        $menu = new Menu;
        $menu->cargar_opcion('https://www.facebook.com/login/?next=https%3A%2F%2Fwww.facebook.com%2F%3Flocale%3Des_LA', 'FB');
        $menu->cargar_opcion('https://www.instagram.com/?hl=es', 'IG');
        $menu->cargar_opcion('https://x.com/?lang=es&mx=2', 'TW');

        $menu->mostrar();
    ?>
</body>
</html>