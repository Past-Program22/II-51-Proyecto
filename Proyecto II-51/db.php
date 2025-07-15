<?php
$host     = 'localhost'; // Ruta del servidor de la base de datos
$user     = 'root'; // Usuario de la base de datos
$password = ''; // Contraseña del usuario de la base de datos
$dbname   = 'proyecto_ii51'; // Nombre de la base de datos

// Try es intentar x o y instrucciones, catch es capturar errores
// PDO es una clase de PHP que permite conectarse a bases de datos de forma segura y eficiente
// catch me muestra un mensaje de error si la conexión falla
try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password); // Crear una nueva conexión PDO
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Error de conexión: " . $e->getMessage());
}
?>