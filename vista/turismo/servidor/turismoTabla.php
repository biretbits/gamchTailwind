<?php
// Incluir el archivo header.php desde la carpeta diseno

require_once('vista/esquema/header.php');
?>
<br>
<div class="bg-orange-500">
  <div class="container mx-auto flex flex-wrap items-center justify-between p-4">
    <!-- Botón menú -->
    <button
      id="openOffcanvasBtn"
      class="flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded"
      type="button"
      aria-controls="offcanvasWithBackdrop"
      aria-expanded="false"
    >
      MENU PANEL
    </button>

    <!-- Título, centrado en móviles y con flex-grow en desktop -->
    <h1 class="text-white text-xl font-semibold text-center flex-grow mt-2 sm:mt-0">
      Alcaldía Municipal de Challapata
    </h1>

    <!-- Dropdown usuario -->
    <div class="relative inline-block text-left mt-2 sm:mt-0">
      <button
        id="userMenu"
        type="button"
        class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-800 text-white rounded"
        aria-expanded="false"
        aria-haspopup="true"
      >
        <i class="fas fa-user-circle mr-2"></i>
        <span id="username">Administrador</span>
        <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>

      <ul
        id="userMenuDropdown"
        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden"
        role="menu"
        aria-orientation="vertical"
        aria-labelledby="userMenu"
      >
        <li>
          <a href="#" id="logout" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100" role="menuitem">
            <i class="fas fa-sign-out-alt mr-2"></i>Cerrar sesión
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>

