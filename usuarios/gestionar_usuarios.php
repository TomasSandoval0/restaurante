<?php include '../db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Usuarios</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <h2>Gestión de Usuarios</h2>

    <h3>Agregar Usuario</h3>
    <form method="POST" action="">
        <label for="usuario_nombre">Nombre del Usuario:</label><br>
        <input type="text" name="usuario_nombre" required><br>

        <label for="usuario_email">Email:</label><br>
        <input type="email" name="usuario_email" required><br>

        <label for="usuario_rol">Rol:</label><br>
        <select name="usuario_rol" required>
            <option value="administrador">Administrador</option>
            <option value="camarero">Camarero</option>
            <option value="cocinero">Cocinero</option>
        </select><br>

        <label for="usuario_password">Contraseña:</label><br>
        <input type="password" name="usuario_password" required><br>

        <button type="submit" name="agregar_usuario">Agregar Usuario</button>
    </form>

    <?php
    if (isset($_POST['agregar_usuario'])) {
        $nombre = $_POST['usuario_nombre'];
        $email = $_POST['usuario_email'];
        $rol = $_POST['usuario_rol'];
        $password = password_hash($_POST['usuario_password'], PASSWORD_BCRYPT);

        $sql = "INSERT INTO tb_usuarios (usuario_nombre, usuario_email, usuario_rol, usuario_password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nombre, $email, $rol, $password]);

        echo "<p>Usuario agregado correctamente.</p>";
    }
    ?>

    <h3>Usuarios Existentes</h3>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        <?php
        $usuarios = $conn->query("SELECT * FROM tb_usuarios");
        while ($usuario = $usuarios->fetch()) {
            echo "<tr>
                    <td>{$usuario['usuario_id']}</td>
                    <td>{$usuario['usuario_nombre']}</td>
                    <td>{$usuario['usuario_email']}</td>
                    <td>{$usuario['usuario_rol']}</td>
                    <td>
                        <a href='editar_usuario.php?id={$usuario['usuario_id']}'>Editar</a> |
                        <a href='eliminar_usuario.php?id={$usuario['usuario_id']}' onclick='return confirm(\"¿Estás seguro de eliminar este usuario?\");'>Eliminar</a>
                    </td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
