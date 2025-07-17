<?php

require 'modelo/transparente.php';
class TransparenteControlador{

  public static function visualizarTransparencia($categoria){
    $us = new Transparente();  // Creando una nueva instancia de la clase Usuario
    $listarDeCuanto = 10;$pagina = 1;
    $resultodoUsuarios = $us->SelectPorBusquedaTransparente("",false,false,$categoria);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;
    $rnoticia = $us->ultimaNoticia();
    $resul = $us->SelectPorBusquedaTransparente('',$inicioList,$listarDeCuanto,$categoria);
    require("vista/transparente/cliente/transparente.php");
  }


    public static function buscarTransrenciaNuevo($pagina,$listarDeCuanto,$buscar,$categoria){
        $us = new Transparente();  // Creando una nueva instancia de la clase Usuario
        $resultodoUsuarios = $us->SelectPorBusquedaTransparente($buscar,false,false,$categoria);
        $num_filas_total = mysqli_num_rows($resultodoUsuarios);
        $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
                //calculamos el registro inicial
        $inicioList = ($pagina - 1) * $listarDeCuanto;

        $resul = $us->SelectPorBusquedaTransparente($buscar,$inicioList,$listarDeCuanto,$categoria);

              if ($resul && mysqli_num_rows($resul) > 0) {
                  while($fi = mysqli_fetch_array($resul)) {
                      echo '<div class="flex items-center justify-between border p-3 rounded-lg shadow-sm mb-3">
                              <div class="flex items-center">
                                  <i class="fas fa-file-pdf text-red-600 text-3xl mr-3"></i>
                                  <div>
                                      <a href="#" target="_blank" class="text-decoration-none font-bold text-black">
                                          ' . $fi["nombre_documento"] . '
                                      </a>
                                      <div class="text-muted text-xs description">' . $fi["descripcion"] . '</div>
                                      <div class="text-muted text-xs">' . $fi["fecha_creacion"] . '</div>
                                  </div>
                              </div>';

                      echo '<div class="flex gap-2">
                              <a href="javascript:void(0)" class="btn bg-green-600 text-white text-sm py-2 px-4 rounded shadow-sm hover:bg-green-700 flex items-center gap-2" data-bs-toggle="modal" data-bs-target="#pdfModal"
                                  onclick="ejecutar(\'' . $fi["archivo"] . '\')">
                                  <i class="fas fa-eye"></i>
                              </a>';

                      echo '<a href="' . $fi["archivo"] . '" download class="btn bg-transparent border border-gray-300 text-sm py-2 px-4 rounded shadow-sm text-gray-700 hover:bg-gray-100 flex items-center gap-2" title="Descargar PDF">
                              <i class="fas fa-download"></i>
                            </a>
                        </div>
                      </div>';
                  }
              } else {
                  // Si no se encuentran resultados
                  echo "<div class='text-center text-gray-500'>No se encontraron resultados</div>";
              }

              // Mostrar la paginación si hay más de una página
              if ($TotalPaginas != 0) {
                  $adjacents = 1;
                  $anterior = "&lsaquo; Anterior";
                  $siguiente = "Siguiente &rsaquo;";

                  echo '<div class="mt-3">
                          <nav aria-label="Paginación de resultados">
                              <ul class="flex justify-center space-x-2 bg-white p-3 rounded-lg shadow-md">';

                  // Botón para la primera página
                  if ($pagina > 1) {
                      echo '<li class="page-item">
                              <a class="page-link text-gray-700 hover:text-blue-600 hover:bg-gray-200 px-4 py-2 rounded-md" href="javascript:void(0);" onclick="BuscarUsuarios(1)" aria-label="Primera">
                                  <span aria-hidden="true">&laquo;</span>
                              </a>
                            </li>';
                  }

                  // Botón para la página anterior
                  if ($pagina == 1) {
                      echo '<li class="page-item disabled">
                              <span class="page-link text-gray-400 cursor-not-allowed px-4 py-2 rounded-md">' . $anterior . '</span>
                            </li>';
                  } else {
                      echo '<li class="page-item">
                              <a class="page-link text-gray-700 hover:text-blue-600 hover:bg-gray-200 px-4 py-2 rounded-md" href="javascript:void(0);" onclick="BuscarUsuarios(' . ($pagina - 1) . ')">' . $anterior . '</a>
                            </li>';
                  }

                  // Mostrar páginas intermedias
                  if ($pagina > ($adjacents + 1)) {
                      echo '<li class="page-item"><a class="page-link text-gray-700 hover:text-blue-600 hover:bg-gray-200 px-4 py-2 rounded-md" href="javascript:void(0);" onclick="BuscarUsuarios(1)">1</a></li>';
                  }

                  if ($pagina > ($adjacents + 2)) {
                      echo '<li class="page-item disabled"><span class="page-link text-gray-400 cursor-not-allowed px-4 py-2 rounded-md">...</span></li>';
                  }

                  $pmin = ($pagina > $adjacents) ? ($pagina - $adjacents) : 1;
                  $pmax = ($pagina < ($TotalPaginas - $adjacents)) ? ($pagina + $adjacents) : $TotalPaginas;

                  for ($i = $pmin; $i <= $pmax; $i++) {
                      if ($i == $pagina) {
                          echo '<li class="page-item"><span class="page-link text-white bg-blue-600 px-4 py-2 rounded-md">' . $i . '</span></li>';
                      } else {
                          echo '<li class="page-item"><a class="page-link text-gray-700 hover:text-blue-600 hover:bg-gray-200 px-4 py-2 rounded-md" href="javascript:void(0);" onclick="BuscarUsuarios(' . $i . ')">' . $i . '</a></li>';
                      }
                  }

                  // Mostrar los puntos suspensivos y la última página si es necesario
                  if ($pagina < ($TotalPaginas - $adjacents - 1)) {
                      echo '<li class="page-item disabled"><span class="page-link text-gray-400 cursor-not-allowed px-4 py-2 rounded-md">...</span></li>';
                  }

                  if ($pagina < ($TotalPaginas - $adjacents)) {
                      echo '<li class="page-item"><a class="page-link text-gray-700 hover:text-blue-600 hover:bg-gray-200 px-4 py-2 rounded-md" href="javascript:void(0);" onclick="BuscarUsuarios(' . $TotalPaginas . ')">' . $TotalPaginas . '</a></li>';
                  }

                  // Botón para la siguiente página
                  if ($pagina < $TotalPaginas) {
                      echo '<li class="page-item">
                              <a class="page-link text-gray-700 hover:text-blue-600 hover:bg-gray-200 px-4 py-2 rounded-md" href="javascript:void(0);" onclick="BuscarUsuarios(' . ($pagina + 1) . ')">' . $siguiente . '</a>
                            </li>';
                  } else {
                      echo '<li class="page-item disabled">
                              <span class="page-link text-gray-400 cursor-not-allowed px-4 py-2 rounded-md">' . $siguiente . '</span>
                            </li>';
                  }

                  // Botón para la última página
                  if ($pagina != $TotalPaginas) {
                      echo '<li class="page-item">
                              <a class="page-link text-gray-700 hover:text-blue-600 hover:bg-gray-200 px-4 py-2 rounded-md" href="javascript:void(0);" onclick="BuscarUsuarios(' . $TotalPaginas . ')" aria-label="Última">
                                  <span aria-hidden="true">&raquo;</span>
                              </a>
                            </li>';
                  }

                  echo '</ul>
                      </nav>
                  </div>';
              }

    }

