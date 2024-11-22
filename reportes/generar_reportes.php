<?php include '../db.php'; ?> <!-- Incluye el archivo de conexión a la base de datos -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar Reportes</title>
    <link rel="stylesheet" href="../css/estilo.css"> <!-- Vincula el archivo de estilos CSS -->
</head>
<body>
    <h2>Reportes del Restaurante</h2>

    <!-- Reporte de Ventas -->
    <h3>Reporte de Ventas</h3>
    <?php

    
    // Ejecuta una consulta para obtener la suma total de los precios de los pedidos
    $ventas = $conn->query("SELECT SUM(pedido_precio) as total_ventas FROM tb_pedidos");


    // Recupera el resultado de la consulta como una fila
    $resultado = $ventas->fetch();


    // Muestra el total de ventas formateado en dos decimales
    echo "<p>Total de Ventas: $" . number_format($resultado['total_ventas'], 2) . "</p>";
    ?>

    <!-- Inventario de Ingredientes -->
    <h3>Inventario de Ingredientes</h3>
    <table border="1" cellpadding="10">
        <tr>
            <th>Ingrediente</th>
            <th>Cantidad</th>
        </tr>
        <?php
        // Ejecuta una consulta para obtener el nombre y la cantidad de cada ingrediente
        $ingredientes = $conn->query("SELECT ingre_nombre, ingre_cantidad FROM tb_ingredientes");


        // Recorre cada fila de resultado para mostrar el inventario en la tabla
        while ($ingrediente = $ingredientes->fetch()) {
            echo "<tr>
                    <td>{$ingrediente['ingre_nombre']}</td>
                    <td>{$ingrediente['ingre_cantidad']}</td>
                  </tr>";
        }
        ?>
    </table>

    <!-- Historial de Pedidos -->
    <h3>Historial de Pedidos</h3>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID Pedido</th>
            <th>Plato</th>
            <th>Precio</th>
        </tr>
        <?php
        // Ejecuta una consulta para obtener el historial de pedidos con el nombre del plato y su precio
        $pedidos = $conn->query("SELECT p.pedido_id, pl.plato_nombre, p.pedido_precio 
                                 FROM tb_pedidos p 
                                 JOIN tb_platos pl ON p.pedido_plato = pl.plato_id");


        // Recorre cada pedido y muestra el ID del pedido, el nombre del plato y el precio
        while ($pedido = $pedidos->fetch()) {
            echo "<tr>
                    <td>{$pedido['pedido_id']}</td>
                    <td>{$pedido['plato_nombre']}</td>
                    <td>$" . number_format($pedido['pedido_precio'], 2) . "</td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>