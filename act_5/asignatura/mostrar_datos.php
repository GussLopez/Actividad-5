<?php
$conexion = mysqli_connect('localhost', 'root', '', 'sm32');

$query = "SELECT * FROM libros";
$resultado = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Libros</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Lista de Libros</h1>
    <a href="admin/index.php">Agregar Libro</a>
    <div class="tabla-datos">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ISBN</th>
                    <th>Nombre</th>
                    <th>Autor</th>
                    <th>Precio</th>
                    <th>Editorial</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($libro = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td><?php echo $libro['id']; ?></td>
                        <td><?php echo $libro['isbn']; ?></td>
                        <td><?php echo $libro['nombre']; ?></td>
                        <td><?php echo $libro['autor']; ?></td>
                        <td><?php echo $libro['precio']; ?></td>
                        <td><?php echo $libro['editorial']; ?></td>
                        <td><img src="<?php echo $libro['imagen']; ?>" alt="<?php echo $libro['nombre']; ?>" width="50"></td>
                        <td>
                            <a href="editar.php?id=<?php echo $libro['id']; ?>">Editar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
