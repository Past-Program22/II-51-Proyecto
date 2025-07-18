<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="es">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="estudiantes.css">

  <head>
    <meta charset="UTF-8">
    <title>Proyecto II-51 / Estudiantes</title>
  </head>

  <header>
    <div class="texto-header">
      <div class="menu-admin">
        <button class="admin-btn">
          <i class="fas fa-bars"></i>
        </button>
        <div class="dropdown-1">
          <a href="estudiantes.php"><i class="fas fa-user-graduate"></i> Estudiantes</a>
          <hr>
          <a href="cursos.php"><i class="fas fa-book"></i> Cursos</a>
          <a href="docentes.php"><i class="fas fa-chalkboard-teacher"></i> Docentes</a>
        </div>
      </div>
      <div class="titulo-contenido">
        <h1>Tabla de Estudiantes</h1>
        <p>Estudiantes de la Plataforma Educativa Universidad Central</p>
      </div>
    </div>

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
        </div>
      </div>
    </div>
  </header>

  <body>
    <div class="wrapper">
      <main>
        <div class="form-wrap">
          <h2>Registro de Estudiantes</h2>
        </div>

        <table>
          <thead>
            <tr>
              <th>Nombre/Apellido</th>
              <th>ID</th>
              <th>Correo</th>
              <th>Teléfono</th>
              <th>Curso</th>
              <th>Fecha de Nacimiento</th>
              <th>Fecha de Registro</th>
            </tr>
          </thead>
          <tbody>
            <?php // stmt es una variable que contiene la consulta a la base de datos statement
              $stmt = $pdo->query("SELECT * FROM estudiantes ORDER BY nombre_apellido DESC"); // Consulta para obtener los alumnos registrados
              while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // fetch asocia los resultados a un array asociativo
                echo "<tr>
                        <td>".htmlspecialchars($row['nombre_apellido'])."</td>
                        <td>".htmlspecialchars($row['id'])."</td>
                        <td>".htmlspecialchars($row['correo'])."</td>
                        <td>".htmlspecialchars($row['telefono'])."</td>
                        <td>".htmlspecialchars($row['curso'])."</td>
                        <td>".htmlspecialchars($row['fecha_nacimiento'])."</td>
                        <td>{$row['fecha_registro']}</td>
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