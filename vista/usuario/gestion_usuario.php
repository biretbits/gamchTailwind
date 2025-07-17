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
      <h5 class="text-lg font-semibold">GESTIÓN DE USUARIOS</h5>
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
                onclick="openModal(); accionBtnEditar('','','','')"
                >
          <i class="fas fa-plus"></i> Nuevo
        </button>
        </div>
        <div class="flex flex-col col-span-2 md:col-span-1">
          <input type="text" class="form-control mb-3 py-2 px-4 border rounded-md" placeholder="Buscar Por Nombre/Apellidos" id="buscar" onkeyup="BuscarUsuarios(1)">
        </div>
      </div>

      <!-- Modal -->
      <div id="ModalRegistro" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4 text-center">
          <div class="relative w-full max-w-2xl bg-white rounded-lg shadow-lg">
            <!-- Modal Header -->
            <div class="flex justify-between items-center p-4 border-b">
              <h6 class="text-gray-700 font-semibold" id="miModalRegistro">GESTIÓN DE USUARIOS</h6>
              <button type="button" class="text-gray-500 hover:text-gray-700" onclick="closeModal()">
                <i class="fas fa-times"></i>
              </button>
            </div>

            <!-- Modal Body -->
            <div class="p-4">
              <div class="space-y-4">
                <form class="p-6 bg-white">

                  <input type="hidden" name="id_empleado" id="id_empleado" value="">
                  <input type="hidden" name="id" id="id" value="">

                  <!-- Empleado Select -->
                  <div class="mb-5">
                    <label for="empleado" class="block text-sm font-semibold text-gray-700">Empleado</label>
                    <select id="empleado" class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                      <option value="" disabled selected>Selecciona un empleado</option>
                      <!-- Opciones se llenan dinámicamente -->
                    </select>
                  </div>

                  <!-- Usuario Input -->
                  <div class="mb-5">
                    <label for="usuario" class="block text-sm font-semibold text-gray-700">Usuario</label>
                    <input type="text" class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="usuario" name="usuario" placeholder="Ingresa tu usuario" required>
                  </div>

                  <!-- Contraseña Input -->
                  <div class="mb-5">
                    <label for="contrasena" class="block text-sm font-semibold text-gray-700">Contraseña</label>
                    <input type="password" class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="contrasena" name="contrasena" placeholder="Ingresa tu contraseña nueva o actual" required>
                    <div id="passwordHelp" class="mt-2 text-xs text-gray-500">
                      <p id="length" class="invalid">❌ Mínimo 8 caracteres</p>
                      <p id="lowercase" class="invalid">❌ Al menos una letra minúscula</p>
                      <p id="uppercase" class="invalid">❌ Al menos una letra mayúscula</p>
                      <p id="number" class="invalid">❌ Al menos un número</p>
                      <p id="symbol" class="invalid">❌ Al menos un símbolo (ej: !@#$%)</p>
                    </div>
                  </div>

                  <!-- Confirmar Contraseña -->
                  <div class="mb-5">
                    <label for="contrasena_confirmar" class="block text-sm font-semibold text-gray-700">Confirmar Contraseña</label>
                    <input type="password" class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="contrasena_confirmar" name="contrasena_confirmar" placeholder="Confirma tu contraseña" required>
                  </div>

                  <!-- Mostrar Contraseña -->
                  <div class="flex justify-between items-center mb-5">
                    <button type="button" class="text-sm text-blue-500 hover:text-blue-700" id="che" onclick="mostrar()">
                      <i class="fas fa-eye"></i> Mostrar Contraseña
                    </button>
                  </div>

                </form>

                <!-- Estilo para la validación de la contraseña -->
                <style>
                  .invalid {
                    color: #e11d48; /* Rojo para mensajes de error */
                  }

                  .valid {
                    color: #16a34a; /* Verde para mensajes válidos */
                  }
                </style>

              </div>
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
      <div class="verDatos" id="verDatos">
        <div class="overflow-x-auto">
          <table class="table-auto w-full text-sm text-left border-collapse">
            <thead>
              <tr>
                <th class="px-4 py-2 border">N°</th>
                <th class="px-4 py-2 border">Nombre</th>
                <th class="px-4 py-2 border">Apellido P.</th>
                <th class="px-4 py-2 border">Apellido M.</th>
                <th class="px-4 py-2 border">Usuario</th>
                <th class="px-4 py-2 border">estado</th>
                <th class="px-4 py-2 border">Fecha Reg.</th>
                <th class="px-4 py-2 border">Ultima Actualización</th>
                <th class="px-4 py-2 border">Acción</th>
              </tr>
            </thead>
            <tbody>
              <!-- Aquí van los datos de la tabla, que se llenan dinámicamente -->
              <?php
                if ($resul && mysqli_num_rows($resul) > 0) {
                  $i = $inicioList;
                  while($fi = mysqli_fetch_array($resul)){
                    echo "<tr>";
                    echo "<td class='px-4 py-2 border'>".($i+1)."</td>";
                    echo "<td class='px-4 py-2 border'>".$fi['nombre']."</td>";
                    echo "<td class='px-4 py-2 border'>".$fi['apellido_p']."</td>";
                    echo "<td class='px-4 py-2 border'>".$fi['apellido_m']."</td>";
                    echo "<td class='px-4 py-2 border'>".$fi['usuario']."</td>";
                    echo "<td class='px-4 py-2 border'>".$fi['usuario_estado']."</td>";
                    echo "<td class='px-4 py-2 border'>".$fi['usuario_creado']."</td>";
                    echo "<td class='px-4 py-2 border'>".$fi['usuario_actualizado']."</td>";
                    echo "<td class='px-4 py-2 border'>";
                    $id_u = '';
                    echo "<div class='flex gap-2'>
                      <button type='button' class='btn btn-info py-1 px-3 bg-blue-500 text-white rounded-md shadow-sm' title='Editar'
                      data-bs-toggle='modal' data-bs-target='#ModalRegistro' onclick='openModal();accionBtnEditar(
                            \"".$fi["usuario_id"]."\",
                          \"".$fi["usuario"]."\",
                          \"".$fi["empleado_id"]."\"
                          )'>
                        <i class='fas fa-edit'></i> Editar
                      </button>";
                      if($fi["usuario_estado"] == "activo"){
                        echo "
                         <button title='Desactivar'
                          type='button' class='btn btn-danger py-1 px-3 bg-red-500 text-white rounded-md shadow-sm' title='Eliminar' onclick='accionBtnActivar(
                               \"".$fi["usuario_id"]."\",\"desactivo\"
                             )'>
                           <i class='fas fa-trash'></i> Desactivar
                         </button>";
                      }else{
                         echo "
                         <button type='button' title='Activar'
                          class='btn btn-danger py-1 px-3 bg-green-500 text-white rounded-md shadow-sm' title='Eliminar' onclick='accionBtnActivar(
                               \"".$fi["usuario_id"]."\",\"activo\"
                             )'>
                           <i class='fas fa-trash'></i> Activar
                         </button>";
                      }

                    echo "</div>";
                    echo "</td>";
                    echo "</tr>";
                    $i++;
                  }
                } else {
                  echo "<tr><td colspan='8' class='text-center text-gray-500'>No se encontraron resultados</td></tr>";
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
        url: "/BuscarUsuarioUno",
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

 //funcion para verificar si el usuario existe o no y despues poder editar sus datos

   function accionBtnEditar(id,usuario,empleado_id){
      document.getElementById("id").value=id;
      document.getElementById("usuario").value=usuario;
      document.getElementById("id_empleado").value=empleado_id;
      if(id == ''){
        $('#empleado').val('').trigger('change');
      }
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
     var id_empleado = document.getElementById("id_empleado").value;
      var id = document.getElementById("id").value;
      var usuario = document.getElementById("usuario").value;
      var contrasena = document.getElementById("contrasena").value;
      var contrasena_confirmar = document.getElementById("contrasena_confirmar").value;
      if(contrasena == contrasena_confirmar && contrasena != '' && contrasena_confirmar != ''){
        registrarDatos(id,id_empleado,usuario,contrasena);
      }else{
        alertaValidacion('error',"No coinciden las contraseñas","Confirme la contraseña.")
      }
   }

   function registrarDatos(id,id_empleado,usuario,contrasena){
     var datos = new FormData(); // Crear un objeto FormData vacío
      datos.append("id",id);
      datos.append("id_empleado",id_empleado);
      datos.append("usuario",usuario);
      datos.append("contrasena",contrasena);
     $.ajax({
       url: "/regstrarDatosUsuario",
       type: "POST",
       data: datos,
       contentType: false, // Deshabilitar la codificación de tipo MIME
       processData: false, // Deshabilitar la codificación de datos
       success: function(data) {
         data = $.trim(data);
         console.log(data);
         if(data == "correcto"){
           alertaValidacion("success","Acción realizada con éxito","Correcto")
           IRalLink(id);
        }else if(data == "vacio"){
          alertaValidacion("warning","Algun campo vacio","Complete los campos")
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
         location.href="/usuarios";
           closeModal();
       }, 1500);
     }
   }

   $(document).ready(function() {
     $('#empleado').select2({
       theme: "bootstrap-5",
       dropdownParent: $('#ModalRegistro'),
       placeholder: "Seleccione empleado",
       width: '100%',

       ajax: {
         url: "/buscandoEmpleado",
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
                 id: item.id,
                 text: item.nombre+"  "+item.apellido_p+"  "+item.apellido_p+" - "+item.telefono
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
       $("#id_empleado").val(selectedData.id);
     });

     $('.select2-container .select2-selection--single').css({
       'border': '1px solid #ced4da',
       'border-radius': '.375rem',
     });
   });

</script>

<script>
  const password = document.getElementById('contrasena');
  const submitBtn = document.getElementById('submitBtn');

  const lengthReq = document.getElementById('length');
  const lowerReq = document.getElementById('lowercase');
  const upperReq = document.getElementById('uppercase');
  const numberReq = document.getElementById('number');
  const symbolReq = document.getElementById('symbol');

  password.addEventListener('input', function () {
    const val = password.value;

    // Validaciones con expresiones regulares
    const lengthValid = val.length >= 8;
    const lowercaseValid = /[a-z]/.test(val);
    const uppercaseValid = /[A-Z]/.test(val);
    const numberValid = /[0-9]/.test(val);
    const symbolValid = /[!@#$%^&*(),.?":{}|<>]/.test(val);

    // Actualizar clases y texto
    updateValidation(lengthReq, lengthValid);
    updateValidation(lowerReq, lowercaseValid);
    updateValidation(upperReq, uppercaseValid);
    updateValidation(numberReq, numberValid);
    updateValidation(symbolReq, symbolValid);

    // Activar botón solo si todo es válido
    submitBtn.disabled = !(lengthValid && lowercaseValid && uppercaseValid && numberValid && symbolValid);
  });

  function updateValidation(element, isValid) {
    if (isValid) {
      element.classList.remove('invalid');
      element.classList.add('valid');
      element.textContent = '✔️ ' + element.textContent.slice(2);
    } else {
      element.classList.remove('valid');
      element.classList.add('invalid');
      element.textContent = '❌ ' + element.textContent.slice(2);
    }
  }

  function mostrar() {
    var contrasena = document.getElementById("contrasena");
    var bx = document.querySelector(".che");
    if(contrasena.type === 'password'){
      contrasena.type = 'text';
    }else{
      contrasena.type = 'password';
    }
  }

  function accionBtnActivar(id,estado){
    //alert(estado+" "+id);
    var datos = new FormData(); // Crear un objeto FormData vacío
     datos.append("id",id);
     datos.append("estado",estado);
    $.ajax({
      url: "/desabilitasUsuario",
      type: "POST",
      data: datos,
      contentType: false, // Deshabilitar la codificación de tipo MIME
      processData: false, // Deshabilitar la codificación de datos
      success: function(data) {
        data = $.trim(data);
        console.log(data);
        //alert(data);
        if(data == "correcto"){
          alertaValidacion("success","Acción realizada con éxito","Correcto")
          IRalLink(id);
       }else{
         alertaValidacion("error","¡No se pudo realizar la acción!","¡Error!")
       }
      }
    });
  }

  function openModal() {
    document.getElementById("ModalRegistro").classList.remove("hidden");
  }

  function closeModal() {
    document.getElementById("ModalRegistro").classList.add("hidden");
  }

</script>
