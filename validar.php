<?php

session_start();

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "integradoralogin";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar la base de datos para el usuario
$usuario = $_POST['username'];
$clave_acceso = $_POST['password'];
$passwordNW = md5($clave_acceso);

// Consultar la base de datos para el usuario
$sql1 = "SELECT id, nickname, password FROM users WHERE nickname = '$usuario'";
$sql = mysqli_query($conn,"SELECT password FROM users WHERE nickname = '$usuario'");
$mostrar = mysqli_fetch_array($sql);
$result = $conn->query($sql1);


if ($result->num_rows > 0) {
    // Usuario encontrado, verificar la contraseña
    $row = $result->fetch_assoc();

    if ($mostrar['password']==$passwordNW) {
        // Contraseña válida, iniciar sesión
        header("Location: index.html"); // Redirige al dashboard o a la página principal
        exit();
    } else {

        echo "Contraseña incorrecta";
    }
} else {
    echo "Usuario no encontrado";
}

$conn->close();

?>
