
<?php
require_once "modelo/turismo.php";
class TurismoControlador{
  public static function ViewTurismo(){
    $us = new Turismo();
    $resul = $us->SeleccionarTurismo();
    require("vista/turismo/cliente/turismo.php");
  }

  public static function VisualizarTurismo(){
    $us = new Turismo();  // Creando una nueva instancia de la clase Usuario
    $listarDeCuanto = 5;$pagina = 1;
    $resultodoUsuarios = $us->SeleccionarTurismo("",false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;
    $resul = $us->SeleccionarTurismo();
    require("vista/turismo/servidor/turismoTabla.php");
  }
  //funcion para insertar en la tabla turismo los datos
  public static function RegistrarDatosTurismo($a) {
    $us = new Turismo();  // Creando una nueva instancia de la clase Usuario

    $campos = ["nombre_destino", "descripcion", "tipo_destino", "ubicacion", "contacto"];
    $datos = [];
    $vacio = false;

    // Validar que todos los campos estén presentes y no vacíos
    foreach ($campos as $campo) {
        if (!isset($a[$campo]) || trim($a[$campo]) === "") {
            $vacio = true;
            break;
        }
    }
    if ($vacio) {
        echo "vacio";
    } else {
        $archivoRuta = '';

        // Validar que el archivo imagen_url exista y sea válido
        if (isset($_FILES['imagen_url']) && $_FILES['imagen_url']['error'] == 0) {
            // Validar el tipo de archivo, por ejemplo, imágenes .jpg, .png, o .gif
            $tipoArchivo = $_FILES['imagen_url']['type'];
            $permitidos = ['image/jpeg', 'image/png', 'image/gif']; // Tipos permitidos

            // Comprobar que el tipo de archivo es válido
            if (in_array($tipoArchivo, $permitidos)) {
                // Validar el tamaño del archivo (opcional, ejemplo: máximo 30 MB)
                $maxSize = 30 * 1024 * 1024; // 30MB (Revisar si esto es lo que quieres)
                if ($_FILES['imagen_url']['size'] > $maxSize) {
                    echo "El archivo es demasiado grande. El tamaño máximo permitido es 30 MB.";
                    return;
                }

                // Definir el directorio de destino y sanitizar el nombre del archivo
                $directorioDestino = "vista/activos/turismoImagen/";
                $extension = pathinfo($_FILES["imagen_url"]["name"], PATHINFO_EXTENSION);
                // Generar un nombre único para evitar colisiones y asegurar seguridad
                $nombreUnico = bin2hex(random_bytes(16)) . '.' . $extension;
                $archivoDestino = $directorioDestino . $nombreUnico;

                // Intentar mover el archivo al directorio de destino
                if (move_uploaded_file($_FILES['imagen_url']['tmp_name'], $archivoDestino)) {
                    // Archivo movido correctamente, guardar la ruta en la variable
                    $archivoRuta = $archivoDestino;
                } else {
                    echo "Error al mover el archivo.";
                    return;
                }
            } else {
                echo "El tipo de archivo no está permitido. Solo se permiten imágenes JPG, PNG o GIF.";
                return;
            }
        }
        // Llamar a la función de inserción pasando la ruta del archivo
        $re = $us->insertarDatosTurismo($a, $archivoRuta);
        if($re){
          echo "correcto";
        }else{
          echo "error";
        }
    }


  }

  public static function BuscarTurismo($pagina, $listarDeCuanto, $buscar){
    $us = new Turismo();  // Creando una nueva instancia de la clase Usuario
    $resultodoUsuarios = $us->SeleccionarTurismo($buscar,false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SeleccionarTurismo($buscar,$inicioList,$listarDeCuanto);
    echo '<div class="overflow-x-auto">
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
        <tbody>';
          if ($resul && mysqli_num_rows($resul) > 0) {
            $i = $inicioList;
            while($fi = mysqli_fetch_array($resul)){
                echo "<tr class='border-b'>";
                  echo "<td class='px-4 py-2'>" . ($i+1) . "</td>";
                  echo "<td class='px-4 py-2'>" . htmlspecialchars($fi['nombre_destino']) . "</td>";
                  echo "<td class='px-4 py-2'>" . htmlspecialchars($fi['tipo_destino']) . "</td>";
                  echo "<td class='px-4 py-2'>" . htmlspecialchars($fi['descripcion']) . "</td>";
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


}


?>
