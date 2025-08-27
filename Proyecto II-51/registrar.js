// Configuración de Supabase
const supabaseUrl = "https://eqshgpdmjrywpfhmacnm.supabase.co";
const supabaseKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVxc2hncGRtanJ5d3BmaG1hY25tIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTMzMjA1ODMsImV4cCI6MjA2ODg5NjU4M30.b592fmNOienQHwWly5zu49bDV3peVGzfwR8FHJ5a8Eo";
const supabase = window.supabase.createClient(supabaseUrl, supabaseKey);

document.getElementById("registroForm").addEventListener("submit", async (e) => {
  e.preventDefault();

  const nombre = document.getElementById("exampleInputName").value;
  const email = document.getElementById("exampleInputEmail1").value;
  const password = document.getElementById("exampleInputPassword1").value;
  const confirmPassword = document.getElementById("exampleInputPassword2").value;

  if (password !== confirmPassword) {
    alert("Las contraseñas no coinciden.");
    return;
  }

  // Crear usuario en auth.users
  const { data, error } = await supabase.auth.signUp({
    email: email,
    password: password
  });

  if (error) {
    alert("Error al registrar: " + error.message);
    return;
  }

  // Insertar datos extra en tabla perfiles
  const userId = data.user.id;
  const { error: perfilError } = await supabase.from("perfiles").insert([
    { id: userId, nombre: nombre }
  ]);

  if (perfilError) {
    alert("Error al guardar perfil: " + perfilError.message);
    return;
  }

  alert("Registro exitoso. Ahora puede iniciar sesión.");
  window.location.href = "../index.html";
});