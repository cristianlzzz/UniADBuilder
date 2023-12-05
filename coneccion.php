<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php
$coneccion = new mysqli("localhost","root","","integradoralogin");

if($coneccion->connect_errno) {
    die("Conexion fallida" . $coneccion->connect_errno);
}else{
    echo"Conectado";
}



?>
</body>
</html>
