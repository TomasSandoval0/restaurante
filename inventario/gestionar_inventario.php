<?php include '../db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Inventario</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <h2>Gestión de Inventario</h2>
    
    <h3>Agregar Ingrediente</h3>
    <form method="POST" action="">
        <label for="ingre_nombre">Nombre del Ingrediente:</label><br>
        <input type="text" name="ingre_nombre" required><br>
        
        <label for="ingre_cantidad">Cantidad:</label><br>
        <input type="number" name="ingre_cantidad" required><br>
        
        <button type="submit" name="agregar_ingrediente">Agregar Ingrediente</button>
    </form>

    <?php
    if (isset($_POST['agregar_ingrediente'])) {
        //TOMO LOS DATOS INGRESADOS EN EL FORM
        $nombre = $_POST['ingre_nombre'];
        $cantidad = $_POST['ingre_cantidad'];


        //CREO LA SECUENCIA SQL
        $sql = "INSERT INTO tb_ingredientes (ingre_nombre, ingre_cantidad) VALUES (?, ?)";

        //PREPARO EL SQL CON LA CONEXION
        $stmt = $conn->prepare($sql);

        //EJECUTO EL SQL ENVIANDOLE LOS DATOS (stmt = statement)
        $stmt->execute([$nombre, $cantidad]);

        echo "<p>Ingrediente agregado correctamente.</p>";
    }
    ?>




    <h3>Actualizar Cantidad de Ingrediente</h3>
    <form method="POST" action="">
        <label for="ingre_id">Seleccionar Ingrediente:</label><br>
        <select name="ingre_id" required>
            <?php
            $ingredientes = $conn->query("SELECT ingre_id, ingre_nombre FROM tb_ingredientes");
            while ($ingrediente = $ingredientes->fetch()) {
                echo "<option value='{$ingrediente['ingre_id']}'>{$ingrediente['ingre_nombre']}</option>";
            }
            ?>
        </select><br>
        
        <label for="ingre_cantidad">Nueva Cantidad:</label><br>
        <input type="number" name="ingre_cantidad" required><br>
        
        <button type="submit" name="actualizar_ingrediente">Actualizar Cantidad</button>
    </form>

    <?php
    if (isset($_POST['actualizar_ingrediente'])) {
        $id = $_POST['ingre_id'];
        $cantidad = $_POST['ingre_cantidad'];

        $sql = "UPDATE tb_ingredientes SET ingre_cantidad = ? WHERE ingre_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$cantidad, $id]);

        echo "<p>Cantidad de ingrediente actualizada correctamente.</p>";
    }
    ?>
</body>
</html>