<div class="content">
  <div class="container mx-auto px-4">
    <div class="flex flex-col md:flex-row items-center py-4 text-black">
      <h5 class="text-lg font-semibold">TURISMO</h5>
    </div>
    <div class="border rounded shadow-sm p-4 bg-white">
      <input type="hidden" name="paginas" id="paginas" value="">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <!-- Selección de Páginas -->
        <div class="flex flex-col">
          <label for="selectPage" class="form-label"></label>
          <select class="form-select py-2 px-4 border rounded-md" id="selectList" onchange="BuscarUsuarios(1)" name="selectList">
            <option>Seleccione Listar</option>
            <option>5</option>
            <option>10</option>
            <option>25</option>
            <option>50</option>
            <option>100</option>
            <option>250</option>
            <option>500</option>
            <option>1000</option>
          </select>
        </div>

        <!-- Botón para Nuevo -->
        <div class="flex flex-col">
          <button type="button" class="py-2 px-4 bg-blue-500 text-white rounded-md shadow-sm hover:bg-blue-600"
            onclick="openModal();accionBtnEditar({
              id: '',
              nombre_destino: '',
              tipo_destino: '',
              descripcion: '',
              actividades_disponibles: '',
              ubicacion: '',
              contacto: '',
              enlace_web: '',
              imagen_url: ''
            })"
            data-bs-toggle="modal" data-bs-target="#ModalRegistro">
            <i class="fas fa-plus-circle"></i> Nuevo
          </button>
        </div>

        <!-- Campo de Búsqueda -->
        <div class="flex flex-col col-span-2 md:col-span-1">
          <input type="text" class="form-input py-2 px-4 border rounded-md" placeholder="Buscar..." id="buscar" onkeyup="BuscarUsuarios(1)">
        </div>
      </div>

      <!-- Modal -->
      <div id="ModalRegistro" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4 text-center">
          <div class="relative w-full max-w-2xl bg-white rounded-lg shadow-lg">
            <!-- Modal Header -->
            <div class="flex justify-between items-center p-4 border-b">
              <h6 class="text-gray-700 font-semibold" id="miModalRegistro">TURISMO</h6>
              <button type="button" class="text-gray-500 hover:text-gray-700" onclick="closeModal()">
                <i class="fas fa-times"></i>
              </button>
            </div>

            <!-- Modal Body -->
            <div class="p-4">
              <form>
                <input type="hidden" name="id" id='id' value="">

                <!-- Nombre del destino -->
                <div class="mb-4">
                  <label for="nombre_destino" class="text-sm font-semibold">Nombre del destino</label>
                  <input type="text" class="form-input w-full px-4 py-2 border rounded-md" id="nombre_destino" name='nombre_destino' placeholder="Ponga el destino" required>
                </div>

                <!-- Descripción -->
                <div class="mb-4">
                  <label for="descripcion" class="text-sm font-semibold">Ponga descripción</label>
                  <textarea name="descripcion" rows="8" class="form-input w-full px-4 py-2 border rounded-md" id="descripcion" placeholder="Ponga descripción"></textarea>
                </div>

                <!-- Tipo de destino -->
                <div class="mb-4">
                  <label for="tipo_destino" class="text-sm font-semibold">Tipo de destino</label>
                  <select name="tipo_destino" id="tipo_destino" class="form-select py-2 px-4 border rounded-md">
                    <option value="">-- Selecciona un tipo --</option>
                    <option value="Playa">Playa</option>
                    <option value="Montaña">Montaña</option>
                    <option value="Ciudad">Ciudad</option>
                    <option value="Campo">Campo / Rural</option>
                    <option value="Historico">Histórico / Cultural</option>
                    <option value="Aventura">Aventura</option>
                    <option value="Ecoturismo">Ecoturismo</option>
                    <option value="Religioso">Religioso</option>
                    <option value="Gastronomico">Gastronómico</option>
                    <option value="Deportivo">Deportivo</option>
                    <option value="Balneario">Balneario / Spa</option>
                    <option value="Reserva">Reserva natural / Parque nacional</option>
                    <option value="Festival">Festival / Evento especial</option>
                    <option value="Nieve">Nieve / Esquí</option>
                    <option value="Isla">Isla</option>
                  </select>
                </div>

                <!-- Actividades disponibles -->
                <div class="mb-4">
                  <label for="actividades_disponibles" class="text-sm font-semibold">Actividades disponibles</label>
                  <textarea name="actividades_disponibles" rows="8" class="form-input w-full px-4 py-2 border rounded-md" id="actividades_disponibles" placeholder="Ponga las actividades"></textarea>
                </div>

                <!-- Ubicación -->
                <div class="mb-4">
                  <label for="ubicacion" class="text-sm font-semibold">Ubicación</label>
                  <input type="text" class="form-input w-full px-4 py-2 border rounded-md" id="ubicacion" name='ubicacion' placeholder="Ponga la Ubicación" required>
                </div>

                <!-- Contacto -->
                <div class="mb-4">
                  <label for="contacto" class="text-sm font-semibold">Contacto</label>
                  <input type="number" class="form-input w-full px-4 py-2 border rounded-md" id="contacto" name='contacto' placeholder="Ponga el contacto" required>
                </div>

                <!-- Enlace web -->
                <div class="mb-4">
                  <label for="enlace_web" class="text-sm font-semibold">Enlace web</label>
                  <input type="text" class="form-input w-full px-4 py-2 border rounded-md" id="enlace_web" name='enlace_web' placeholder="Ponga el enlace web" required>
                </div>

                <!-- Imagen -->
                <div class="mb-4">
                  <label for="imagen_url" class="text-sm font-semibold">Seleccione una imagen</label>
                  <input type="file" class="form-input w-full px-4 py-2 border rounded-md" accept=".jpg, .jpeg, .png" id="imagen_url" name='imagen_url' required>
                </div>
              </form>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end space-x-2 p-4 border-t">
              <button type="button" class="btn py-2 px-4 bg-blue-500 text-white rounded-md hover:bg-blue-600" onclick="registrar()">
                <i class="fas fa-save"></i> Guardar
              </button>
              <button type="button" class="btn py-2 px-4 bg-red-500 text-white rounded-md hover:bg-red-600" onclick="closeModal()">
                <i class="fas fa-times"></i> Cerrar
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Tabla -->
      <br>
      <div class="verDatos" id="verDatos">
        <div class="overflow-x-auto">
          <table class="table-auto w-full text-sm text-left border-collapse">
            <thead>
              <tr>
                <th class="px-4 py-2 border">N°</th>
                <th class="px-4 py-2 border">Nombre destino</th>
                <th class="px-4 py-2 border">Tipo de Destino</th>
                <th class="px-4 py-2 border">Descripción</th>
                <th class="px-4 py-2 border">Ubicación</th>
                <th class="px-4 py-2 border">Contacto</th>
                <th class="px-4 py-2 border">Imagen</th>
                <th class="px-4 py-2 border">Enlace web</th>
                <th class="px-4 py-2 border">Creado en</th>
                <th class="px-4 py-2 border">Actualizado en</th>
                <th class="px-4 py-2 border">Acción</th>
              </tr>
            </thead>
            <tbody>
              <?php
      if ($resul && mysqli_num_rows($resul) > 0) {
        $i = $inicioList;
        while($fi = mysqli_fetch_array($resul)){
            echo "<tr class='border-b'>";
              echo "<td class='px-4 py-2'>" . ($i+1) . "</td>";
              echo "<td class='px-4 py-2'>" . htmlspecialchars($fi['nombre_destino']) . "</td>";
              echo "<td class='px-4 py-2'>" . htmlspecialchars($fi['tipo_destino']) . "</td>";
              echo "<td class='px-4 py-2'>";
              // Mostrar la descripción con una limitación de 2 líneas usando line-clamp
              echo "<p id='descripcion-" . $fi['id'] . "' class='text-sm text-gray-500 mt-2 line-clamp-2'>";
              echo htmlspecialchars($fi['descripcion']);
              echo "</p>";
              // Botón para alternar entre "ver más" y "ver menos"
              echo "<button id='verMasBtn-" . $fi['id'] . "' class='text-blue-500 hover:text-blue-700 mt-2' onclick='toggleDescripcion(" . $fi['id'] . ")'>Ver más</button>";
              echo "</td>";
              echo "<td class='px-4 py-2'>" . htmlspecialchars($fi['ubicacion']) . "</td>";
              echo "<td class='px-4 py-2'>" . htmlspecialchars($fi['contacto']) . "</td>";

              // Mostrar imagen si existe
              if (!empty($fi['imagen_url'])) {
                  echo "<td class='px-4 py-2'><img src='" . htmlspecialchars($fi['imagen_url']) . "' alt='Imagen' class='max-w-[100px]'></td>";
              } else {
                  echo "<td class='px-4 py-2'>Sin imagen</td>";
              }

              echo "<td class='px-4 py-2'>" . htmlspecialchars($fi['enlace_web']) . "</td>";
              echo "<td class='px-4 py-2'>" . $fi['creado_en'] . "</td>";
              echo "<td class='px-4 py-2'>" . $fi['actualizado_en'] . "</td>";
              echo "<td class='px-4 py-2'>";
              $id_u = '';
              $datos = [
                "id" => $fi["id"],
                "nombre_destino" => addslashes($fi["nombre_destino"]),
                "tipo_destino" => addslashes($fi["tipo_destino"]),
                "descripcion" => addslashes($fi["descripcion"]),
                "actividades_disponibles" => addslashes($fi["actividades_disponibles"]),
                "ubicacion" => addslashes($fi["ubicacion"]),
                "contacto" => addslashes($fi["contacto"]),
                "enlace_web" => addslashes($fi["enlace_web"]),
                "imagen_url" => addslashes($fi["imagen_url"])
              ];

              echo "<div class='inline-block'>";
              echo '<button type="button" class="btn btn-info btn-sm shadow-sm px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded-lg" title="Editar"
                      data-bs-toggle="modal" data-bs-target="#ModalRegistro"
                      onclick=\'openModal();accionBtnEditar(' . json_encode($datos) . ')\' >
                      <i class="fas fa-edit"></i> Editar
                  </button>';
              echo "</div>";

              echo "</td>";
            echo "</tr>";
            $i++;
        }
      } else {
        echo "<tr class='border-b'>";
        echo "<td colspan='15' class='text-center py-4'>No se encontraron resultados</td>";
        echo "</tr>";
      }
      ?>
      </tbody>
      </table>
      </div>
      <?php
  if ($TotalPaginas != 0) {
      $adjacents = 1;
      $anterior = "&lsaquo; Anterior";
      $siguiente = "Siguiente &rsaquo;";

      echo "<div class='row'>
              <div class='col'>";

      echo "<div class='flex flex-wrap justify-between items-center mb-6 bg-gray-100 rounded-lg'>";

      // Información de la página
      echo '<ul class="pagination text-gray-600 text-sm flex items-center space-x-3">';
      echo "Página &nbsp;".$pagina."&nbsp;de&nbsp;".$TotalPaginas."&nbsp;con&nbsp;";
      echo '<li class="active text-white bg-blue-600 px-1 py-1"><span class="page-link">'.($TotalPaginas).'</span></li>';
      echo " &nbsp;de&nbsp;".$num_filas_total." registros";
      echo '</ul>';


      echo '<ul class="pagination flex space-x-2 items-center justify-center bg-gray-100 p-3 rounded-lg shadow-lg">';

      // Primer botón (<<)
      if ($pagina != 1) {
          echo "<li class='page-item'>
                  <a class='page-link text-blue-600 hover:bg-blue-500 hover:text-white transition duration-300 ease-in-out transform hover:scale-110 py-2 px-4 rounded-lg'
                     onclick=\"BuscarUsuarios(1)\"><span aria-hidden='true'>&laquo;</span></a>
                </li>";
      }

      // Botón anterior
      if ($pagina == 1) {
          echo "<li class='page-item'><a class='page-link text-gray-400 cursor-not-allowed py-2 px-4 rounded-lg'>$anterior</a></li>";
      } else if ($pagina == 2) {
          echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarUsuarios(1)\"
                  class='page-link text-blue-600 hover:bg-blue-500 hover:text-white transition duration-300 ease-in-out py-2 px-4 rounded-lg'>$anterior</a></li>";
      } else {
          echo "<li class='page-item'>
                  <a href='javascript:void(0);' class='page-link text-blue-600 hover:bg-blue-500 hover:text-white transition duration-300 ease-in-out py-2 px-4 rounded-lg'
                     onclick=\"BuscarUsuarios($pagina-1)\">$anterior</a>
                </li>";
      }

      // Enlace de la primera página
      if ($pagina > ($adjacents + 1)) {
          echo "<li class='page-item'>
                  <a href='javascript:void(0);' class='page-link text-blue-600 hover:bg-blue-500 hover:text-white transition duration-300 ease-in-out py-2 px-4 rounded-lg'
                     onclick=\"BuscarUsuarios(1)\">1</a>
                </li>";
      }

      // Intervalo
      if ($pagina > ($adjacents + 2)) {
          echo "<li class='page-item'>
                  <span class='page-link py-2 px-4 text-gray-400'>...</span>
                </li>";
      }

      // Páginas cercanas
      $pmin = ($pagina > $adjacents) ? ($pagina - $adjacents) : 1;
      $pmax = ($pagina < ($TotalPaginas - $adjacents)) ? ($pagina + $adjacents) : $TotalPaginas;

      for ($i = $pmin; $i <= $pmax; $i++) {
          if ($i == $pagina) {
              echo "<li class='page-item'>
                      <span class='page-link text-white bg-blue-600 py-2 px-4 rounded-lg'>$i</span>
                    </li>";
          } else {
              echo "<li class='page-item'>
                      <a href='javascript:void(0);' class='page-link text-blue-600 hover:bg-blue-500 hover:text-white transition duration-300 ease-in-out py-2 px-4 rounded-lg'
                         onclick=\"BuscarUsuarios($i)\">$i</a>
                    </li>";
          }
      }

      // Intervalo
      if ($pagina < ($TotalPaginas - $adjacents - 1)) {
          echo "<li class='page-item'>
                  <span class='page-link py-2 px-4 text-gray-400'>...</span>
                </li>";
      }

      // Enlace de la última página
      if ($pagina < ($TotalPaginas - $adjacents)) {
          echo "<li class='page-item'>
                  <a href='javascript:void(0);' class='page-link text-blue-600 hover:bg-blue-500 hover:text-white transition duration-300 ease-in-out py-2 px-4 rounded-lg'
                     onclick=\"BuscarUsuarios($TotalPaginas)\">$TotalPaginas</a>
                </li>";
      }

      // Botón siguiente
      if ($pagina < $TotalPaginas) {
          echo "<li class='page-item'>
                  <a href='javascript:void(0);' class='page-link text-blue-600 hover:bg-blue-500 hover:text-white transition duration-300 ease-in-out py-2 px-4 rounded-lg'
                     onclick=\"BuscarUsuarios($pagina+1)\">$siguiente</a>
                </li>";
      } else {
          echo "<li class='page-item'>
                  <a class='page-link text-gray-400 cursor-not-allowed py-2 px-4 rounded-lg'>$siguiente</a>
                </li>";
      }

      // Última página (>>)
      if ($pagina != $TotalPaginas) {
          echo "<li class='page-item'>
                  <a class='page-link text-blue-600 hover:bg-blue-500 hover:text-white transition duration-300 ease-in-out py-2 px-4 rounded-lg'
                     onclick=\"BuscarUsuarios($TotalPaginas)\"><span aria-hidden='true'>&raquo;</span></a>
                </li>";
      }

      echo "</ul>";
      echo "</div>";

      echo "</div>
      </div>";
  }
  ?>

    </div>

    </div>
  </div>

  </div>
 <?php
 // Incluir el archivo footer.php desde la carpeta diseno
 require_once('vista/esquema/footeruni.php');
 ?>
