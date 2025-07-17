<?php
require_once('vista/esquema/header.php');
?>


    <div class="container mx-auto mt-10">
        <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-center mb-6">Gestión de Base de Datos</h2>

            <!-- Botón para exportar -->
            <div class="mb-6">
                <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300"
                        onclick="exportar()">
                    <i class="fas fa-download mr-2"></i> Exportar Base de Datos
                </button>
            </div>
            <!-- Campo de texto para importar -->
            <div class="mb-6">
                <label for="archivo_importar" class="block text-sm font-medium text-gray-700 mb-2">
                    Selecciona un archivo para importar
                </label>
                <input type="file" id="archivo_importar" name="archivo_importar"
                    accept=".sql"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 py-2 px-4">
            </div>

            <!-- Botón para importar -->
            <div class="mb-6">
                <button type="button"
                    class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition duration-300"
                    onclick="importar(event)">
                    <i class="fas fa-upload mr-2"></i> Importar Base de Datos
                </button>
            </div>

        </div>
    </div>

<script type="text/javascript">
  function exportar(){
    window.location.href = '/exportarBd';
  }
  function importar(e) {
      e.preventDefault(); // Evita que el botón recargue la página

      const fileInput = document.getElementById('archivo_importar');
      const file = fileInput.files[0];

      if (!file) {
            alertaValidacion('error','Seleccione un archivo por favor.',"Error");
            document.getElementById('archivo_importar').value = '';
          return;
      }

      const extension = file.name.split('.').pop().toLowerCase();
      if (extension !== 'sql') {

          alertaValidacion('error','Solo se permiten archivos con extensión .sql',"Error");
          document.getElementById('archivo_importar').value = '';
          return;
      }

      const formData = new FormData();
      formData.append('file', file);

      $.ajax({
          url: '/ImportarBD',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            console.log(response);
              if (response.trim() === 'Correcto') {
                  alertaValidacion('success','Se importó correctamente','Correcto');
                  document.getElementById('archivo_importar').value = '';
              } else {
                  alertaValidacion('error',response,"Error");
                  document.getElementById('archivo_importar').value = '';
              }
          },
          error: function () {
              alertaValidacion('error','Error al subir el archivo','Error');
              document.getElementById('archivo_importar').value = '';
          }
      });
  }

     function alertaValidacion(icono,texto,titulo){
      Swal.fire({
       icon: icono,
       title: titulo,
       text: texto,
       showConfirmButton: false,
       timer: 2000
     });
     }
</script>

<?php
require_once('vista/esquema/footeruni.php');
?>
