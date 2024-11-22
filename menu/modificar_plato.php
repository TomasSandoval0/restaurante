<?php include '../db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Plato</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <h2>Modificar Plato</h2>

    <form method="POST" action="">
        <label for="plato_id">Seleccione el plato a modificar:</label><br>
        <select name="plato_id" required>
            <?php
            $platos = $conn->query("SELECT plato_id, plato_nombre FROM tb_platos");
            while ($plato = $platos->fetch()) {
                echo "<option value='{$plato['plato_id']}'>{$plato['plato_nombre']}</option>";
            }
            ?>
        </select><br>

        <button type="submit" name="seleccionar_plato">Seleccionar</button>
    </form>

    <?php
    if (isset($_POST['seleccionar_plato'])) {
        $plato_id = $_POST['plato_id'];
        $plato = $conn->query("SELECT * FROM tb_platos WHERE plato_id = $plato_id")->fetch();

        echo "
        <form method='POST' action=''>
            <input type='hidden' name='plato_id' value='{$plato['plato_id']}'>
            <label for='plato_nombre'>Nombre del Plato:</label><br>
            <input type='text' name='plato_nombre' value='{$plato['plato_nombre']}' required><br>
            
            <label for='plato_precio'>Precio:</label><br>
            <input type='number' name='plato_precio' value='{$plato['plato_precio']}' required><br>
            
            <button type='submit' name='modificar_plato'>Guardar Cambios</button>
        </form>";
    }

    if (isset($_POST['modificar_plato'])) {
        $plato_id = $_POST['plato_id'];
        $nombre = $_POST['plato_nombre'];
        $precio = $_POST['plato_precio'];

        $sql = "UPDATE tb_platos SET plato_nombre = ?, plato_precio = ? WHERE plato_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nombre, $precio, $plato_id]);

        echo "<p>Plato modificado correctamente.</p>";
    }
    ?>
</body>
</html>
