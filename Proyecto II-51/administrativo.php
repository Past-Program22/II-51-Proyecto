<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="es">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="administrativo.css">

  <head>
    <meta charset="UTF-8">
    <title>Proyecto II-51 / Complemento Administrativo</title>
  </head>

  <header>
    <div class="texto-header">
      <div class="menu-admin">
        <button class="admin-btn">
          <i class="fas fa-bars"></i>
        </button>
        <div class="dropdown-1">
          <a href="administrativo.php"><i class="fa-solid fa-file"></i> Form Cursos</a>
          <a href="docentes.php"><i class="fa-solid fa-file"></i> Docentes</a>
          <a href="estudiantes.php"><i class="fa-solid fa-file"></i> Estudiantes</a>
        </div>
      </div>
      <div class="titulo-contenido">
        <h1>Formulario de Cursos</h1>
        <p>Cursos de la Plataforma Educativa Universidad Central</p>
      </div>
    </div> <!-- Cierra texto-header -->

    <!-- Contenedor para los menús de la derecha -->
    <div class="menus-derecha">
      <div class="menu-tablas">
        <button class="tablas-btn">
          <i class="fa-solid fa-list"></i>
        </button>
        <div class="dropdown-2">
          <a href="cursos.php"><i class="fas fa-book"></i> Tabla Cursos</a>
          <hr>
          <a href="docentes.php"><i class="fas fa-chalkboard-teacher"></i> Tabla Docentes</a>
          <a href="estudiantes.php"><i class="fas fa-user-graduate"></i> Tabla Estudiantes</a>
        </div>
      </div> <!-- Cierra menu-tablas -->

      <div class="menu-usuario">
        <button class="usuario-btn">
          <i class="fas fa-user"></i>
          <i class="fas fa-chevron-down"></i>
        </button>
        <div class="dropdown-3">
          <a href="inicio.html"><i class="fas fa-circle-xmark"></i> Salir</a>
          <a href="estilos.html"><i class="fas fa-paint-brush"></i> Estilos</a>
          <hr>
          <a href="../index.html"><i class="fas fa-arrow-right-from-bracket"></i> Cerrar sesión</a>
        </div>
      </div> <!-- Cierra menu-usuario -->
    </div>
    
  </header>

  <body>
    <div class="wrapper">
      <main>
        <div class="form-wrap">
          <h2>Registro de Cursos</h2>
          <form action="procesar.php" method="POST"> <!-- Formulario para registrar cursos -->

            <div>
              <label>Nombre del Curso:</label>
              <input type="text" name="nombre_curso">
            </div>
            <div>
              <label>Créditos:</label>
              <input type="text" name="creditos">
            </div>
            <div>
              <label>Nombre del Docente:</label>
              <input type="text" name="docente">
            </div>
            <div>
              <label>Código del Curso:</label>
              <input type="text" name="codigo">
            </div>
            <button type="submit">Enviar</button>
            <!-- Botón para enviar el formulario se encargar de disparar la informacion -->
          </form>
        </div>
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