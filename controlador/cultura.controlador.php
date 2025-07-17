<?php

require 'modelo/cultura.php';
class CulturaControlador{

  public static function ViewCultura(){
    $us = new Cultura();
    $resul = $us->SeleccionarCultura();
    require("vista/cultura/cliente/cultura.php");
  }

  public static function visualizarCultura(){
    $us = new Cultura();  // Creando una nueva instancia de la clase Usuario
    $listarDeCuanto = 5;$pagina = 1;
    $resultodoUsuarios = $us->SeleccionarCultura("",false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;
    $resul = $us->SeleccionarCultura();
    require("vista/cultura/servidor/culturaTabla.php");
  }

  public static function Registrar($a) {
    $us = new Cultura();  // Creando una nueva instancia de la clase Usuario

    $campos = [
        "nombre_actividad",
        "descripcion",
        "fecha_inicio",
        "fecha_fin",
        "ubicacion",
        "contacto",
    ];

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
        exit();
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
                $maxSize = 4 * 1024 * 1024; // 30MB (Revisar si esto es lo que quieres)
                if ($_FILES['imagen_url']['size'] > $maxSize) {
                    echo "El archivo es demasiado grande. El tamaño máximo permitido es 4 MB.";
                    exit();
                }

                // Definir el directorio de destino y sanitizar el nombre del archivo
                $directorioDestino = "vista/activos/CulturaImagen/";
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
                    exit();
                }
            } else {
                echo "El tipo de archivo no está permitido. Solo se permiten imágenes JPG, PNG o GIF.";
                exit();
            }
        }
        // Llamar a la función de inserción pasando la ruta del archivo
        $re = $us->insertarDatosCultura($a, $archivoRuta);
        if($re){
          echo "correcto";
        }else{
          echo "error";
        }
    }
  }

  public static function buscarCultura($pagina, $listarDeCuanto, $buscar){
    $us = new Cultura();  // Creando una nueva instancia de la clase Usuario
    $resultodoUsuarios = $us->SeleccionarCultura($buscar,false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SeleccionarCultura($buscar,$inicioList,$listarDeCuanto);
    echo '<div class="overflow-x-auto">
      <table class="table-auto w-full text-sm text-left border-collapse">
        <thead>
          <tr>
            <th class="px-4 py-2 border">N°</th>
            <th class="px-4 py-2 border">Nombre Actividad</th>
            <th class="px-4 py-2 border">Tipo de Actividad</th>
            <th class="px-4 py-2 border">Descripción</th>
            <th class="px-4 py-2 border">Fecha Inicio</th>
            <th class="px-4 py-2 border">Fecha fin</th>
            <th class="px-4 py-2 border">Ubicación</th>
            <th class="px-4 py-2 border">Contacto</th>
            <th class="px-4 py-2 border">Enlace web</th>
            <th class="px-4 py-2 border">Imagen</th>
            <th class="px-4 py-2 border">Creado en</th>
            <th class="px-4 py-2 border">Actualizado en</th>
            <th class="px-4 py-2 border">Acción</th>
          </tr>
        </thead>
        <tbody>';
          if ($resul && mysqli_num_rows($resul) > 0) {
              $i = $inicioList;
              while($fi = mysqli_fetch_array($resul)){
                  echo "<tr class='border-b'>"; // Para agregar bordes entre filas
                  echo "<td class='px-4 py-2'>" . ($i + 1) . "</td>"; // N°

                  echo "<td class='px-4 py-2'>" . htmlspecialchars($fi['nombre_actividad']) . "</td>"; // Nombre Actividad
                  echo "<td class='px-4 py-2'>" . htmlspecialchars($fi['tipo_actividad']) . "</td>";   // Tipo de Actividad
                  echo "<td class='px-4 py-2'>";
                  echo "<p id='descripcion-" . $fi['id'] . "' class='text-sm text-gray-500 mt-2 line-clamp-2'>";
                  echo htmlspecialchars($fi['descripcion']);
                  echo "</p>";
                  // Botón para alternar entre "ver más" y "ver menos"
                  echo "<button id='verMasBtn-" . $fi['id'] . "' class='text-blue-500 hover:text-blue-700 mt-2' onclick='toggleDescripcion(" . $fi['id'] . ")'>Ver más</button>";
                  echo "</td>";
                  echo "<td class='px-4 py-2'>" . htmlspecialchars($fi['fecha_inicio']) . "</td>";     // Fecha Inicio
                  echo "<td class='px-4 py-2'>" . htmlspecialchars($fi['fecha_fin']) . "</td>";        // Fecha fin
                  echo "<td class='px-4 py-2'>" . htmlspecialchars($fi['ubicacion']) . "</td>";        // Ubicación
                  echo "<td class='px-4 py-2'>" . htmlspecialchars($fi['contacto']) . "</td>";         // Contacto
                  echo "<td class='px-4 py-2'>" . htmlspecialchars($fi['enlace_web']) . "</td>";       // Enlace web

                  // Imagen
                  echo "<td class='px-4 py-2'>";
                  if (!empty($fi['imagen_url'])) {
                      echo "<img src='" . htmlspecialchars($fi['imagen_url']) . "' alt='Imagen' class='max-w-[100px]'>";
                  } else {
                      echo "Sin imagen";
                  }
                  echo "</td>";

                  // Creado en y actualizado en
                  echo "<td class='px-4 py-2'>" . htmlspecialchars($fi['creado_en']) . "</td>";
                  echo "<td class='px-4 py-2'>" . htmlspecialchars($fi['actualizado_en']) . "</td>";

                  // Botón de acción
                  $descripcion = addslashes($fi["descripcion"]);
                  $datos = [
                      "id" => $fi["id"],
                      "nombre_actividad" => addslashes($fi["nombre_actividad"]),
                      "tipo_actividad" => addslashes($fi["tipo_actividad"]),
                      "descripcion" => $descripcion,
                      "fecha_inicio" => addslashes($fi["fecha_inicio"]),
                      "fecha_fin" => addslashes($fi["fecha_fin"]),
                      "ubicacion" => addslashes($fi["ubicacion"]),
                      "contacto" => addslashes($fi["contacto"]),
                      "enlace_web" => addslashes($fi["enlace_web"])
                  ];
                  echo "<td class='px-4 py-2'>";
                  echo '<div class="flex space-x-2">
                          <button type="button" class="bg-blue-500 text-white px-3 py-1 rounded-sm shadow-md hover:bg-blue-600" title="Editar"
                              data-bs-toggle="modal" data-bs-target="#ModalRegistro"
                              onclick=\'openModal();accionBtnEditar(' . json_encode($datos) . ')\' >
                              <i class="fas fa-edit"></i> Editar
                          </button>
                        </div>';
                  echo "</td>";
                  echo "</tr>";
                  $i++;
              }
          } else {
              echo "<tr class='border-b'>";
              echo "<td colspan='15' class='px-4 py-2 text-center'>No se encontraron resultados</td>";
              echo "</tr>";
          }

          echo "   </tbody>
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
