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

// Recoger datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['lastname'];
$usuario = $_POST['username'];
$email = $_POST['email'];
$clave_acceso = $_POST['password'];
$confirmar_clave = $_POST['confirm-password'];

// Verificar si las contraseñas coinciden
if ($clave_acceso !== $confirmar_clave) {
    die("Las contraseñas no coinciden.");
}

// Hash de la contraseña
$hashed_password = md5($clave_acceso);

// Consultar si el usuario ya existe
$sql_check_user = "SELECT id FROM users WHERE nickname = '$usuario'";
$result_check_user = $conn->query($sql_check_user);

if ($result_check_user->num_rows > 0) {
    die("El usuario ya existe. Por favor, elige otro nombre de usuario.");
}

// Consultar si el correo electrónico ya está registrado
$sql_check_email = "SELECT correo FROM users WHERE correo = '$email'";
$result_check_email = $conn->query($sql_check_email);

if ($result_check_email->num_rows > 0) {
    die("El correo electrónico ya está registrado. Por favor, utiliza otro correo.");
}

// Insertar nuevo usuario en la base de datos
$sql_insert_user = "INSERT INTO users (nombre,apellido,nickname,correo,password,fecha_registro) VALUES ('$nombre','$apellido','$usuario', '$email', '$hashed_password',now())";

if ($conn->query($sql_insert_user) === TRUE) {
    echo "Registro exitoso. Ahora puedes iniciar sesión.";
} else {
    echo "Error en el registro: " . $conn->error;
}

$conn->close();
?>