  public static function DatosDeTablaTransparente(){
    $us = new Transparente();  // Creando una nueva instancia de la clase Usuario
    $listarDeCuanto = 5;$pagina = 1;
    $resultodoUsuarios = $us->SelectPorBusquedaTransparente("",false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SelectPorBusquedaTransparente('',$inicioList,$listarDeCuanto);
    require("vista/transparente/servidor/transparenteTabla.php");
  }

  public static function registrarTransparente($a){
    $us = new Transparente();
    $r = "";
    $usuario_id = $_SESSION["usuario_id"];
    if (isset($_FILES['archivo'])) {//si existe el archivo
      $archivo = $_FILES["archivo"];
      $r="vista/activos/documento/transparente/";//ruta donde se guardara el archivo
        if ($archivo['type'] === 'application/pdf') {//verificamos si es un pdf
          if ($archivo['size'] <= 10485760) {//menor a 10mb

            $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
            $nombreUnico = bin2hex(random_bytes(16)) . '.' . $extension;
            $r = $r.$nombreUnico;
            move_uploaded_file($archivo['tmp_name'], $r);//movemos el archivo a la ruta $r
          }else{
            echo "archivo_pesado";return;
          }
        } else {
            echo "Solo_se_permite_PDF";return;
        }
    } else {
      if($a["id"] == ""){//si es vacio se quiere registrar
        echo "No_se_recibio_ningun_archivo";return;
      }
    }

        $data = ["categoria", "cod", "descripcion", "fecha_creacion","nombre_documento","publicar","estado"];
        $vacio = false;

        foreach ($data as $campo) {
          if (empty($a[$campo])) {
            $vacio = true;
            break;
          }
        }

        if ($vacio) {
          echo "vacio";
        } else {
          $resul = $us->registrar($a,$usuario_id,$r);
          echo $resul ? "correcto" : "error";
        }
  }

  public static function BuscarTransparente($pagina,$listarDeCuanto,$buscar){
      $us = new Transparente();  // Creando una nueva instancia de la clase Usuario
      $resultodoUsuarios = $us->SelectPorBusquedaTransparente($buscar,false,false);
      $num_filas_total = mysqli_num_rows($resultodoUsuarios);
      $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
              //calculamos el registro inicial
      $inicioList = ($pagina - 1) * $listarDeCuanto;

      $resul = $us->SelectPorBusquedaTransparente($buscar,$inicioList,$listarDeCuanto);
      echo '<div class="overflow-x-auto">
          <table class="table-auto w-full text-sm text-left border-collapse">
            <thead>
              <tr>
                <th class="px-4 py-2 border">N°</th>
                <th class="px-4 py-2 border">Categoría</th>
                <th class="px-4 py-2 border">Nombre Documento</th>
                <th class="px-4 py-2 border">Descripción</th>
                <th class="px-4 py-2 border">Usuario</th>
                <th class="px-4 py-2 border">Publicar</th>
                <th class="px-4 py-2 border">Fecha Creación</th>
                <th class="px-4 py-2 border">Acción</th>
              </tr>
            </thead>
            <tbody>';
                if ($resul && mysqli_num_rows($resul) > 0) {
                    $i = $inicioList;
                    while($fi = mysqli_fetch_array($resul)){
                        echo "<tr>";
                            echo "<td class='px-4 py-2 border'>".($i+1)."</td>";
                            echo "<td class='px-4 py-2 border'>".$fi['categoria']."</td>";
                            echo "<td class='px-4 py-2 border'>".$fi['nombre_documento']."</td>";
                            echo "<td class='px-4 py-2 border'>".$fi['descripcion']."</td>";
                            echo "<td class='px-4 py-2 border'>".$fi['usuario_id']."</td>";

                            // Publicar columna (Sí/No)
                            $publica = $fi["publicar"];
                            if ($publica == 1) {
                                echo "<td class='px-4 py-2 border'>Sí</td>";
                            } else {
                                echo "<td class='px-4 py-2 border'>No</td>";
                            }

                            echo "<td class='px-4 py-2 border'>".$fi['fecha_creacion']."</td>";

                            // Acción con botones Editar y Eliminar
                            echo "<td class='px-4 py-2 border'>";

                            $datos = [
                                "id" => $fi["id"],
                                "categoria" => addslashes($fi["categoria"]),
                                "cod" => addslashes($fi["cod"]),
                                "descripcion" => addslashes($fi["descripcion"]),
                                "fecha_creacion" => $fi["fecha_creacion"],
                                "nombre_documento" => addslashes($fi["nombre_documento"]),
                                "estado" => addslashes($fi["estado"]),
                                "publicar" => addslashes($fi["publicar"]),
                            ];

                            echo "<div class='flex gap-2'>
                                    <button type='button' class='px-4 py-2 bg-blue-500 text-white rounded-md shadow-sm' title='Editar'
                                        data-bs-toggle='modal' data-bs-target='#ModalRegistro' onclick='openModal();accionBtnEditar(".json_encode($datos).")'>
                                        <i class='fas fa-edit'></i> Editar
                                    </button>
                                    <button type='button' class='px-4 py-2 bg-red-500 text-white rounded-md shadow-sm' title='Eliminar'
                                        onclick='accionBtnActivar(\"".$fi["id"]."\")'>
                                        <i class='fas fa-trash-alt'></i> Eliminar
                                    </button>
                                  </div>";
                            echo "</td>";
                        echo "</tr>";
                        $i++;
                    }
                } else {
                    echo "<tr>";
                    echo "<td colspan='8' class='px-4 py-2 text-center text-gray-500'>No se encontraron resultados</td>";
                    echo "</tr>";
                }

            echo '</tbody>
          </table>
        </div>';
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
  public static function eliminarDocumentosTra($id){
    $us = new Transparente();  // Creando una nueva instancia de la clase Usuario
    $resul = $us->EliminarDocTransaparente($id);
    if($resul){
      echo "correcto";
    }else {
      echo "error";
    }
  }


}


?>
