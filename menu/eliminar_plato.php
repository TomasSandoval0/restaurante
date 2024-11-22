<?php include '../db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Plato</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <h2>Eliminar Plato</h2>

    <form method="POST" action="">
        <label for="plato_id_eliminar">Seleccione el plato a eliminar:</label><br>
        <select name="plato_id_eliminar" required>
            <?php
            $platos = $conn->query("SELECT plato_id, plato_nombre FROM tb_platos");
            while ($plato = $platos->fetch()) {
                echo "<option value='{$plato['plato_id']}'>{$plato['plato_nombre']}</option>";
            }
            ?>
        </select><br>

        <button type="submit" name="eliminar_plato" onclick="return confirm('¿Estás seguro de que deseas eliminar este plato?');">Eliminar Plato</button>
    </form>

    <?php
    if (isset($_POST['eliminar_plato'])) {
        $plato_id = $_POST['plato_id_eliminar'];

        $sql = "DELETE FROM tb_platos WHERE plato_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$plato_id]);

        echo "<p>Plato eliminado correctamente.</p>";
    }
    ?>
</body>
</html>
