<?php
include 'db.php';

$accion = $_GET['accion'] ?? '';

/* ------------------ INSERTAR ------------------ */
if ($accion === 'insertar') {
    $nombre_apellido = trim($_POST['nombre_apellido'] ?? '');
    $id = trim($_POST['id'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $curso = trim($_POST['curso'] ?? '');

    $errores = [];
    if ($nombre_apellido === '') $errores[] = 'El nombre completo es obligatorio.';
    if ($id === '') $errores[] = 'La identificación es obligatoria.';
    if ($correo === '') $errores[] = 'El correo es obligatorio.';
    if ($telefono === '') $errores[] = 'El teléfono es obligatorio.';
    if ($curso === '') $errores[] = 'El curso es obligatorio.';

    if (count($errores) > 0) {
        foreach ($errores as $err) {
            echo "<p style='color:red;'>$err</p>";
        }
        echo "<p><a href='docentes.php'>Volver</a></p>";
        exit;
    }

    $sql  = "INSERT INTO docentes (nombre_apellido, id, correo, telefono, curso) 
             VALUES (:nombre_apellido, :id, :correo, :telefono, :curso)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nombre_apellido' => $nombre_apellido,
        ':id' => $id,
        ':correo' => $correo,
        ':telefono' => $telefono,
        ':curso' => $curso
    ]);

    header('Location: docentes.php');
    exit;
}

/* ------------------ ELIMINAR ------------------ */
if ($accion === 'eliminar' && isset($_GET['nombre_apellido'])) {
    $nombre_apellido_eliminar = $_GET['nombre_apellido'];
    $sql = "DELETE FROM docentes WHERE nombre_apellido = :nombre_apellido";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':nombre_apellido' => $nombre_apellido_eliminar]);

    echo "<p>Eliminando el docente: " . htmlspecialchars($nombre_apellido_eliminar) . "</p>";
    echo "<script>setTimeout(function(){ window.location.href = 'docentes.php'; }, 2000);</script>";
    exit;
}

/* ------------------ MOSTRAR FORMULARIO DE ACTUALIZAR ------------------ */
if ($accion === 'actualizar' && isset($_GET['nombre_apellido'])) {
    $nombre_apellido = $_GET['nombre_apellido'];

    $stmt = $pdo->prepare("SELECT * FROM docentes WHERE nombre_apellido = :nombre_apellido");
    $stmt->execute([':nombre_apellido' => $nombre_apellido]);
    $docente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$docente) {
        echo "<p>No se encontró el docente.</p>";
        exit;
    }
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="UTF-8">
      <title>Actualizar Docente</title>
      <link rel="stylesheet" href="administrativo.css">
    </head>
    <body>
      <div class="wrapper">
        <main>
          <div class="form-wrap">
            <h2>Actualizar Docente</h2>
            <form method="POST" action="procesar_docentes.php?accion=guardar_actualizacion">
              <input type="hidden" name="nombre_original" value="<?= htmlspecialchars($docente['nombre_apellido']) ?>">

              <div class="form-group">
                <label>Nombre/Apellido:</label>
                <input type="text" name="nombre_apellido" value="<?= htmlspecialchars($docente['nombre_apellido']) ?>" required>
              </div>

              <div class="form-group">
                <label>ID:</label>
                <input type="text" name="id" value="<?= htmlspecialchars($docente['id']) ?>" required>
              </div>

              <div class="form-group">
                <label>Correo:</label>
                <input type="email" name="correo" value="<?= htmlspecialchars($docente['correo']) ?>" required>
              </div>

              <div class="form-group">
                <label>Teléfono:</label>
                <input type="text" name="telefono" value="<?= htmlspecialchars($docente['telefono']) ?>" required>
              </div>

              <div class="form-group">
                <label>Curso:</label>
                <input type="text" name="curso" value="<?= htmlspecialchars($docente['curso']) ?>" required>
              </div>

              <button type="submit" class="submit-btn">Actualizar Docente</button>
            </form>
            <p style="text-align:center; margin-top:15px;">
            <a href="docentes.php" style="color:#e57373; text-decoration:none;">
              <i class="fas fa-arrow-left"></i> Volver a Docentes
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

/* ------------------ GUARDAR ACTUALIZACIÓN ------------------ */
if ($accion === 'guardar_actualizacion') {
    $nombre_original = $_POST['nombre_original'] ?? '';
    $nombre_apellido = trim($_POST['nombre_apellido'] ?? '');
    $id = trim($_POST['id'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $curso = trim($_POST['curso'] ?? '');

    $sql = "UPDATE docentes 
            SET nombre_apellido = :nombre_apellido, id = :id, correo = :correo, telefono = :telefono, curso = :curso
            WHERE nombre_apellido = :nombre_original";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nombre_apellido' => $nombre_apellido,
        ':id' => $id,
        ':correo' => $correo,
        ':telefono' => $telefono,
        ':curso' => $curso,
        ':nombre_original' => $nombre_original
    ]);

    header('Location: docentes.php');
    exit;
}
?>
