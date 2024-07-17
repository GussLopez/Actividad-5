<?php
$conexion = mysqli_connect('localhost', 'root', '', 'sm32');

// Verificar que se haya pasado un ID en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos del libro actual
    $query = "SELECT * FROM libros WHERE id = $id";
    $resultado = mysqli_query($conexion, $query);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $libro = mysqli_fetch_assoc($resultado);

        $errores = [];
        $isbn = $libro['isbn'];
        $nombre = $libro['nombre'];
        $autor = $libro['autor'];
        $precio = $libro['precio'];
        $editorial = $libro['editorial'];
        $imagen = $libro['imagen'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $isbn = $_POST['isbn'];
            $nombre = $_POST['nombre'];
            $autor = $_POST['autor'];
            $precio = $_POST['precio'];
            $editorial = $_POST['editorial'];
            $imagen = $_POST['imagen'];

            if ($isbn === '') {
                $errores[] = 'Debes ingresar un ISBN';
            }

            if ($nombre === '') {
                $errores[] = 'Debes ingresar un Nombre';
            }
            if ($autor === '') {
                $errores[] = 'Debes ingresar un Autor';
            }
            if ($precio === '') {
                $errores[] = 'Debes ingresar un Precio';
            }
            if ($editorial === '') {
                $errores[] = 'Debes ingresar un Editorial';
            }
            if ($imagen === '') {
                $errores[] = 'Debes ingresar una Imagen';
            }

            if (empty($errores)) {
                $peticionActualizar = "UPDATE libros SET isbn = '$isbn', nombre = '$nombre', autor = '$autor', precio = '$precio', editorial = '$editorial', imagen = '$imagen' WHERE id = $id";
                if (mysqli_query($conexion, $peticionActualizar)) {
                    header('Location: listar.php'); // Redirige a listar.php después de la actualización
                    exit();
                } else {
                    echo "Error al actualizar los datos: " . mysqli_error($conexion);
                }
            }
        }
    } else {
        echo "No se encontró el libro con ID $id.";
        exit();
    }
} else {
    echo "ID inválido.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro</title>
</head>
<body>
    <a href="listar.php">Regresar</a>
    <?php foreach ($errores as $error): ?>
        <div style="background-color: black; color: red;"><?php echo $error ?></div>
    <?php endforeach ?>

    <form action="editar.php?id=<?php echo $id; ?>" method="POST">
        <label for="isbn">ISBN</label>
        <input type="text" name="isbn" value="<?php echo $isbn; ?>">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?php echo $nombre; ?>">
        <label for="autor">Autor</label>
        <input type="text" name="autor" value="<?php echo $autor; ?>">
        <label for="precio">Precio</label>
        <input type="number" name="precio" value="<?php echo $precio; ?>">
        <label for="editorial">Editorial</label>
        <input type="text" name="editorial" value="<?php echo $editorial; ?>">
        <label for="imagen">Imagen</label>
        <input type="text" name="imagen" value="<?php echo $imagen; ?>">
        <input type="submit" value="Actualizar">
    </form>
</body>
</html>
