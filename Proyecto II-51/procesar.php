<?php
include 'db.php';

$nombre_apellido = trim($_POST['nombre_apellido'] ?? ''); // Recibimos por medio del metodo POST el nombre del alumno
$id = trim($_POST['id'] ?? ''); // Recibimos por medio del metodo POST el ID del alumno
$correo = trim($_POST['correo'] ?? ''); // Recibimos por medio del metodo POST el correo del alumno
$telefono = trim($_POST['telefono'] ?? ''); // Recibimos por medio del metodo POST el telefono del alumno
$curso = trim($_POST['curso'] ?? ''); // Recibimos por medio del metodo POST el curso del alumno
$fecha_nacimiento = trim($_POST['fecha_nacimiento'] ?? ''); // Recibimos por medio del metodo POST la fecha de nacimiento del alumno

$errores = []; // Array para almacenar errores de validación
if ($nombre_apellido === '') $errores[] = 'El nombre y apellido son obligatorios.'; // Validamos que el nombre no esté vacío
if ($id === '') $errores[] = 'La identificación es obligatoria.'; // Validamos que el ID no esté vacío
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) $errores[] = 'Correo inválido.'; // Validamos que el correo tenga un formato válido
if ($telefono === '') $errores[] = 'El teléfono es obligatorio.'; // Validamos que el teléfono no esté vacío
if ($curso === '') $errores[] = 'El curso es obligatorio.'; // Validamos que el curso no esté vacío
if ($fecha_nacimiento === '') $errores[] = 'La fecha de nacimiento es obligatoria.'; // Validamos que la fecha de nacimiento no esté vacía

// Esta negado la variable $errores, si no hay errores, se procede a insertar el registro
if (count($errores) > 0) {
  // for each se utiliza para recorrer el array de errores
  foreach ($errores as $err) {
    echo "<p style='color:red;'>$err</p>";
  }
  echo "<p><a href='index.php'>Volver</a></p>";
  exit;
}

$sql  = "INSERT INTO estudiantes (nombre_apellido, id, correo, telefono, curso, fecha_nacimiento) VALUES (:nombre_apellido, :id, :correo, :telefono, :curso, :fecha_nacimiento)"; // En values los : son marcadores de posición para evitar inyecciones SQL, eso quiere decir que los valores se asignan de forma segura.
$stmt = $pdo->prepare($sql);
$stmt->execute([':nombre_apellido' => $nombre_apellido, ':id' => $id, ':correo' => $correo, ':telefono' => $telefono, ':curso' => $curso, ':fecha_nacimiento' => $fecha_nacimiento]); // Ejecutamos la consulta con los valores proporcionados

header('Location: c.administrativo.php'); // Redirigimos al usuario a la página principal después de insertar el registro
exit;
?>