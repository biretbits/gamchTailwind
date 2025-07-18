<?php
require 'modelo/cargo.php';
class CargosControlador{
  public static function VisualizarCargos(){
    $us = new Cargo();  // Creando una nueva instancia de la clase Usuario
    $listarDeCuanto = 5;$pagina = 1;
    $resultodoUsuarios = $us->seleccionarCargos("",false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;
    $resul = $us->seleccionarCargos("",$inicioList,$listarDeCuanto);
    require("vista/cargo/servidor/cargo.php");
  }

  public static function registrarCargo($a){
    $us = new Cargo();  // Creando una nueva instancia de la clase Usuario
    $resul = $us->registrar($a);
    if($resul){
      echo "correcto";
    }else{
      echo "error";
    }
  }

  public static function BuscarCargosEmpleadoNuevo($pagina, $listarDeCuanto, $buscar){
    $us = new Cargo();  // Creando una nueva instancia de la clase Normativa

    // Realizar la primera consulta para obtener el total de filas
    $resultodoUsuarios = $us->seleccionarCargos($buscar, false, false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);

    // Calcular el total de páginas
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);

    // Calcular el registro inicial de acuerdo a la página actual
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    // Realizar la consulta con paginación
    $resul = $us->seleccionarCargos($buscar, $inicioList, $listarDeCuanto);

          echo '<div class="overflow-x-auto">
            <table class="table-auto w-full text-sm text-left border-collapse">
              <thead>
                <tr>
                  <th class="px-4 py-2 border">N°</th>
                  <th class="px-4 py-2 border">Nivel</th>
                  <th class="px-4 py-2 border">Cargo empleado</th>
                  <th class="px-4 py-2 border">Fecha De Registro</th>
                  <th class="px-4 py-2 border">Ultima Actualización</th>
                  <th class="px-4 py-2 border">Acción</th>
                </tr>
              </thead>
              <tbody>';
                if ($resul && mysqli_num_rows($resul) > 0) {
                  $i = $inicioList;
                  while($fi = mysqli_fetch_array($resul)){
                    echo "<tr>";
                    echo "<td class='px-4 py-2 border'>".($i+1)."</td>";
                    echo "<td class='px-4 py-2 border'>".$fi['nivel_empleado']."</td>";
                    echo "<td class='px-4 py-2 border'>".$fi['cargo_empleado']."</td>";
                    echo "<td class='px-4 py-2 border'>".$fi['creado_en']."</td>";
                    echo "<td class='px-4 py-2 border'>".$fi['actualizado_en']."</td>";
                    $id_u = '';
                    $datos = [
                      "id" => $fi["id"],
                      "jerarquico" => addslashes($fi["nivel_empleado"]),
                      "cargo_empleado" => addslashes($fi["cargo_empleado"]),
                      "creado_en" => addslashes($fi["creado_en"]),
                      "id_nivel" => $fi["nivel_id"],
                  ];
                    echo "<td class='px-4 py-2 border'>
                      <div class='flex gap-2'>
                        <button type='button' class='btn btn-info py-1 px-3 bg-blue-500 text-white rounded-md shadow-sm' title='Editar'
                        data-bs-toggle='modal' data-bs-target='#ModalRegistro' onclick='openModal(); accionBtnEditar(".json_encode($datos).")'>
                          <i class='fas fa-edit'></i> Editar
                        </button>
                        <button type='button' class='btn btn-danger py-1 px-3 bg-red-500 text-white rounded-md shadow-sm' title='Eliminar'onclick='accionEliminar(".$fi["id"].")'>
                          <i class='fas fa-trash'></i> Eliminar
                        </button>
                      </div>
                    </td>";
                    echo "</tr>";
                    $i++;
                  }
                }  else {
                  // Suponiendo que la tabla tiene 8 columnas
                  echo "<tr><td colspan='8' class='text-center text-gray-500'>No se encontraron resultados</td></tr>";

                }
              echo "</tbody>
            </table>
          </div>";
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


      }

      public static function EliminarRegistro($id){
        $us = new Cargo();  // Creando una nueva instancia de la clase Usuario
        $resul = $us->Eliminar($id);
        if($resul){
          echo "correcto";
        }else{
          echo "error";
        }
      }

      public static function buscandoCargoNivelJe($buscar){
        $us = new Cargo();
        $re = $us->buscarNivel($buscar);
        $datos = array();
        if ($re->num_rows > 0) {
       // Recoger los resultados en un array
         while($row = $re->fetch_assoc()) {
          $datos[] = $row;
        }
            echo json_encode($datos);
        } else {
            echo json_encode([]);
        }
      }
}

 ?>