<script type="text/javascript">
function openModal() {
  document.getElementById("ModalRegistro").classList.remove("hidden");
}

function closeModal() {
  document.getElementById("ModalRegistro").classList.add("hidden");
}
function BuscarUsuarios(page){
  var obt_lis = document.getElementById("selectList").value;
    var listarDeCuanto = verificarList(obt_lis);
    var buscar = document.getElementById("buscar").value;
    document.getElementById("paginas").value=page;
    //alert(buscar);
    //ponerFechactualAlModalDeReporte(listarDeCuanto,buscar,page,fecha);
    var datos = new FormData(); // Crear un objeto FormData vacío
    datos.append('pagina', page);
    datos.append('listarDeCuanto',listarDeCuanto);
    datos.append("buscar",buscar);
      $.ajax({
        url: "/buscarTurismo",
        type: "POST",
        data: datos,
        contentType: false, // Deshabilitar la codificación de tipo MIME
        processData: false, // Deshabilitar la codificación de datos
        success: function(data) {
        //alert(data+"dasdas");
          $("#verDatos").html(data);
        }
      });
  }

  function verificarList(valor){
    if(valor != "" && valor != "--" && valor != "Seleccione Listar"){
      return valor;
    }else{
      return 5;
    }
  }

  function enviar(id_usuario,id_ruta,folios,procedencia,referencia,fecha,hora){
    document.getElementById("foliosNumero").value=folios;
    document.getElementById("id_ruta2").value= id_ruta;

    cargarRemisiones(id_usuario,folios,id_ruta);
  }

  function visforUsuario(){
     location.href="../controlador/usuario.controlador.php?accion=vfu" ;
   }

  function visforUsuario(){
     location.href="../controlador/usuario.controlador.php?accion=vfu" ;
   }
   //$pagina,$listarDeCuanto
   //funcion para activar o desactivar el usuario o dar de baja
   function accionBtnActivar(accion,pagina,listarDeCuanto,cod_usuario){
     var buscar = document.getElementById("buscar").value;
     var datos = new FormData(); // Crear un objeto FormData vacío
     datos.append('accion', accion);
     datos.append("pagina",pagina);
     datos.append("listarDeCuanto",listarDeCuanto);
     datos.append("buscar",buscar);
     datos.append("cod_usuario",cod_usuario);
     $.ajax({
       url: "index.php?accion=del",
       type: "POST",
       data: datos,
       contentType: false, // Deshabilitar la codificación de tipo MIME
       processData: false, // Deshabilitar la codificación de datos
       success: function(data) {
     //  alert(data+"dasdas");
     	   data=$.trim(data);
         if(data == "error"){
           error();
         }else{
           $("#verDatos").html(data);
         }
       }
     });
   }

 //funcion para verificar si el usuario existe o no y despues poder editar sus datos
 function accionBtnEditar(data) {
     // Usar las propiedades del objeto JSON 'data' para actualizar los campos del formulario
     document.getElementById('id').value = data.id;
     document.getElementById("nombre_destino").value = data.nombre_destino;
     document.getElementById("tipo_destino").value = data.tipo_destino;
     document.getElementById("descripcion").value = data.descripcion;
     document.getElementById("ubicacion").value = data.ubicacion;
     document.getElementById("contacto").value = data.contacto;
     document.getElementById("enlace_web").value = data.enlace_web;
     document.getElementById("actividades_disponibles").value = data.actividades_disponibles;
 }


   function formularioSubmit(pagina,listarDeCuanto,cod_usuario,buscar){
     var form = document.createElement('form');
      form.method = 'post';
      form.action = '../controlador/usuario.controlador.php?accion=fm'; // Coloca la URL de destino correcta
      // Agregar campos ocultos para cada dato
      var datos = {
          pagina: pagina,
          listarDeCuanto: listarDeCuanto,
          cod_usuario: cod_usuario,
          buscar: buscar
      };
      for (var key in datos) {
          if (datos.hasOwnProperty(key)) {
              var input = document.createElement('input');
              input.type = 'hidden';
              input.name = key;
              input.value = datos[key];
              form.appendChild(input);
          }
      }
    // Agregar el formulario al cuerpo del documento y enviarlo
    document.body.appendChild(form);
    form.submit();
  }

   function error(){
  	 Swal.fire({
  		icon: 'error',
  		title: '¡Error!',
  		text: '¡No se pudo realizar la acción !',
  		showConfirmButton: false,
  		timer: 1500
  	});
   }
   function registrar() {
     var id = document.getElementById("id").value;
     var nombre_destino = document.getElementById("nombre_destino").value;
     var descripcion = document.getElementById("descripcion").value;
     var tipo_destino = document.getElementById("tipo_destino").value;
     var actividades_disponibles = document.getElementById("actividades_disponibles").value;
     var ubicacion = document.getElementById("ubicacion").value;
     var contacto = document.getElementById("contacto").value;
     var enlace_web = document.getElementById("enlace_web").value;
     var imagen_url = document.getElementById("imagen_url");

     registrarDatos(
       id,
       nombre_destino,
       descripcion,
       tipo_destino,
       actividades_disponibles,
       ubicacion,
       contacto,
       enlace_web,
       imagen_url
     );
   }

   function registrarDatos(id, nombre_destino, descripcion, tipo_destino, actividades_disponibles, ubicacion, contacto, enlace_web, input_imagen) {
     var datos = new FormData();
     var archivo_imagen = input_imagen.files[0];

     datos.append("id", id);
     datos.append("nombre_destino", nombre_destino);
     datos.append("descripcion", descripcion);
     datos.append("tipo_destino", tipo_destino);
     datos.append("actividades_disponibles", actividades_disponibles);
     datos.append("ubicacion", ubicacion);
     datos.append("contacto", contacto);
     datos.append("enlace_web", enlace_web);
     datos.append("imagen_url", archivo_imagen);

     $.ajax({
       url: "/registrarTurismo", // cambia esta URL por la ruta correcta en tu backend
       type: "POST",
       data: datos,
       contentType: false,
       processData: false,
       success: function(data) {
         data = $.trim(data);
         console.log(data);
         if (data == "correcto") {
           alertaValidacion("success","Acción realizada con éxito.","Correcto");
            IRalLink(id);
         } else if (data == "error") {
           alertaValidacion("error","Ocurrio un error.","Error");
         } else if(data == "vacio") {
           alertaValidacion("info","Algun campo vacio","Vacio")
         }else{
           alertaValidacion("error",data,"Error");
         }
        // solo si deseas redireccionar o hacer algo después
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

   function IRalLink(id_usuario){
     if(id_usuario!=''){
       setTimeout(() => {
         var pagina = document.getElementById("paginas").value;
         if(pagina==''){pagina=1;}
         BuscarUsuarios(pagina);
           closeModal();
       }, 1500);
     }else{
       setTimeout(() => {
         location.href="/gTurismo";
           closeModal();
       }, 1500);
     }
   }

   $(document).ready(function() {
       $('#para').select2({
         theme: "bootstrap-5", // Aplicar el tema de Bootstrap 5 a Select2
        dropdownParent: $('#miModalRemision3'), // Mantiene el dropdown dentro del modal
        placeholder: "Buscar para .......",
        width: '100%',
        ajax: {
               url: "index.php?accion=buhr", // Archivo PHP que procesará la búsqueda
               type: 'POST',
               dataType: 'json',
               delay: 250, // Tiempo de espera en ms para la solicitud AJAX
               data: function(params) {
                   return {
                       buscar: params.term // Término de búsqueda ingresado por el usuario
                   };
               },
               processResults: function(data) {
                   return {
                       results: $.map(data, function(item) {
                           return {
                               id: item.id_usuario, // ID correcto
                               text: item.nombres+" "+item.ap_usuario+" "+item.am_usuario+" - "+item.tipo_cargo, // Nombre visible en el select
                               id_cargo:item.id_cargo
                           };
                       })
                   };
               },

               cache: true,
               success: function(response) {
               console.log("Respuesta recibida desde el servidor:", response);
             },
             error: function(xhr, status, error) {
               console.error("Error en la solicitud:", error);
               console.log("Detalles del error:", xhr.responseText);
                           //alert("Ocurrió un error al obtener los datos. Revisa la consola para más detalles.");
           }
           },
           minimumInputLength: 1 // Mínimo de caracteres antes de hacer la búsqueda
       }).on('select2:select', function(e) {
           var selectedData = e.params.data;
          console.log("Seleccionado:", selectedData);
          $("#id_usuario").val(selectedData.id);
          $("#id_cargo2").val(selectedData.id_cargo);
       });
       // Agregar el borde de select2 si es necesario
    $('.select2-container .select2-selection--single').css({
        'border': '1px solid #ced4da',
        'border-radius': '.375rem',
    });
   });

   function toggleDescripcion(id) {
       const descripcion = document.getElementById('descripcion-' + id);
       const btn = document.getElementById('verMasBtn-' + id);

       // Si el texto está recortado, mostramos todo el texto y cambiamos el botón
       if (descripcion.classList.contains('line-clamp-2')) {
           descripcion.classList.remove('line-clamp-2');
           btn.innerText = 'Ver menos';
       } else {
           descripcion.classList.add('line-clamp-2');
           btn.innerText = 'Ver más';
       }
   }
</script>
