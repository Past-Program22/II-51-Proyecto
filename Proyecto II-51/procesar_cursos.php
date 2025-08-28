<?php
include 'db.php';

$nombre_curso = trim($_POST['nombre_curso'] ?? '');
$creditos     = trim($_POST['creditos'] ?? '');
$docente      = trim($_POST['docente'] ?? '');
$codigo       = trim($_POST['codigo'] ?? '');
$accion       = $_GET['accion'] ?? '';

// ==================== INSERTAR ====================
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

// ==================== ELIMINAR ====================
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

// ==================== ACTUALIZAR ====================
if ($accion === 'actualizar' && isset($_GET['nombre_curso'])) {
  $nombre_curso_actual = $_GET['nombre_curso'];

  // Paso 1: Obtener datos actuales
  $sql  = "SELECT * FROM cursos WHERE nombre_curso = :nombre_curso";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([':nombre_curso' => $nombre_curso_actual]);
  $curso = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$curso) {
    echo "<p style='color:red;'>No se encontró el curso.</p>";
    echo "<p><a href='cursos.php'>Volver</a></p>";
    exit;
  }

  // Paso 2: Si se envía formulario -> actualizar
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevo_nombre = trim($_POST['nombre_curso']);
    $creditos     = trim($_POST['creditos']);
    $docente      = trim($_POST['docente']);
    $codigo       = trim($_POST['codigo']);

    if ($nuevo_nombre === '' || $creditos === '' || $docente === '' || $codigo === '') {
      echo "<p style='color:red;'>Todos los campos son obligatorios.</p>";
    } else {
      $sql_update = "UPDATE cursos 
                     SET nombre_curso = :nuevo_nombre, 
                         creditos = :creditos, 
                         docente = :docente, 
                         codigo = :codigo
                     WHERE nombre_curso = :nombre_curso_actual";
      $stmt_update = $pdo->prepare($sql_update);
      $stmt_update->execute([
        ':nuevo_nombre'        => $nuevo_nombre,
        ':creditos'            => $creditos,
        ':docente'             => $docente,
        ':codigo'              => $codigo,
        ':nombre_curso_actual' => $nombre_curso_actual
      ]);

      echo "<p style='color:green;'>Curso actualizado correctamente ✅</p>";
      echo "<script>setTimeout(function(){ window.location.href = 'cursos.php'; }, 1500);</script>";
      exit;
    }
  }

  // Paso 3: Mostrar formulario de edición
  ?>
  <!DOCTYPE html>
  <html lang="es">
  <head>
    <meta charset="UTF-8">
    <title>Actualizar Curso</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="administrativo.css">
  </head>
  <body>
    <div class="wrapper">
      <main>
        <div class="form-wrap">
          <h2>Actualizar Curso</h2>
          <form method="POST" class="form-container">
            <div class="form-group">
              <label>Nombre Curso:</label>
              <input type="text" name="nombre_curso" value="<?= htmlspecialchars($curso['nombre_curso']) ?>" required>
            </div>

            <div class="form-group">
              <label>Créditos:</label>
              <input type="number" name="creditos" value="<?= htmlspecialchars($curso['creditos']) ?>" required>
            </div>

            <div class="form-group">
              <label>Docente:</label>
              <input type="text" name="docente" value="<?= htmlspecialchars($curso['docente']) ?>" required>
            </div>

            <div class="form-group">
              <label>Código:</label>
              <input type="text" name="codigo" value="<?= htmlspecialchars($curso['codigo']) ?>" required>
            </div>

            <button type="submit" class="submit-btn"><i class="fas fa-sync-alt"></i> Actualizar Curso</button>
          </form>
          <p style="text-align:center; margin-top:15px;">
            <a href="cursos.php" style="color:#e57373; text-decoration:none;">
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
