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
          <a href="#" onclick="showForm('cursos')" class="menu-item" data-form="cursos"><i class="fa-solid fa-book"></i> Form Cursos</a>
          <a href="#" onclick="showForm('docentes')" class="menu-item" data-form="docentes"><i class="fa-solid fa-chalkboard-teacher"></i> Form Docentes</a>
          <a href="#" onclick="showForm('estudiantes')" class="menu-item" data-form="estudiantes"><i class="fa-solid fa-user-graduate"></i> Form Estudiantes</a>
        </div>
      </div>
      <div class="titulo-contenido">
        <h1 id="form-title">Formulario de Cursos</h1>
        <p id="form-description">Gestión de Cursos Universitarios</p>
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
          <h2 id="form-heading">Registro de Cursos</h2>

          <!-- Formulario para registrar cursos -->
          <form action="procesar_cursos.php?accion=insertar" method="POST" class="form-container">
            <div class="form-group">
              <label>Nombre del Curso:</label>
              <input type="text" name="nombre_curso" required>
            </div>
            <div class="form-group">
              <label>Créditos:</label>
              <input type="text" name="creditos" required>
            </div>
            <div class="form-group">
              <label>Nombre del Docente:</label>
              <input type="text" name="docente" required>
            </div>
            <div class="form-group">
              <label>Código del Curso:</label>
              <input type="text" name="codigo" required>
            </div>
            <button type="submit" class="submit-btn"><i class="fas fa-save"></i> Registrar Curso</button>
            <!-- Botón para enviar el formulario se encarga de disparar la informacion -->
          </form>

          <!-- Formulario de Docentes -->
          <form id="form-docentes" action="procesar_docentes.php" method="POST" class="form-container">
            <div class="form-group">
              <label>Nombre Completo:</label>
              <input type="text" name="nombre_apellido" required>
            </div>
            <div class="form-group">
              <label>Identificación:</label>
              <input type="text" name="id" required>
            </div>
            <div class="form-group">
              <label>Correo Electrónico:</label>
              <input type="email" name="correo" required>
            </div>
            <div class="form-group">
              <label>Teléfono:</label>
              <input type="tel" name="telefono" required>
            </div>
            <div class="form-group">
              <label>Curso:</label>
              <input type="text" name="curso" required>
            </div>
            <button type="submit" class="submit-btn"><i class="fas fa-user-plus"></i> Registrar Docente</button>
          </form>

          <!-- Formulario de Estudiantes -->
          <form id="form-estudiantes" action="procesar_estudiantes.php" method="POST" class="form-container">
            <div class="form-group">
              <label>Nombre Completo:</label>
              <input type="text" name="nombre_apellido" required>
            </div>
            <div class="form-group">
              <label>Identificación:</label>
              <input type="text" name="id" required>
            </div>
            <div class="form-group">
              <label>Correo Electrónico:</label>
              <input type="email" name="correo" required>
            </div>
            <div class="form-group">
              <label>Teléfono:</label>
              <input type="tel" name="telefono" required>
            </div>
            <div class="form-group">
              <label>Curso:</label>
              <select name="curso" required>
                <option value="">Seleccione una carrera</option>
                <option value="Ciencia de Datos">Ciencia de Datos</option>
                <option value="Diseño Gráfico">Diseño Gráfico</option>
                <option value="Economía para Ingeniería">Economía para Ingeniería</option>
                <option value="Marketing Digital">Marketing Digital</option>
                <option value="Matemáticas I">Matemáticas I</option>
                <option value="Organización de Archivos">Organización de Archivos</option>
                <option value="Programación Internet">Programación Internet</option>
                <option value="Telemática I">Telemática I</option>
              </select>
            </div>
            <div class="form-group">
              <label>Fecha de Nacimiento:</label>
              <input type="date" name="fecha_nacimiento" required>
            </div>
            <button type="submit" class="submit-btn"><i class="fas fa-graduation-cap"></i> Registrar Estudiante</button>
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
    // Función para mostrar el form que seleccionamos
    function showForm(formType) {
      // Ocultar todos los formularios
      const forms = document.querySelectorAll('.form-container');
      forms.forEach(form => form.style.display = 'none');
      
      // Remover clase activa de todos los elementos del menú
      const menuItems = document.querySelectorAll('.menu-item');
      menuItems.forEach(item => item.classList.remove('menu-item-active'));
      
      // Mostrar el formulario seleccionado
      const targetForm = document.getElementById(`form-${formType}`);
      if (targetForm) {
        targetForm.style.display = 'block';
        targetForm.style.animation = 'slideInUp 0.6s ease';
      }
      
      // Activar elemento del menú
      const activeMenuItem = document.querySelector(`[data-form="${formType}"]`);
      if (activeMenuItem) {
        activeMenuItem.classList.add('menu-item-active');
      }
      
      // Actualizar títulos según el formulario
      const titles = {
        cursos: {
          title: 'Formulario de Cursos',
          description: 'Gestión de Cursos Universitarios',
          heading: 'Registro de Cursos'
        },
        docentes: {
          title: 'Formulario de Docentes',
          description: 'Gestión del Personal Docente',
          heading: 'Registro de Docentes'
        },
        estudiantes: {
          title: 'Formulario de Estudiantes',
          description: 'Gestión de Estudiantes Universitarios',
          heading: 'Registro de Estudiantes'
        }
      };
      
      if (titles[formType]) {
        document.getElementById('form-title').textContent = titles[formType].title;
        document.getElementById('form-description').textContent = titles[formType].description;
        document.getElementById('form-heading').textContent = titles[formType].heading;
      }
      
      // Cerrar dropdown después de seleccionar
      const dropdown = document.querySelector('.dropdown-1');
      if (dropdown) {
        dropdown.style.opacity = '0';
        dropdown.style.visibility = 'hidden';
        dropdown.style.transform = 'translateY(-10px)';
        
        setTimeout(() => {
          dropdown.style.opacity = '';
          dropdown.style.visibility = '';
          dropdown.style.transform = '';
        }, 300);
      }
    }

    // Activar el primer elemento por defecto
    document.addEventListener('DOMContentLoaded', function() {
      const firstMenuItem = document.querySelector('[data-form="cursos"]');
      if (firstMenuItem) {
        firstMenuItem.classList.add('menu-item-active');
      }
    });

    // Año dinámico
    document.getElementById("year").textContent = new Date().getFullYear();
  </script>
  
</html>