<?php
include 'db.php';

$nombre_curso = trim($_POST['nombre_curso'] ?? ''); // Recibimos por medio del metodo POST el nombre del curso
$creditos = trim($_POST['creditos'] ?? ''); // Recibimos por medio del metodo POST los créditos del curso
$docente = trim($_POST['docente'] ?? ''); // Recibimos por medio del metodo POST el nombre del docente
$codigo = trim($_POST['codigo'] ?? ''); // Recibimos por medio del metodo POST el código del curso
$accion = $_GET['accion'] ?? ''; // Obtenemos la acción a realizar desde la URL, por ejemplo, insertar o eliminar busca el parametro accion y lo guarda en la variable $accion

// Verificamos si la acción es insertar, si es así, procedemos a validar los datos
if (isset($accion) && $accion === 'insertar') {

  $errores = []; // Array para almacenar errores de validación
  if ($nombre_curso === '') $errores[] = 'El nombre del curso es obligatorio.'; // Validamos que el nombre del curso no esté vacío
  if ($creditos === '') $errores[] = 'La cantidad de créditos es obligatoria.'; // Validamos que los créditos no estén vacíos
  if ($docente === '') $errores[] = 'El nombre del docente es obligatorio.'; // Validamos que el nombre del docente no esté vacío
  if ($codigo === '') $errores[] = 'El código del curso es obligatorio.'; // Validamos que el código del curso no esté vacío

  // Esta negado la variable $errores, si no hay errores, se procede a insertar el registro
  if (count($errores) > 0) {
    // for each se utiliza para recorrer el array de errores
    foreach ($errores as $err) {
      echo "<p style='color:red;'>$err</p>";
    }
    echo "<p><a href='administrativo.php'>Volver</a></p>";
    exit;
  }

  $sql  = "INSERT INTO cursos (nombre_curso, creditos, docente, codigo) VALUES (:nombre_curso, :creditos, :docente, :codigo)"; // En values los : son marcadores de posición para evitar inyecciones SQL, eso quiere decir que los valores se asignan de forma segura.
  $stmt = $pdo->prepare($sql);
  $stmt->execute([':nombre_curso' => $nombre_curso, ':creditos' => $creditos, ':docente' => $docente, ':codigo' => $codigo]); // Ejecutamos la consulta con los valores proporcionados

  header('Location: administrativo.php'); // Redirigimos al usuario a la página principal después de insertar el registro
  exit;

}

// Verifica que existe la variable $accion y su valor es eliminar y verifica que exista nombre_curso
if (isset($accion) && $accion === 'eliminar' && isset($_GET['nombre_curso'])) {
  $nombre_curso_eliminar = $_GET['nombre_curso']; // Obtenemos el nombre del curso desde la URL
  $sql = "DELETE FROM cursos WHERE nombre_curso = :nombre_curso";
  $stmt = $pdo->prepare($sql); // Usa prepared statement para evitar inyección SQL.
  $resultado = $stmt->execute([':nombre_curso' => $nombre_curso_eliminar]); // Ejecuta la consulta sustituyendo el placeholder con el valor real.
  // Prueba de feedback
  echo "<p>Eliminando el curso con nombre: " . htmlspecialchars($nombre_curso_eliminar) . "</p>";
  echo "<p>Redirigiendo en 2 segundos...</p>";
  echo "<script>setTimeout(function(){ window.location.href = 'cursos.php'; }, 2000);</script>";
  exit;
}

// Si la acción es actualizar, procedemos a actualizar el registro

?>