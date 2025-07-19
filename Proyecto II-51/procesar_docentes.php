<?php
include 'db.php';

$nombre_apellido = trim($_POST['nombre_apellido'] ?? ''); // Recibimos por medio del metodo POST el nombre completo del docente
$id = trim($_POST['id'] ?? ''); // Recibimos por medio del metodo POST la identificación del docente
$correo = trim($_POST['correo'] ?? ''); // Recibimos por medio del metodo POST el correo electrónico del docente
$telefono = trim($_POST['telefono'] ?? ''); // Recibimos por medio del metodo POST el teléfono del docente
$curso = trim($_POST['curso'] ?? ''); // Recibimos por medio del metodo POST el código del curso


$errores = []; // Array para almacenar errores de validación
if ($nombre_apellido === '') $errores[] = 'El nombre completo es obligatorio.'; // Validamos que el nombre completo no esté vacío
if ($id === '') $errores[] = 'La identificación es obligatoria.'; // Validamos que la identificación no esté vacía 
if ($correo === '') $errores[] = 'El correo electrónico es obligatorio.'; // Validamos que el correo del docente no esté vacío
if ($telefono === '') $errores[] = 'El número de teléfono es obligatorio.'; // Validamos que el teléfono no esté vacío
if ($curso === '') $errores[] = 'El nombre del curso es obligatorio.'; // Validamos que el nombre del curso no esté vacío

// Esta negado la variable $errores, si no hay errores, se procede a insertar el registro
if (count($errores) > 0) {
  // for each se utiliza para recorrer el array de errores
  foreach ($errores as $err) {
    echo "<p style='color:red;'>$err</p>";
  }
  echo "<p><a href='administrativo.php'>Volver</a></p>";
  exit;
}

$sql  = "INSERT INTO docentes (nombre_apellido, id, correo, telefono, curso) VALUES (:nombre_apellido, :id, :correo, :telefono, :curso)"; // En values los : son marcadores de posición para evitar inyecciones SQL, eso quiere decir que los valores se asignan de forma segura.
$stmt = $pdo->prepare($sql);
$stmt->execute([':nombre_apellido' => $nombre_apellido, ':id' => $id, ':correo' => $correo, ':telefono' => $telefono, 'curso' => $curso]); // Ejecutamos la consulta con los valores proporcionados

header('Location: administrativo.php'); // Redirigimos al usuario a la página principal después de insertar el registro
exit;
?>