<?php
include 'db.php';

$nombre_curso = trim($_POST['nombre_curso'] ?? '');
$creditos     = trim($_POST['creditos'] ?? '');
$docente      = trim($_POST['docente'] ?? '');
$codigo       = trim($_POST['codigo'] ?? '');
$accion       = $_GET['accion'] ?? '';

// Funcion de insertar
if ($accion === 'insertar') {
  $errores = [];
  if ($nombre_curso === '') $errores[] = 'El nombre del curso es obligatorio.';
  if ($creditos === '')     $errores[] = 'La cantidad de créditos es obligatoria.';
  if ($docente === '')      $errores[] = 'El nombre del docente es obligatorio.';
  if ($codigo === '')       $errores[] = 'El código del curso es obligatorio.';

  if (count($errores) > 0) {
    foreach ($errores as $err) {
      echo "<p style='color:red;'>$err</p>";
    }
    echo "<p><a href='administrativo.php'>Volver</a></p>";
    exit;
  }

  $sql  = "INSERT INTO cursos (nombre_curso, creditos, docente, codigo) 
           VALUES (:nombre_curso, :creditos, :docente, :codigo)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    ':nombre_curso' => $nombre_curso,
    ':creditos'     => $creditos,
    ':docente'      => $docente,
    ':codigo'       => $codigo
  ]);

  header('Location: administrativo.php');
  exit;
}

// Funcion de eliminar
if ($accion === 'eliminar' && isset($_GET['nombre_curso'])) {
  $nombre_curso_eliminar = $_GET['nombre_curso'];
  $sql  = "DELETE FROM cursos WHERE nombre_curso = :nombre_curso";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([':nombre_curso' => $nombre_curso_eliminar]);

  echo "<p>Eliminando el curso con nombre: " . htmlspecialchars($nombre_curso_eliminar) . "</p>";
  echo "<p>Redirigiendo en 2 segundos...</p>";
  echo "<script>setTimeout(function(){ window.location.href = 'cursos.php'; }, 2000);</script>";
  exit;
}

// Si la acción es actualizar, procedemos a actualizar el registro
if ($accion === 'actualizar' && isset($_GET['nombre_curso'])) {
    $nombre_curso = $_GET['nombre_curso'];

    $stmt = $pdo->prepare("SELECT * FROM cursos WHERE nombre_curso = :nombre_curso");
    $stmt->execute([':nombre_curso' => $nombre_curso]);
    $curso = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$curso) {
        echo "<p>No se encontró el Curso.</p>";
        exit;
    }
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="UTF-8">
      <title>Actualizar Curso</title>
      <link rel="stylesheet" href="administrativo.css">
    </head>
    <body>
      <div class="wrapper">
        <main>
          <div class="form-wrap">
            <h2>Actualizar Curso</h2>
            <form method="POST" action="procesar_cursos.php?accion=guardar_actualizacion">
              <input type="hidden" name="nombre_original" value="<?= htmlspecialchars($curso['nombre_curso']) ?>">

              <div class="form-group">
                <label>Nombre del Curso:</label>
                <input type="text" name="nombre_curso" value="<?= htmlspecialchars($curso['nombre_curso']) ?>" required>
              </div>

              <div class="form-group">
                <label>Créditos:</label>
                <input type="number" name="creditos" value="<?= htmlspecialchars($curso['creditos']) ?>" required>
              </div>

              <div class="form-group">
                <label>Nombre del docente:</label>
                <input type="text" name="docente" value="<?= htmlspecialchars($curso['docente']) ?>" required>
              </div>

              <div class="form-group">
                <label>Código:</label>
                <input type="text" name="codigo" value="<?= htmlspecialchars($curso['codigo']) ?>" required>
              </div>

              <button type="submit" class="submit-btn">Actualizar Curso</button>
            </form>
            <p style="text-align:center; margin-top:15px;">
            <a href="docentes.php" style="color:#e57373; text-decoration:none;">
              <i class="fas fa-arrow-left"></i> Volver a Cursos
            </a>
          </p>
          </div>
        </main>
      </div>
    </body>
    </html>
    <?php
    exit;
}

// Si la acción es guardar_actualizacion, procedemos a guardar los cambios
if ($accion === 'guardar_actualizacion') {
    $nombre_original = $_POST['nombre_original'] ?? '';
    $nombre_curso = trim($_POST['nombre_curso'] ?? '');
    $creditos = trim($_POST['creditos'] ?? '');
    $docente = trim($_POST['docente'] ?? '');
    $codigo = trim($_POST['codigo'] ?? '');

    $sql = "UPDATE cursos 
            SET nombre_curso = :nombre_curso, creditos = :creditos, docente = :docente, codigo = :codigo
            WHERE nombre_curso = :nombre_original";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nombre_curso' => $nombre_curso,
        ':creditos' => $creditos,
        ':docente' => $docente,
        ':codigo' => $codigo,
        ':nombre_original' => $nombre_original
    ]);

    header('Location: cursos.php');
    exit;
}
?>