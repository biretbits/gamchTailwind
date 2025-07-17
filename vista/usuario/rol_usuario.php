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
      <h5 class="text-lg font-semibold">ROLES DE USUARIOS</h5>
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
                onclick="openModal(); accionBtnEditar('','','','','')"
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
              <h6 class="text-gray-700 font-semibold" id="miModalRegistro">ROLES DE USUARIOS</h6>
              <button type="button" class="text-gray-500 hover:text-gray-700" onclick="closeModal()">
                <i class="fas fa-times"></i>
              </button>
            </div>

            <!-- Modal Body -->
            <div class="p-4">
              <div class="space-y-4">
                <form>
                 <input type="hidden" name="id" id='id' value="">
                 <input type="hidden" name="usuario_id" id='usuario_id' value="">
                  <input type="hidden" name="id_rol" id='id_rol' value="">
                 <div class="input-group input-group-sm mb-3">
                   <select id="nombreUsuario" class="form-select select2" required>
                     <option value=""></option>
                   </select>
                 </div>
                 <div class="input-group input-group-sm mb-3">
                   <select id="rolTipo" class="form-select select2" required>
                     <option value=""></option>
                   </select>
                 </div>
                 <div class="input-group input-group-sm mb-3">
                   <h6 id='edi'></h6>
                </div>
               </form>
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
                <th class="px-4 py-2 border">Rol usuario</th>
                <th class="px-4 py-2 border">descripción</th>
                <th class="px-4 py-2 border">Especial</th>
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
                    echo "<td class='px-4 py-2 border'>".$fi['rol_nombre']."</td>";
                    echo "<td class='px-4 py-2 border'>".$fi['rol_descripcion']."</td>";
                    echo "<td class='px-4 py-2 border'>".$fi['especial']."</td>";
                    echo "<td class='px-4 py-2 border'>".$fi['rol_asignado_en']."</td>";
                    echo "<td class='px-4 py-2 border'>".$fi['rol_actualizado_en']."</td>";
                    echo "<td class='px-4 py-2 border'>";
                    $id_u = '';
                    echo "<div class='flex gap-2'>
                      <button type='button' class='btn btn-info py-1 px-3 bg-blue-500 text-white rounded-md shadow-sm' title='Editar'
                      data-bs-toggle='modal' data-bs-target='#ModalRegistro' onclick='openModal(); accionBtnEditar(
                               \"".$fi["id"]."\",
                          \"".$fi["rol_id"]."\",
                          \"".$fi["usuario_id"]."\",\"\",   \"\"
                         )'>
                        <i class='fas fa-edit'></i> Editar
                      </button>
                      <button type='button' class='btn btn-danger py-1 px-3 bg-red-500 text-white rounded-md shadow-sm' title='Eliminar' onclick='accionBtnActivar(
                            \"".$fi["id"]."\"
                          )'>
                        <i class='fas fa-trash'></i> Eliminar
                      </button>
                    </div>";
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
        url: "/buscandoRolesUsuario",
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
   function accionBtnActivar(id){
     var datos = new FormData(); // Crear un objeto FormData vacío
     datos.append('id', id);
     $.ajax({
       url: "/eliminarRolUsuario",
       type: "POST",
       data: datos,
       contentType: false, // Deshabilitar la codificación de tipo MIME
       processData: false, // Deshabilitar la codificación de datos
       success: function(data) {
     //  alert(data+"dasdas");
     	   data=$.trim(data);
        // alert(data);
         if(data == "correcto"){
           alertaValidacion("success","Acción realizada con éxito","Correcto")
           IRalLink(id);
        }else{
          alertaValidacion("error","¡No se pudo realizar la acción!","¡Error!")
        }
       }
     });
   }
 //funcion para verificar si el usuario existe o no y despues poder editar sus datos
 function accionBtnEditar(id, idRol,usuarioId, nombreUsuario, rolTipo) {
   // Asignar valores simples
   document.getElementById("id").value = id;
   document.getElementById("usuario_id").value = usuarioId;
   document.getElementById("id_rol").value = idRol;

   // Asignar texto al Select2 de nombreUsuario
   $('#nombreUsuario').val(nombreUsuario).trigger('change');

   // Asignar texto al Select2 de rolTipo
   $('#rolTipo').val(rolTipo).trigger('change');
   if(id!=''){
       document.getElementById("edi").innerText = "NOTA: Esta en acción Editar, busque de nuevo un usuario y rol de usuario, si desea actualizar.";
   }else{
     document.getElementById("edi").innerText = "";
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
     var id = document.getElementById("id").value;
     var usuario_id = document.getElementById("usuario_id").value;
     var id_rol = document.getElementById("id_rol").value;
      registrarDatos(id,usuario_id,id_rol);
   }

   function registrarDatos(id,usuario_id,id_rol){
     var datos = new FormData(); // Crear un objeto FormData vacío
      datos.append("id",id);
      datos.append("usuario_id",usuario_id);
      datos.append("id_rol",id_rol);
     $.ajax({
       url: "/RolUsuarioReg",
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
         location.href="/rolU";
           closeModal();
       }, 1500);
     }
   }


      $(document).ready(function() {
        $('#nombreUsuario').select2({
          theme: "bootstrap-5",
          dropdownParent: $('#ModalRegistro'),
          placeholder: "Buscar usuario",
          width: '100%',

          ajax: {
            url: "/buscandoNombre",
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
                    id: item.usuario_id,
                    text: item.usuario_nombre_completo + " - " + item.usuario,
                    id_empleado: item.empleado_id
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
          $("#usuario_id").val(selectedData.id);
        });

        $('.select2-container .select2-selection--single').css({
          'border': '1px solid #ced4da',
          'border-radius': '.375rem',
        });
      });

      $(document).ready(function() {
        $('#rolTipo').select2({
          theme: "bootstrap-5",
          dropdownParent: $('#ModalRegistro'),
          placeholder: "Buscar rol usuario",
          width: '100%',

          ajax: {
            url: "/buscandoRolUsuario",
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
                    text: item.nombre + " - " + item.slug
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
          $("#id_rol").val(selectedData.id);
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
