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
    <div class="flex flex-col md:flex-row items-center py-4 text-white">
      <h5 class="text-lg font-semibold">GESTIÓN DE EMPLEADOS</h5>
    </div>
    <div class="border rounded shadow-sm p-4 bg-white">
      <input type="hidden" name="paginas" id="paginas" value="">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <div class="flex flex-col">
          <select class="form-select" id="selectList" onchange="BuscarUsuarios(1)" name="selectList">
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
        <div class="flex flex-col">
          <button type="button"
                class="py-2 px-2 bg-blue-500 text-white rounded-md shadow-sm hover:bg-blue-600"
                onclick="openModal(); accionBtnEditar('','','','','','','','','','','')">
          <i class="fas fa-plus"></i> Nuevo
        </button>
        </div>
        <div class="flex flex-col col-span-2 md:col-span-1">
          <input type="text" class="form-control mb-3 py-2 px-4 border rounded-md" placeholder="Buscar..." id="buscar" onkeyup="BuscarUsuarios(1)">
        </div>
      </div>


      <!-- Modal -->
<div id="ModalRegistro" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-50 hidden">
  <div class="flex items-center justify-center min-h-screen p-4 text-center">
    <div class="relative w-full max-w-2xl bg-white rounded-lg shadow-lg">
      <!-- Modal Header -->
      <div class="flex justify-between items-center p-4 border-b">
        <h6 class="text-gray-700 font-semibold" id="miModalRegistro">DATOS DEL EMPLEADO</h6>
        <button type="button" class="text-gray-500 hover:text-gray-700" onclick="closeModal()">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="p-4">
        <div class="space-y-4">
          <form>
             <!-- Campos ocultos -->
             <input type="hidden" name="id" id="id" value="">
             <input type="hidden" name="id_nivel" id="id_nivel" value="">
             <input type="hidden" name="id_cargo" id="id_cargo" value="">

             <!-- Select Cargo -->
             <div class="mb-4">
               <label for="cargo" class="block text-sm font-semibold text-gray-700">Cargo</label>
               <select id="cargo" class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                 <option value="">Seleccione cargo</option>
               </select>
             </div>

             <!-- Select Tipo de Empleado -->
             <div class="mb-4">
               <label for="empleado" class="block text-sm font-semibold text-gray-700">Tipo de empleado</label>
               <select id="empleado" class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                 <option value="">Seleccione tipo de empleado</option>
                 <option value="autoridad">Autoridad</option>
                 <option value="normal">Normal</option>
               </select>
             </div>

             <!-- Nombre -->
             <div class="mb-4">
               <label for="nombre" class="block text-sm font-semibold text-gray-700">Nombre</label>
               <input type="text" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="nombre" name="nombre" placeholder="Ponga nombre" required>
             </div>

             <!-- Apellido Paterno -->
             <div class="mb-4">
               <label for="apellido_p" class="block text-sm font-semibold text-gray-700">Apellido Paterno</label>
               <input type="text" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="apellido_p" name="apellido_p" placeholder="Ponga apellido paterno" required>
             </div>

             <!-- Apellido Materno -->
             <div class="mb-4">
               <label for="apellido_m" class="block text-sm font-semibold text-gray-700">Apellido Materno</label>
               <input type="text" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="apellido_m" name="apellido_m" placeholder="Ponga apellido materno" required>
             </div>

             <!-- Select Sexo -->
             <div class="mb-4">
               <label for="sexo" class="block text-sm font-semibold text-gray-700">Sexo</label>
               <select id="sexo" class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                 <option value="">Seleccione sexo</option>
                 <option value="Masculino">Masculino</option>
                 <option value="Femenino">Femenino</option>
               </select>
             </div>

             <!-- Dirección -->
             <div class="mb-4">
               <label for="direccion" class="block text-sm font-semibold text-gray-700">Dirección</label>
               <input type="text" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="direccion" name="direccion" placeholder="Ponga la Dirección" required>
             </div>

             <!-- Teléfono -->
             <div class="mb-4">
               <label for="telefono" class="block text-sm font-semibold text-gray-700">Teléfono</label>
               <input type="number" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="telefono" name="telefono" placeholder="Ponga el teléfono" required>
             </div>

             <!-- Correo Electrónico -->
             <div class="mb-4">
               <label for="gmail" class="block text-sm font-semibold text-gray-700">Correo Electrónico</label>
               <input type="email" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" name="gmail" id="gmail" placeholder="ejemplo@gmail.com" required>
             </div>

             <!-- Foto de Perfil -->
             <div class="mb-4">
               <label for="upload" class="block text-sm font-semibold text-gray-700">Selecciona tu foto (JPG o PNG, optimizada)</label>
               <input type="file" accept="image/jpeg, image/png" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" name="upload" id="upload" required>
               <div id="preview-container" class="mt-2">
                 <img id="avatar" class="avatar-preview" style="display:none;" alt="Vista previa">
               </div>
             </div>

          </form>

        </div>
      </div>

      <!-- Modal Footer -->
      <div class="flex justify-end space-x-2 p-4 border-t">
        <button type="button" class="btn btn-primary py-2 px-4 bg-blue-500 text-white rounded-md hover:bg-blue-600" onclick="registrar()">
          <i class="fas fa-save"></i> Guardar
        </button>
        <button type="button" class="btn btn-secondary py-2 px-4 bg-red-500 text-white rounded-md hover:bg-red-600" onclick="closeModal()">
          <i class="fas fa-times"></i> Cerrar
        </button>
      </div>
    </div>
  </div>
