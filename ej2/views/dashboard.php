<?php
require '../config/conexion.php'; // Asegúrate de incluir el archivo correctamente

// Crear una instancia de la clase renombrada
$con = new Clase_Conectar();
$conexion = $con->Procedimiento_Conectar();

if (!$conexion) {
    die("Error en la conexión a la base de datos.");
}
?>

<?php include 'html/header.php'; ?>
<?php include 'html/menu.php'; ?>

<div class="container">
    <h2>Gestión de Productos</h2>
    <form action="../controllers/productos.controller.php" method="POST">
        <input type="hidden" name="action" value="create">
        <input type="text" name="nombre" placeholder="Nombre del producto">
        <input type="text" name="precio" placeholder="Precio">
        <input type="text" name="stock" placeholder="Stock">
        <button type="submit">Crear Producto</button>
    </form>

    <h3>Listado de Productos</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                $result = mysqli_query($conexion, 'SELECT * FROM productos');
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['nombre']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['precio']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['stock']) . '</td>';
                    echo '<td>';
                    echo '<form action="../controllers/productos.controller.php" method="POST" style="display:inline;">';
                    echo '<input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">';
                    echo '<input type="hidden" name="action" value="delete">';
                    echo '<button type="submit">Eliminar</button>';
                    echo '</form>';
                    echo '<form action="../controllers/productos.controller.php" method="POST" style="display:inline;">';
                    echo '<input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">';
                    echo '<input type="hidden" name="action" value="update">';
                    echo '<input type="text" name="nombre" value="' . htmlspecialchars($row['nombre']) . '">';
                    echo '<input type="text" name="precio" value="' . htmlspecialchars($row['precio']) . '">';
                    echo '<input type="text" name="stock" value="' . htmlspecialchars($row['stock']) . '">';
                    echo '<button type="submit">Actualizar</button>';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'html/footer.php'; ?>