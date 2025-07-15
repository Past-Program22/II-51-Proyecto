<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="es">
<link rel="stylesheet" href="c.administrativo.css">

<head>
  <meta charset="UTF-8">
  <title>Registro de Alumnos</title>
</head>

<body>
    <h2>Registro de Alumnos</h2>
    <form action="procesar.php" method="POST"> <!-- Formulario para registrar alumnos -->

      <div>
        <label>Nombre/Apellido:</label>
        <input type="text" name="nombre_apellido">
      </div>
      <div>
        <label>Identificación:</label>
        <input type="id" name="id">
      </div>
      <div>
        <label>Correo electrónico:</label>
        <input type="email" name="correo">
      </div>
      <div>
        <label>Teléfono:</label>
        <input type="numbers" name="telefono">
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

    <table>
      <thead>
        <tr>
          <th>Nombre/Apellido</th>
          <th>ID</th>
          <th>Correo</th>
          <th>Teléfono</th>
          <th>Curso</th>
          <th>Fecha de Nacimiento</th>
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
</body>
</html>