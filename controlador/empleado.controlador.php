<?php
require_once "modelo/empleado.php";
class EmpleadoControlador{
  public static function VistaTablaEmpleado(){
    $us = new Empleado();  // Creando una nueva instancia de la clase Usuario
    $listarDeCuanto = 5;$pagina = 1;
    $resultodoUsuarios = $us->SeleccionarEmpleado("",false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;
    $resul = $us->SeleccionarEmpleado();
    require("vista/empleado/servidor/empleado.php");
  }

  public static function buscandoCargoDeEmpleado($buscar){
    $us = new Empleado();
    $re = $us->buscarcARGOEmpleado($buscar);
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

  public static function RegistrarDatosEmpleadosNuevo($a) {
      $campos = ["id_nivel", "id_cargo", "empleado", "nombre", "apellido_p", "apellido_m", "sexo", "direccion", "telefono", "gmail"];
      $vacio = false;
      foreach ($campos as $campo) {
          if (!isset($a[$campo]) || trim($a[$campo]) === '') {
              $vacio = true;
              return;
          }
      }

      $us = new Empleado();
      $rutaImagen = '';
      if($vacio == true){
        echo "vacio";
      }else{
        // Verificamos si se subió un archivo
        if (isset($_FILES["file"]) && $_FILES["file"]["error"] !== 4) {
          if ($_FILES["file"]["error"] === 0) {
              $nombreArchivo = basename($_FILES["file"]["name"]);
              $directorioDestino = "vista/activos/FotoUsuario/";
              $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
              $nombreUnico = bin2hex(random_bytes(16)) . '.' . $extension;
              $rutaDestino = $directorioDestino . $nombreUnico;

              $ext = strtolower(pathinfo($rutaDestino, PATHINFO_EXTENSION));
              switch ($ext) {
                  case 'jpg':
                  case 'jpeg':
                      $imagen = imagecreatefromjpeg($_FILES["file"]["tmp_name"]);
                      break;
                  case 'png':
                      $imagen = imagecreatefrompng($_FILES["file"]["tmp_name"]);
                      break;
                  case 'gif':
                      $imagen = imagecreatefromgif($_FILES["file"]["tmp_name"]);
                      break;
                  default:
                      echo "Tipo_de_archivo_no_permitido";
                      return;
              }

              list($anchoOriginal, $altoOriginal) = getimagesize($_FILES["file"]["tmp_name"]);
              $anchoNuevo = 800;
              $altoNuevo = 600;

              $imagenRedimensionada = imagecreatetruecolor($anchoNuevo, $altoNuevo);
              imagecopyresampled($imagenRedimensionada, $imagen, 0, 0, 0, 0, $anchoNuevo, $altoNuevo, $anchoOriginal, $altoOriginal);

              switch ($ext) {
                  case 'jpg':
                  case 'jpeg':
                      imagejpeg($imagenRedimensionada, $rutaDestino, 75);
                      break;
                  case 'png':
                      imagepng($imagenRedimensionada, $rutaDestino, 6);
                      break;
                  case 'gif':
                      imagegif($imagenRedimensionada, $rutaDestino);
                      break;
              }

              imagedestroy($imagen);
              imagedestroy($imagenRedimensionada);

              $rutaImagen = $rutaDestino;
          } else {
              echo "Error_al_subir_archivo";
              return;
          }
        }

        $re = $us->RegistrarNuevosDatosEmpleado($a, $rutaImagen);
        echo $re ? "correcto" : "error";
      }
  }

  public static function  BuscarEmpleadoTodo($pagina, $listarDeCuanto, $buscar){
    $us = new Empleado();  // Creando una nueva instancia de la clase Usuario
    $resultodoUsuarios = $us->SeleccionarEmpleado($buscar,false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SeleccionarEmpleado($buscar,$inicioList,$listarDeCuanto);
    echo '<div class="overflow-x-auto">
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
            <tbody>';
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
}



?>
