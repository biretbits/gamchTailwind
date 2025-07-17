<?php require("vista/esquema/header.php"); ?>
<div class="min-h-screen bg-cover bg-center" style="background-image: url('imagenes/bosque.jpg');">
  <div class="flex flex-col items-center justify-center min-h-screen px-4">
    <div id="login-box" class="bg-white rounded-lg shadow-lg w-full max-w-md p-8">

      <div class="mb-6">
        <h4 class="text-gray-500 text-2xl font-normal mb-0 text-center">Login</h4>
      </div>

      <div class="space-y-4 mb-6">
        <div class="bg-blue-600 hover:bg-blue-700 rounded shadow flex items-center cursor-pointer">
          <a href="#" class="flex items-center w-full px-4 py-3 text-white font-semibold">
            <i class="fa fa-facebook text-2xl mr-4 pl-4" style="width:56px;"></i>Login with Facebook
          </a>
        </div>
        <div class="bg-red-600 hover:bg-red-700 rounded shadow flex items-center cursor-pointer">
          <a href="#" class="flex items-center w-full px-4 py-3 text-white font-semibold">
            <i class="fa fa-google text-2xl mr-4" style="width:56px;"></i>Login with Google+
          </a>
        </div>
      </div>

      <div class="flex items-center justify-center mb-6">
        <div class="flex-grow border-t border-gray-300"></div>
        <p class="px-4 text-gray-400 font-normal">or</p>
        <div class="flex-grow border-t border-gray-300"></div>
      </div>

      <div class="bg-white">
        <div class="mb-4 relative">
          <input
            type="text"
            id="usuario"
            name="usuario"
            placeholder="Usuario"
            class="w-full px-4 py-3 border border-gray-300 rounded text-black focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
          <span id="grupo_user" class="absolute right-3 top-3"></span>
        </div>
        <span id="text_user" class="block mb-4 text-sm text-red-500"></span>

        <div class="mb-4 relative flex items-center">
          <input
            type="password"
            id="contrasena"
            name="contrasena"
            placeholder="Contraseña"
            class="w-full px-4 py-3 border border-gray-300 rounded text-black focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
          <button
            type="button"
            id="che"
            onclick="mostrar()"
            class="absolute right-2 p-2 text-gray-600 hover:text-gray-900 focus:outline-none"
            aria-label="Mostrar contraseña"
          >
            <i class="fas fa-eye"></i>
          </button>
        </div>

        <div class="mb-2">
          <a
            role="button"
            id="submit-id-submit"
            onclick="VerificarDatos();"
            class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded shadow cursor-pointer"
          >
            Login
          </a>
        </div>

        <div class="flex justify-between items-center text-sm text-gray-600">
          <label class="inline-flex items-center cursor-pointer">
            <input
              type="checkbox"
              id="formCheck-1"
              name="check"
              class="form-checkbox text-blue-600"
            >
            <span class="ml-2 select-none">Remember Me</span>
          </label>
          <a href="#" class="hover:underline">Forgot Password?</a>
        </div>
      </div>

      <div id="login-box-footer" class="pt-4 pb-6 text-center text-gray-600 text-sm">
        <p>
          Don't you have an account?
          <a id="register-link" href="#" class="text-blue-600 hover:underline">Sign Up!</a>
        </p>
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
  document.querySelector('#contrasena').addEventListener('keypress', function(e) { validar(e); });
  document.querySelector('#usuario').addEventListener('keypress', function(e) { validar(e); });

  function validar(e) {
    let tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 13) VerificarDatos();
  }

  function mostrar() {
    var contrasena = document.getElementById("contrasena");
    if (contrasena.type === 'password') {
      contrasena.type = 'text';
    } else {
      contrasena.type = 'password';
    }
  }

  function VerificarDatos(){
    var usuario = document.getElementById("usuario").value;
    var contrasena = document.getElementById("contrasena").value;
    var datos = new FormData();
    datos.append("usuario", usuario);
    datos.append("contrasena", contrasena);

    $.ajax({
      type: "POST",
      cache: false,
      url: "/vcu",
      datatype: "html",
      data: datos,
      contentType: false,
      processData: false,
      success: function(r){
        r = $.trim(r);
        console.log(r);
        if(r == "correcto"){
          alertCorrecto();
        } else {
          Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: '¡Hubo un problema al iniciar sesión!',
            showConfirmButton: false,
            timer: 1500
          });
        }
      },
      error: function(r){
        alert("Ocurrió un error: " + JSON.stringify(r));
      }
    });
  }

  function alertCorrecto(){
    Swal.fire({
      icon: 'success',
      title: '¡Bienvenido!',
      text: '¡Inicio de sesión correcto!',
      showConfirmButton: false,
      timer: 1500
    });
    IRalLink();
  }

  function IRalLink(){
    setTimeout(() => {
      location.href="/panel";
    }, 1500);
  }
</script>

<?php require("vista/esquema/footeruni.php"); ?>