</div>

      <!-- Tabla -->
      <div class="verDatos" id="verDatos">
        <div class="overflow-x-auto">
          <table class="table-auto w-full text-sm text-left border-collapse">
            <thead>
              <tr>
                <th class="px-4 py-2 border">N°</th>
                <th class="px-4 py-2 border">Nombre</th>
                <th class="px-4 py-2 border">Apellido P.</th>
                <th class="px-4 py-2 border">Apellido M.</th>
                <th class="px-4 py-2 border">Tipo Empleado</th>
                <th class="px-4 py-2 border">Sexo</th>
                <th class="px-4 py-2 border">Dirección</th>
                <th class="px-4 py-2 border">Telefono</th>
                <th class="px-4 py-2 border">Gmail</th>
                <th class="px-4 py-2 border">Foto</th>
                <th class="px-4 py-2 border">Nivel</th>
                <th class="px-4 py-2 border">Cargo</th>
                <th class="px-4 py-2 border">Fecha Reg.</th>
                <th class="px-4 py-2 border">Ultima Actualización</th>
                <th class="px-4 py-2 border">Acción</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($resul && mysqli_num_rows($resul) > 0) {
                  $i = $inicioList;
                  while($fi = mysqli_fetch_array($resul)){
                      echo "<tr>";
                      echo "<td class='px-4 py-2 border'>".($i+1)."</td>";
                      echo "<td class='px-4 py-2 border'>".$fi['nombre']."</td>";
                      echo "<td class='px-4 py-2 border'>".$fi['apellido_p']."</td>";
                      echo "<td class='px-4 py-2 border'>".$fi['apellido_m']."</td>";
                      echo "<td class='px-4 py-2 border'>".$fi['tipo_empleado']."</td>";
                      echo "<td class='px-4 py-2 border'>".$fi['sexo']."</td>";
                      echo "<td class='px-4 py-2 border'>".$fi['direccion']."</td>";
                      echo "<td class='px-4 py-2 border'>".$fi['telefono']."</td>";
                      echo "<td class='px-4 py-2 border'>".$fi['correo_electronico']."</td>";

                      // Foto
                      if($fi['foto'] == "default.jpg" || $fi['foto'] == ""){
                          echo "<td class='flex justify-center items-center w-24 h-24'>
                              <img src='imagenes/user.png' alt='foto' class='rounded-full object-cover w-full h-full'>
                          </td>";
                      } else {
                          echo "<td class='flex justify-center items-center w-24 h-24'>
                              <img src='".$fi['foto']."' alt='foto' class='rounded-full object-cover w-full h-full'>
                          </td>";
                      }

                      echo "<td class='px-4 py-2 border'>".$fi['nivel_empleado']."</td>";
                      echo "<td class='px-4 py-2 border'>".$fi['cargo_empleado']."</td>";
                      echo "<td class='px-4 py-2 border'>".$fi['creado_en']."</td>";
                      echo "<td class='px-4 py-2 border'>".$fi['actualizado_en']."</td>";

                      // Botones de acción
                      echo "<td class='px-4 py-2 border'>
                          <div class='flex gap-2'>
                              <button type='button' class='px-4 py-2 bg-blue-500 text-white rounded-md shadow-sm' title='Editar' data-bs-toggle='modal' data-bs-target='#ModalRegistro' onclick='openModal();accionBtnEditar(
                                  \"".$fi["id"]."\",
                                  \"".$fi["nivel_id"]."\",
                                  \"".$fi["cargo_id"]."\",
                                  \"".$fi["tipo_empleado"]."\",
                                  \"".$fi["nombre"]."\",
                                  \"".$fi["apellido_p"]."\",
                                  \"".$fi["apellido_m"]."\",
                                  \"".$fi["sexo"]."\",
                                  \"".$fi["direccion"]."\",
                                  \"".$fi["telefono"]."\",
                                  \"".$fi["correo_electronico"]."\"
                              )'>
                                  <i class='fas fa-edit'></i> Editar
                              </button>
                              <button type='button' class='px-4 py-2 bg-red-500 text-white rounded-md shadow-sm' title='Eliminar' onclick='accionBtnActivarDesactivar(1, ".$fi["id"].")'>
                                  <i class='fas fa-trash'></i> Eliminar
                              </button>
                          </div>
                      </td>";

                      echo "</tr>";
                      $i++;
                  }
              } else {
                  echo "<tr>";
                  echo "<td colspan='15' class='text-center text-gray-500'>No se encontraron resultados</td>";
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



 <script>
   const upload = document.getElementById('upload');
   const avatar = document.getElementById('avatar');

   upload.addEventListener('change', function () {
     const file = this.files[0];
     if (!file) return;

     // Verificar que el archivo sea JPG o PNG
     const validTypes = ['image/jpeg', 'image/png'];
     if (!validTypes.includes(file.type)) {
       alert('Por favor, selecciona una imagen JPG o PNG.');
       return;
     }

     const reader = new FileReader();
     reader.onload = function (e) {
       const img = new Image();
       img.onload = function () {
         const canvas = document.createElement('canvas');
         const maxSize = 150;
         canvas.width = maxSize;
         canvas.height = maxSize;
         const ctx = canvas.getContext('2d');

         // Redibujar imagen reducida
         ctx.drawImage(img, 0, 0, maxSize, maxSize);

         // Convertir a base64 JPEG (más liviano que PNG)
         const compressed = canvas.toDataURL('image/jpeg', 0.7); // calidad 70%
         avatar.src = compressed;
         avatar.style.display = 'block';
       };
       img.src = e.target.result;
     };
     reader.readAsDataURL(file);
   });
 </script>
 <?php
 // Incluir el archivo footer.php desde la carpeta diseno
 require_once('vista/esquema/footeruni.php');
 ?>
<script type="text/javascript">
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
        url: "/BuscarEmpleadoB",
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
    if(valor != "" && valor != "--" && valor != 'Seleccione Listar'){
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

   function accionBtnEditar(id,nivel_id,cargo_id,tipo_empleado,nombre,apellido_p,apellido_m,sexo,direccion,telefono,correo_electronico){
     document.getElementById('id').value = id;
     document.getElementById('id_nivel').value = nivel_id;
     document.getElementById('id_cargo').value = cargo_id;
     document.getElementById('empleado').value = tipo_empleado;
     document.getElementById('nombre').value = nombre;
     document.getElementById('apellido_p').value = apellido_p;
     document.getElementById('apellido_m').value = apellido_m;
     document.getElementById('sexo').value = sexo;
     document.getElementById('direccion').value = direccion;
     document.getElementById('telefono').value = telefono;
     document.getElementById('gmail').value = correo_electronico;

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

   function registrar(){
     var id = document.getElementById("id").value;
     var id_nivel = document.getElementById("id_nivel").value;
     var id_cargo = document.getElementById("id_cargo").value;
     var empleado = document.getElementById("empleado").value;
     var nombre = document.getElementById("nombre").value;
     var apellido_p = document.getElementById("apellido_p").value;
     var apellido_m = document.getElementById("apellido_m").value;
     var sexo = document.getElementById("sexo").value;
     var direccion = document.getElementById("direccion").value;
     var telefono = document.getElementById("telefono").value;
     var gmail = document.getElementById("gmail").value;
     var file = document.getElementById("upload");
     registrarDatos(id,id_nivel,id_cargo,empleado,nombre,apellido_p,apellido_m,sexo,direccion,telefono,gmail,file);

   }

   function registrarDatos(id,id_nivel,id_cargo,empleado,nombre,apellido_p,apellido_m,sexo,direccion,telefono,gmail,file){
     var datos = new FormData(); // Crear un objeto FormData vacío
      datos.append("id",id);
      datos.append("id_nivel",id_nivel);
       datos.append("id_cargo",id_cargo);
       datos.append("empleado",empleado);
       datos.append("nombre",nombre);
       datos.append("apellido_p",apellido_p);
       datos.append("apellido_m",apellido_m);
       datos.append("sexo",sexo);
       datos.append("direccion",direccion);
       datos.append("telefono",telefono);
       datos.append("gmail",gmail);
       if (file.files.length > 0) {
         datos.append("file", file.files[0]); // Validación opcional de archivo
       }
      $.ajax({
       url: "/registrarDatosEmpleado",
       type: "POST",
       data: datos,
       contentType: false, // Deshabilitar la codificación de tipo MIME
       processData: false, // Deshabilitar la codificación de datos
       success: function(data) {
         data = $.trim(data);
         if(data == "correcto"){
           alertaValidacion("success","Acción realizada con éxito","Correcto");
           IRalLink(id);
        }else if(data == "vacio"){
          alertaValidacion('info','Campos vacios','Llene los campos');
        }else if(data == "Tipo_de_archivo_no_permitido"){
          alertaValidacion('info','Seleccione otro archivo','Formato de archivo no valido');
        }else if(data == "Error_al_subir_archivo"){
          alertaValidacion('info','Ocurrio un problema al subir el archivo','Error al subir el archivo');
        }else{
            alertaValidacion("error","¡No se pudo realizar la acción!","¡Error!")
        }
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
         location.href="/empleado";
           closeModal();
       }, 1500);
     }
   }



      $(document).ready(function() {
        $('#cargo').select2({
          theme: "bootstrap-5",
          dropdownParent: $('#ModalRegistro'),
          placeholder: "Seleccione cargo",
          width: '100%',

          ajax: {
            url: "/buscandoCargoNuevo",
            type: 'POST',
            dataType: 'json',
            delay: 250,
            data: function(params) {
              return {
                buscar: params.term
              };
            },
            processResults: function(data) {
              return {
                results: $.map(data, function(item) {
                  return {
                    id: item.id_cargo,
                    text: item.cargo_empleado+" - "+item.nivel_empleado,
                    id_nivel: item.nivel_id
                  };
                })
              };
            },
            cache: true
          },
          minimumInputLength: 1
        }).on('select2:select', function(e) {
          var selectedData = e.params.data;
          console.log("Seleccionado:", selectedData);
          $("#id_nivel").val(selectedData.id_nivel);
          $("#id_cargo").val(selectedData.id);
        });
        $('.select2-container .select2-selection--single').css({
          'border': '1px solid #ced4da',
          'border-radius': '.375rem',
        });
      });

      function openModal() {
        document.getElementById("ModalRegistro").classList.remove("hidden");
      }

      function closeModal() {
        document.getElementById("ModalRegistro").classList.add("hidden");
      }
</script>
