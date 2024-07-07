<?php
session_start();
require 'config/conexion.php';

// Crear una instancia de la clase de conexión
$conexion = new Clase_Conectar();
$conn = $conexion->Procedimiento_Conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    // Preparar la consulta usando MySQLi
    $stmt = $conn->prepare('SELECT * FROM usuarios WHERE correo = ? AND password = ?');
    $stmt->bind_param("ss", $correo, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $_SESSION['user_id'] = $user['UsuarioId'];
        header('Location: views/dashboard.php');
        exit();
    } else {
        echo 'Usuario o contraseña incorrectos';
    }
    $stmt->close();
}

$conn->close();
?>

<form action="login.php" method="POST">
    <input type="text" name="correo" placeholder="Correo">
    <input type="password" name="password" placeholder="Contraseña">
    <button type="submit">Ingresar</button>
</form>