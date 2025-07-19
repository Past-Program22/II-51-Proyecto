<?php
include 'db.php';

$nombre_curso = trim($_POST['nombre_curso'] ?? ''); // Recibimos por medio del metodo POST el nombre del curso
$creditos = trim($_POST['creditos'] ?? ''); // Recibimos por medio del metodo POST los créditos del curso
$docente = trim($_POST['docente'] ?? ''); // Recibimos por medio del metodo POST el nombre del docente
$codigo = trim($_POST['codigo'] ?? ''); // Recibimos por medio del metodo POST el código del curso


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
?>