<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="es">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="c.administrativo.css">

  <head>
    <meta charset="UTF-8">
    <title>Registro de Alumnos</title>
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
      <img src="https://connect-campus.uc.ac.cr/pluginfile.php/1/core_admin/logo/0x200/1736778698/uc-logo.png"
      alt="Logo Carlos Arce" class="logo-ca" />
      <div class="titulo-contenido">
        <h1>Menú</h1>
        <p>Acceso a la Plataforma Educativa Universidad Central</p>
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
          <h2>Registro de Alumnos</h2>
          <form action="procesar.php" method="POST"> <!-- Formulario para registrar alumnos -->

            <div>
              <label>Nombre/Apellido:</label>
              <input type="text" name="nombre_apellido">
            </div>
            <div>
              <label>Identificación:</label>
              <input type="text" name="id">
            </div>
            <div>
              <label>Correo electrónico:</label>
              <input type="email" name="correo">
            </div>
            <div>
              <label>Teléfono:</label>
              <input type="tel" name="telefono">
            </div>
            <div>
              <label>Curso:</label>
              <input type="text" name="curso">
            </div>
            <div>
              <label>Fecha de nacimiento:</label>
              <input type="date" name="fecha_nacimiento">
            </div>
            <button type="submit">Enviar</button>
            <!-- Botón para enviar el formulario se encargar de disparar la informacion -->
          </form>
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