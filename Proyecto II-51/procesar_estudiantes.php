<?php
include 'db.php';

$nombre_apellido = trim($_POST['nombre_apellido'] ?? ''); // Recibimos por medio del metodo POST el nombre del alumno
$id = trim($_POST['id'] ?? ''); // Recibimos por medio del metodo POST el ID del alumno
$correo = trim($_POST['correo'] ?? ''); // Recibimos por medio del metodo POST el correo del alumno
$telefono = trim($_POST['telefono'] ?? ''); // Recibimos por medio del metodo POST el telefono del alumno
$curso = trim($_POST['curso'] ?? ''); // Recibimos por medio del metodo POST el curso del alumno
$fecha_nacimiento = trim($_POST['fecha_nacimiento'] ?? ''); // Recibimos por medio del metodo POST la fecha de nacimiento del alumno
$accion = $_GET['accion'] ?? ''; // Obtenemos la acción a realizar desde la URL, por ejemplo, insertar o eliminar busca el parametro accion y lo guarda en la variable $accion

// Verificamos si la acción es insertar, si es así, procedemos a validar los datos
if (isset($accion) && $accion === 'insertar') {

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
    echo "<p><a href='administrativo.php'>Volver</a></p>";
    exit;
  }

  $sql  = "INSERT INTO estudiantes (nombre_apellido, id, correo, telefono, curso, fecha_nacimiento) VALUES (:nombre_apellido, :id, :correo, :telefono, :curso, :fecha_nacimiento)"; // En values los : son marcadores de posición para evitar inyecciones SQL, eso quiere decir que los valores se asignan de forma segura.
  $stmt = $pdo->prepare($sql);
  $stmt->execute([':nombre_apellido' => $nombre_apellido, ':id' => $id, ':correo' => $correo, ':telefono' => $telefono, ':curso' => $curso, ':fecha_nacimiento' => $fecha_nacimiento]); // Ejecutamos la consulta con los valores proporcionados

  header('Location: administrativo.php'); // Redirigimos al usuario a la página principal después de insertar el registro
  exit;

}

// Verifica que existe la variable $accion y su valor es eliminar y verifica que exista nombre_apellido
if (isset($accion) && $accion === 'eliminar' && isset($_GET['nombre_apellido'])) {
  $nombre_apellido_eliminar = $_GET['nombre_apellido']; // Obtenemos el nombre del estudiante desde la URL
  $sql = "DELETE FROM estudiantes WHERE nombre_apellido = :nombre_apellido";
  $stmt = $pdo->prepare($sql); // Usa prepared statement para evitar inyección SQL.
  $resultado = $stmt->execute([':nombre_apellido' => $nombre_apellido_eliminar]); // Ejecuta la consulta sustituyendo el placeholder con el valor real.
  // Prueba de feedback
  echo "<p>Eliminando el estudiante con nombre: " . htmlspecialchars($nombre_apellido_eliminar) . "</p>";
  echo "<p>Redirigiendo en 2 segundos...</p>";
  echo "<script>setTimeout(function(){ window.location.href = 'estudiantes.php'; }, 2000);</script>";
  exit;
}

// Si la acción es actualizar, procedemos a actualizar el registro

?>