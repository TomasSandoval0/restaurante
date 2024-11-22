<?php include '../db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Pedidos</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <h2>Registrar Pedido</h2>
    <form method="POST" action="">
        <label for="pedido_plato">Plato:</label>
        <select name="pedido_plato" required>
            <?php
            $platos = $conn->query("SELECT plato_id, plato_nombre FROM tb_platos");
            while ($plato = $platos->fetch()) {
                echo "<option value='{$plato['plato_id']}'>{$plato['plato_nombre']}</option>";
            }
            ?>
        </select><br>
        
        <label for="pedido_precio">Precio del Pedido:</label><br>
        <input type="number" name="pedido_precio" required><br>
        
        <button type="submit" name="registrar_pedido">Registrar Pedido</button>
    </form>

    <?php
    if (isset($_POST['registrar_pedido'])) {
        $plato_id = $_POST['pedido_plato'];
        $precio = $_POST['pedido_precio'];

        $sql = "INSERT INTO tb_pedidos (pedido_plato, pedido_precio) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$plato_id, $precio]);

        echo "<p>Pedido registrado correctamente.</p>";
    }
    ?>
</body>
</html>
