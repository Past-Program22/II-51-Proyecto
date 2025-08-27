// Configura tu conexión a Supabase
const supabaseUrl = "https://eqshgpdmjrywpfhmacnm.supabase.co";
const supabaseKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVxc2hncGRtanJ5d3BmaG1hY25tIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTMzMjA1ODMsImV4cCI6MjA2ODg5NjU4M30.b592fmNOienQHwWly5zu49bDV3peVGzfwR8FHJ5a8Eo";
const supabase = window.supabase.createClient(supabaseUrl, supabaseKey);

// Login con email y contraseña
async function login() {
  const email = document.getElementById("username").value;
  const password = document.getElementById("password").value;

  const { data, error } = await supabase.auth.signInWithPassword({
    email: email,
    password: password
  });

  if (error) {
    document.getElementById("error").style.display = "block";
    setTimeout(() => {
      document.getElementById("error").style.display = "none";
    }, 3000);
  } else {
    window.location.href = "Proyecto II-51/Inicio.html";
  }
}

// Login con Google
async function loginWithGoogle() {
  const { data, error } = await supabase.auth.signInWithOAuth({
    provider: 'google',
    options: {
      redirectTo: window.location.origin + "/Proyecto II-51/Inicio.html"
    }
  });

  if (error) {
    alert("Error al iniciar con Google: " + error.message);
  }
}

// Ocultar error cuando el usuario empiece a escribir
document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("username").addEventListener("input", () => {
    document.getElementById("error").style.display = "none";
  });

  document.getElementById("password").addEventListener("input", () => {
    document.getElementById("error").style.display = "none";
  });

  // Año dinámico
  document.getElementById('year').textContent = new Date().getFullYear();
});
