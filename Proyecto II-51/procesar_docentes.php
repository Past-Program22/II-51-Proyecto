<?php
include 'db.php';

$nombre_apellido = trim($_POST['nombre_apellido'] ?? ''); // Recibimos por medio del metodo POST el nombre completo del docente
$id = trim($_POST['id'] ?? ''); // Recibimos por medio del metodo POST la identificación del docente
$correo = trim($_POST['correo'] ?? ''); // Recibimos por medio del metodo POST el correo electrónico del docente
$telefono = trim($_POST['telefono'] ?? ''); // Recibimos por medio del metodo POST el teléfono del docente
$curso = trim($_POST['curso'] ?? ''); // Recibimos por medio del metodo POST el código del curso
$accion = $_GET['accion'] ?? ''; // Obtenemos la acción a realizar desde la URL, por ejemplo, insertar o eliminar busca el parametro accion y lo guarda en la variable $accion

// Verificamos si la acción es insertar, si es así, procedemos a validar los datos
if (isset($accion) && $accion === 'insertar') {

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

}

// Verifica que existe la variable $accion y su valor es eliminar y verifica que exista nombre_apellido
if (isset($accion) && $accion === 'eliminar' && isset($_GET['nombre_apellido'])) {
  $nombre_apellido_eliminar = $_GET['nombre_apellido']; // Obtenemos el nombre del docente desde la URL
  $sql = "DELETE FROM docentes WHERE nombre_apellido = :nombre_apellido";
  $stmt = $pdo->prepare($sql); // Usa prepared statement para evitar inyección SQL.
  $resultado = $stmt->execute([':nombre_apellido' => $nombre_apellido_eliminar]); // Ejecuta la consulta sustituyendo el placeholder con el valor real.
  // Prueba de feedback
  echo "<p>Eliminando el docente con nombre: " . htmlspecialchars($nombre_apellido_eliminar) . "</p>";
  echo "<p>Redirigiendo en 2 segundos...</p>";
  echo "<script>setTimeout(function(){ window.location.href = 'docentes.php'; }, 2000);</script>";
  exit;
}

// Si la acción es actualizar, procedemos a actualizar el registro

?>