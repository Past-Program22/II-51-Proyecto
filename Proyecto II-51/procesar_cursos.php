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




// Si la acción es eliminar, procedemos a eliminar el registro
// FUNCIÓN ELIMINAR CORREGIDA
if (isset($accion) && $accion === 'eliminar' && isset($_GET['nombre_curso'])) {
  // CORRECCIÓN 1: Usar la variable correcta desde $_GET
  $nombre_curso_eliminar = $_GET['nombre_curso']; // Obtenemos el nombre del curso desde la URL
  
  // CORRECCIÓN 2: Validar que el parámetro no esté vacío
  if (empty($nombre_curso_eliminar)) {
    echo "<p style='color:red;'>Error: No se especificó el curso a eliminar.</p>";
    echo "<p><a href='cursos.php'>Volver</a></p>";
    exit;
  }
  
  // CORRECCIÓN 3: Usar la variable correcta en toda la operación
  $sql = "DELETE FROM cursos WHERE nombre_curso = :nombre_curso";
  echo "<p>Eliminando el curso con nombre: " . htmlspecialchars($nombre_curso_eliminar) . "</p>";
  
  try {
    $stmt = $pdo->prepare($sql);
    $resultado = $stmt->execute([':nombre_curso' => $nombre_curso_eliminar]);
    
    // CORRECCIÓN 4: Verificar si realmente se eliminó algo
    if ($stmt->rowCount() > 0) {
      echo "<p style='color:green;'>Curso eliminado exitosamente.</p>";
    } else {
      echo "<p style='color:orange;'>No se encontró ningún curso con ese nombre.</p>";
    }
    
  } catch (PDOException $e) {
    echo "<p style='color:red;'>Error al eliminar: " . $e->getMessage() . "</p>";
    echo "<p><a href='cursos.php'>Volver</a></p>";
    exit;
  }
  
  // Opcional: Agregar un pequeño delay para que el usuario vea el mensaje
  echo "<p>Redirigiendo en 2 segundos...</p>";
  echo "<script>setTimeout(function(){ window.location.href = 'cursos.php'; }, 2000);</script>";
  exit;
}




// Si la acción es actualizar, procedemos a actualizar el registro

?>