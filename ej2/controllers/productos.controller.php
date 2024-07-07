phpCopy<?php
require_once '../config/conexion.php';

$conexion = new Clase_Conectar();
$conn = $conexion->Procedimiento_Conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    switch ($action) {
        case 'create':
            createProduct($conn);
            break;
        case 'update':
            updateProduct($conn);
            break;
        case 'delete':
            deleteProduct($conn);
            break;
    }
}

function createProduct($conn) {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $stmt = $conn->prepare('INSERT INTO productos (nombre, precio, stock) VALUES (?, ?, ?)');
    $stmt->bind_param("sdi", $nombre, $precio, $stock);
    $stmt->execute();
    $stmt->close();
    header('Location: ../views/dashboard.php');
}

function updateProduct($conn) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $stmt = $conn->prepare('UPDATE productos SET nombre = ?, precio = ?, stock = ? WHERE id = ?');
    $stmt->bind_param("sdii", $nombre, $precio, $stock, $id);
    $stmt->execute();
    $stmt->close();
    header('Location: ../views/dashboard.php');
}

function deleteProduct($conn) {
    $id = $_POST['id'];

    $stmt = $conn->prepare('DELETE FROM productos WHERE id = ?');
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header('Location: ../views/dashboard.php');
}

$conn->close();
?>