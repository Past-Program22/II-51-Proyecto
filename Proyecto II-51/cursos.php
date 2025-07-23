<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="es">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="cursos.css">

  <head>
    <meta charset="UTF-8">
    <title>Proyecto II-51 / Cursos</title>
  </head>

  <header>
    <div class="texto-header">
      <div class="menu-admin">
        <button class="admin-btn">
          <i class="fas fa-bars"></i>
        </button>
        <div class="dropdown-1">
          <a href="cursos.php"><i class="fas fa-book"></i> Cursos</a>
          <hr>
          <a href="docentes.php"><i class="fas fa-chalkboard-teacher"></i> Docentes</a>
          <a href="estudiantes.php"><i class="fas fa-user-graduate"></i> Estudiantes</a>
        </div>
      </div>
      <div class="titulo-contenido">
        <h1>Tabla de Cursos</h1>
        <p>Cursos de la Plataforma Educativa Universidad Central</p>
      </div>
    </div> <!-- Cierra texto-header -->

    <div class="menu-usuario">
      <button class="usuario-btn">
        <i class="fas fa-user"></i>
        <i class="fas fa-chevron-down"></i>
      </button>
      <div class="dropdown-2">
        <a href="inicio.html"><i class="fas fa-circle-xmark"></i> Salir</a>
        <a href="estilos.html"><i class="fas fa-paint-brush"></i> Estilos</a>
        <hr>
        <a href="../index.html"><i class="fas fa-arrow-right-from-bracket"></i> Cerrar sesión</a>
      </div>
    </div> <!-- Cierra menu-usuario -->
  </header>

  <body>
    <div class="wrapper">
      <main>
        <div class="form-wrap">
          <h2>Registro de Cursos</h2>
        </div>

        <table>
          <thead>
            <tr>
              <th>Nombre del Curso</th>
              <th>Créditos</th>
              <th>Nombre del Docente</th>
              <th>Código del Curso</th>
              <th>Fecha de Registro</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php // stmt es una variable que contiene la consulta a la base de datos statement
              $stmt = $pdo->query("SELECT * FROM cursos ORDER BY codigo DESC"); // Consulta para obtener los cursos registrados
              while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // fetch asocia los resultados a un array asociativo
                echo "<tr>
                        <td>".htmlspecialchars($row['nombre_curso'])."</td>
                        <td>".htmlspecialchars($row['creditos'])."</td>
                        <td>".htmlspecialchars($row['docente'])."</td>
                        <td>".htmlspecialchars($row['codigo'])."</td>
                        <td>{$row['fecha_registro']}</td>
                        <td>
                          <a href='procesar_cursos.php?nombre_curso={$row['nombre_curso']}&accion=actualizar' title='Actualizar' class='btn-actualizar'><i class='fas fa-sync-alt'></i></a> |
                          <a href='procesar_cursos.php?nombre_curso={$row['nombre_curso']}&accion=eliminar' title='Eliminar' class='btn-eliminar'><i class='fa-solid fa-circle-xmark'></i></a>
                      </tr>";
              } // htmlspecialchars previene ataques XSS al escapar caracteres especiales como <, >, &, etc.
            ?>
          </tbody>
        </table>
      </main>
    </div>
  </body>

  <footer>
    <p>&copy; <span id="year"></span> Plataforma Educativa Universidad Central</p>
    <p>Proyecto II-51</p>
    <p>Contacto: <a href="mailto:carcec@edu.uc.ac.cr" class="arce-link">carcec@edu.uc.ac.cr</a></p>
  </footer>
  <script>
    document.getElementById("year").textContent = new Date().getFullYear();
  </script>
  
</html>