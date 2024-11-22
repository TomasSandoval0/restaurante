<?php include '../db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Plato</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <h2>Agregar Plato al Menú</h2>
    <form method="POST" action="">
        <label for="plato_nombre">Nombre del Plato:</label><br>
        <input type="text" name="plato_nombre" required><br>
        
        <label for="plato_precio">Precio:</label><br>
        <input type="number" name="plato_precio" required><br>
        
        <button type="submit" name="agregar_plato">Agregar Plato</button>
    </form>

    <?php
    if (isset($_POST['agregar_plato'])) {

        //TOMO LOS DATOS DEL FORM
        $nombre = $_POST['plato_nombre'];
        $precio = $_POST['plato_precio'];


        //CREACION DEL SQL
        $sql = "INSERT INTO tb_platos (plato_nombre, plato_precio) VALUES ('.$nombre.', '.$precio.')";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nombre, $precio]);

        echo "<p>Plato agregado correctamente.</p>";
    }
    ?>
</body>
</html>
