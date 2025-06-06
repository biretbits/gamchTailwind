<?php
require_once "modelo/usuario.php";
class UsuarioControlador{
  public static function visualizarRol(){
    $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
    $listarDeCuanto = 5;$pagina = 1;
    $resultodoUsuarios = $us->SelectPorBusqueda("",false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SelectPorBusqueda('',$inicioList,$listarDeCuanto);

    require("vista/usuario/rol.php");
  }

  public static function RegistrarRol($a){
    $us = new Usuario();  // Creando una nueva instancia de la clase Usuario

    $data = ["nombre", "slug", "descripcion", "especial"];
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
      $resul = $us->registrarRole($a);
      echo $resul ? "correcto" : "error";
    }
  }

  public static function BuscarUsuarioTabla($pagina,$listarDeCuanto,$buscar){
    $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
    $resultodoUsuarios = $us->SelectPorBusqueda($buscar,false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SelectPorBusqueda($buscar,$inicioList,$listarDeCuanto);
    echo '<div class="overflow-x-auto">
      <table class="table-auto w-full text-sm text-left border-collapse">
        <thead>
          <tr>
            <th class="px-4 py-2 border">N°</th>
            <th class="px-4 py-2 border">Nombre</th>
            <th class="px-4 py-2 border">Slug</th>
            <th class="px-4 py-2 border">Descripcion</th>
            <th class="px-4 py-2 border">Fecha creado</th>
            <th class="px-4 py-2 border">Fecha actualizado</th>
            <th class="px-4 py-2 border">Especial</th>
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
                        echo "<td class='px-4 py-2 border'>".$fi['slug']."</td>";
                        echo "<td class='px-4 py-2 border'>".$fi['descripcion']."</td>";
                        echo "<td class='px-4 py-2 border'>".$fi['creado_en']."</td>";
                        echo "<td class='px-4 py-2 border'>".$fi['actualizado_en']."</td>";
                        echo "<td class='px-4 py-2 border'>".$fi['especial']."</td>";
                        echo "<td class='px-4 py-2 border'>
                            <div class='flex gap-2'>
                                <button type='button'
                                    class='py-1 px-3 bg-blue-500 text-white rounded-md shadow-sm'
                                    title='Editar'
                                    data-bs-toggle='modal'
                                    data-bs-target='#ModalRegistro'
                                    onclick='openModal();accionBtnEditar(
                                        \"".$fi["id"]."\",
                                        \"".$fi["nombre"]."\",
                                        \"".$fi["slug"]."\",
                                        \"".$fi["descripcion"]."\",
                                        \"".$fi["especial"]."\")'>
                                    <i class='fas fa-edit'></i> Editar
                                </button>";
                        echo "<button type='button'
                                    class='py-1 px-3 bg-red-500 text-white rounded-md shadow-sm'
                                    title='Eliminar'
                                    onclick='accionBtnActivar(
                                        \"".$fi["id"]."\"
                                    )'>
                                    <i class='fas fa-trash-alt'></i> Eliminar
                                </button>";
                        echo "</div>";
                        echo "</td>";
                    echo "</tr>";
                    $i++;
                }
            } else {
                echo "<tr>";
                echo "<td colspan='8' class='text-center text-gray-500'>No se encontraron resultados</td>";
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

  public static function visualizarRolUsuario(){
    $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
    $listarDeCuanto = 5;$pagina = 1;
    $resultodoUsuarios = $us->SelectPorBusquedaU("",false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SelectPorBusquedaU('',$inicioList,$listarDeCuanto);

    require("vista/usuario/rol_usuario.php");
  }

  public static function CrearTablaUsuarioGamch(){
    require("vista/esquema/bd/crear/tablas.php");
  }

  public static function panelUsuario(){
    require("vista/panelControl/panelUsuario.php");
  }
  public static function panelPermisos(){
    $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
    $listarDeCuanto = 5;$pagina = 1;
    $resultodoUsuarios = $us->SelectPorBusquedaPer("",false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SelectPorBusquedaPer('',$inicioList,$listarDeCuanto);
    require("vista/permisos/permisos.php");
  }

  public static function RegistrarPermiso($a){
    $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
    $resul = $us->registrarPermisos($a);
    if ($resul) {
              echo "correcto";
          } else {
              echo "error";
          }
  }

  public static function BuscarPermisos($pagina,$listarDeCuanto,$buscar){
    $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
    $resultodoUsuarios = $us->SelectPorBusquedaPer($buscar,false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SelectPorBusquedaPer($buscar,$inicioList,$listarDeCuanto);
    echo "
    <div class='row'>
      <div class='col'>
        <div class='table-responsive'>
        <table class='table' style='font-size:12px'>
          <thead>
          <tr>
            <th>N°</th>
            <th>Nombre</th>
            <th>Slug</th>
            <th>Descripción</th>
            <th>Fecha de Creación</th>
            <th>Acción</th>
            </tr>
          </thead>
          <tbody>";
          if ($resul && mysqli_num_rows($resul) > 0) {
            $i = $inicioList;
             while($fi = mysqli_fetch_array($resul)){
                echo "<tr>";
                  echo "<td>".($i+1)."</td>";
                  echo "<td>".$fi['nombre']."</td>";
                  echo "<td>".$fi['slug']."</td>";
                  echo "<td>".$fi['descripcion']."</td>";
                  echo "<td>".$fi['creado_en']."</td>";
                  echo "<td>";
                  $id_u = '';
                    echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>
                    <button type='button'
                 class='btn btn-info btn-sm shadow-sm'
                 title='Editar'
                 data-bs-toggle='modal'
                 data-bs-target='#ModalRegistro'
                 onclick='accionBtnEditar(
                 \"".$fi["id"]."\",
                 \"".$fi["nombre"]."\",
                 \"".$fi["slug"]."\",
                 \"".$fi["descripcion"]."\"
                 )'>

             <i class='fas fa-edit'></i></button>";

                    echo "</div>";
                  echo "</td>";
                echo "</tr>";
                $i++;
              }
            }else{
              echo "<tr>";
              echo "<td colspan='15' align='center'>No se encontraron resultados</td>";
              echo "</tr>";
            }

        echo "
        </tbody>
      </table>
      </div>
    </div>
  </div>";
  if($TotalPaginas!=0){
    $adjacents=1;
    $anterior = "&lsaquo; Anterior";
    $siguiente = "Siguiente &rsaquo;";
echo "<div class='row'>
      <div class='col'>";

    echo "<div class='d-flex flex-wrap flex-sm-row justify-content-between'>";
      echo '<ul class="pagination">';
        echo "pagina &nbsp;".$pagina."&nbsp;con&nbsp;";
          $total=$inicioList+$pagina;
          if($TotalPaginas > $num_filas_total){
            $TotalPaginas = $num_filas_total;
          }
        echo '<li class="page-item active"><a class=" href="#"> '.($TotalPaginas).' </a></li> ';
        echo " &nbsp;de&nbsp;".$num_filas_total." registros";
      echo '</ul>';

      echo '<ul class="pagination d-flex flex-wrap">';

      // previous label
      if ($pagina != 1) {
        echo "<li class='page-item'><a class='page-link'  onclick=\"BuscarUsuarios(1)\"><span aria-hidden='true'>&laquo;</span></a></li>";
      }
      if($pagina==1) {
        echo "<li class='page-item'><a class='page-link text-muted'>$anterior</a></li>";
      } else if($pagina==2) {
        echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarUsuarios(1)\" class='page-link'>$anterior</a></li>";
      }else {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarUsuarios($pagina-1)\">$anterior</a></li>";

      }
      // first label
      if($pagina>($adjacents+1)) {
        echo "<li class='page-item'><a href='javascript:void(0);' class='page-link' onclick=\"BuscarUsuarios(1)\">1</a></li>";
      }
      // interval
      if($pagina>($adjacents+2)) {
        echo"<li class='page-item'><a class='page-link'>...</a></li>";
      }

      // pages

      $pmin = ($pagina>$adjacents) ? ($pagina-$adjacents) : 1;
      $pmax = ($pagina<($TotalPaginas-$adjacents)) ? ($pagina+$adjacents) : $TotalPaginas;
      for($i=$pmin; $i<=$pmax; $i++) {
        if($i==$pagina) {
          echo "<li class='page-item active'><a class='page-link'>$i</a></li>";
        }else if($i==1) {
          echo"<li class='page-item'><a href='javascript:void(0);' class='page-link'onclick=\"BuscarUsuarios(1)\">$i</a></li>";
        }else {
          echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarUsuarios(".$i.")\" class='page-link'>$i</a></li>";
        }
      }

      // interval

      if($pagina<($TotalPaginas-$adjacents-1)) {
        echo "<li class='page-item'><a class='page-link'>...</a></li>";
      }
      // last

      if($pagina<($TotalPaginas-$adjacents)) {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link ' onclick=\"BuscarUsuarios($TotalPaginas)\">$TotalPaginas</a></li>";
      }
      // next

      if($pagina<$TotalPaginas) {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarUsuarios($pagina+1)\">$siguiente</a></li>";
      }else {
        echo "<li class='page-item'><a class='page-link text-muted'>$siguiente</a></li>";
      }
      if ($pagina != $TotalPaginas) {
        echo "<li class='page-item'><a class='page-link' onclick=\"BuscarUsuarios($TotalPaginas)\"><span aria-hidden='true'>&raquo;</span></a></li>";
      }

      echo "</ul>";
      echo "</div>";

echo "</div>
    </div>";


    }
  }

  public static function panelPermisosUsuario(){
    $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
    $listarDeCuanto = 5;$pagina = 1;
    $resultodoUsuarios = $us->SelectPorBusquedaPerUser("",false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SelectPorBusquedaPerUser('',$inicioList,$listarDeCuanto);
    require("vista/permisos/permisosUsuario.php");
  }

  public static function BuscarInformacionUsuario($buscar){
      $us = new Usuario();
    $re = $us->buscarInformacion($buscar);
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


    public static function buscandoPermisos($buscar){
        $us = new Usuario();
      $re = $us->buscarInformacionPermisos($buscar);
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

    public static function RegistrarPermisosUsuario($a){
      $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
      $resul = $us->registrarPermisosUsuarios($a);
      if ($resul) {
                echo "correcto";
            } else {
                echo "error";
            }
    }

    public static function BuscarPermisoUsuario($pagina,$listarDeCuanto,$buscar){
      $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
      $resultodoUsuarios = $us->SelectPorBusquedaPerUser($buscar,false,false);
      $num_filas_total = mysqli_num_rows($resultodoUsuarios);
      $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
              //calculamos el registro inicial
      $inicioList = ($pagina - 1) * $listarDeCuanto;

      $resul = $us->SelectPorBusquedaPerUser($buscar,$inicioList,$listarDeCuanto);
      echo "
      <div class='row'>
        <div class='col'>
          <div class='table-responsive'>
          <table class='table' style='font-size:12px'>
            <thead>
              <tr>
              <th>N°</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Slug</th>
              <th>Descripción</th>
              <th>Fecha de Creación</th>
              <th>Acción</th>
              </tr>
            </thead>
            <tbody>";
            if ($resul && mysqli_num_rows($resul) > 0) {
              $i = $inicioList;
               while($fi = mysqli_fetch_array($resul)){
                  echo "<tr>";
                    echo "<td>".($i+1)."</td>";
                    echo "<td>".$fi['usuario_nombre']." ".$fi['apellido_p']." ".$fi['apellido_m']."</td>";
                    echo "<td>".$fi['usuario']."</td>";
                    echo "<td>".$fi['slug']."</td>";
                    echo "<td>".$fi['descripcion']."</td>";
                    echo "<td>".$fi['creado_en']."</td>";
                    echo "<td>";
                    $id_u = '';
                      echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>
                      <button type='button'
                   class='btn btn-info btn-sm shadow-sm'
                   title='Editar'
                   data-bs-toggle='modal'
                   data-bs-target='#ModalRegistro'
                   onclick='accionBtnEditar(
                   \"".$fi["id"]."\",
                   \"".$fi["permiso_id"]."\",
                   \"".$fi["usuario_id"]."\",
                   )'>

               <i class='fas fa-edit'></i></button>";

                      echo "</div>";
                    echo "</td>";
                  echo "</tr>";
                  $i++;
                }
              }else{
                echo "<tr>";
                echo "<td colspan='15' align='center'>No se encontraron resultados</td>";
                echo "</tr>";
              }
            echo "
          </tbody>
        </table>
        </div>
      </div>
    </div>";
    if($TotalPaginas!=0){
      $adjacents=1;
      $anterior = "&lsaquo; Anterior";
      $siguiente = "Siguiente &rsaquo;";
  echo "<div class='row'>
        <div class='col'>";

      echo "<div class='d-flex flex-wrap flex-sm-row justify-content-between'>";
        echo '<ul class="pagination">';
          echo "pagina &nbsp;".$pagina."&nbsp;con&nbsp;";
            $total=$inicioList+$pagina;
            if($TotalPaginas > $num_filas_total){
              $TotalPaginas = $num_filas_total;
            }
          echo '<li class="page-item active"><a class=" href="#"> '.($TotalPaginas).' </a></li> ';
          echo " &nbsp;de&nbsp;".$num_filas_total." registros";
        echo '</ul>';

        echo '<ul class="pagination d-flex flex-wrap">';

        // previous label
        if ($pagina != 1) {
          echo "<li class='page-item'><a class='page-link'  onclick=\"BuscarUsuarios(1)\"><span aria-hidden='true'>&laquo;</span></a></li>";
        }
        if($pagina==1) {
          echo "<li class='page-item'><a class='page-link text-muted'>$anterior</a></li>";
        } else if($pagina==2) {
          echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarUsuarios(1)\" class='page-link'>$anterior</a></li>";
        }else {
          echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarUsuarios($pagina-1)\">$anterior</a></li>";

        }
        // first label
        if($pagina>($adjacents+1)) {
          echo "<li class='page-item'><a href='javascript:void(0);' class='page-link' onclick=\"BuscarUsuarios(1)\">1</a></li>";
        }
        // interval
        if($pagina>($adjacents+2)) {
          echo"<li class='page-item'><a class='page-link'>...</a></li>";
        }

        // pages

        $pmin = ($pagina>$adjacents) ? ($pagina-$adjacents) : 1;
        $pmax = ($pagina<($TotalPaginas-$adjacents)) ? ($pagina+$adjacents) : $TotalPaginas;
        for($i=$pmin; $i<=$pmax; $i++) {
          if($i==$pagina) {
            echo "<li class='page-item active'><a class='page-link'>$i</a></li>";
          }else if($i==1) {
            echo"<li class='page-item'><a href='javascript:void(0);' class='page-link'onclick=\"BuscarUsuarios(1)\">$i</a></li>";
          }else {
            echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarUsuarios(".$i.")\" class='page-link'>$i</a></li>";
          }
        }

        // interval

        if($pagina<($TotalPaginas-$adjacents-1)) {
          echo "<li class='page-item'><a class='page-link'>...</a></li>";
        }
        // last

        if($pagina<($TotalPaginas-$adjacents)) {
          echo "<li class='page-item'><a href='javascript:void(0);'class='page-link ' onclick=\"BuscarUsuarios($TotalPaginas)\">$TotalPaginas</a></li>";
        }
        // next

        if($pagina<$TotalPaginas) {
          echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarUsuarios($pagina+1)\">$siguiente</a></li>";
        }else {
          echo "<li class='page-item'><a class='page-link text-muted'>$siguiente</a></li>";
        }
        if ($pagina != $TotalPaginas) {
          echo "<li class='page-item'><a class='page-link' onclick=\"BuscarUsuarios($TotalPaginas)\"><span aria-hidden='true'>&raquo;</span></a></li>";
        }

        echo "</ul>";
        echo "</div>";

  echo "</div>
      </div>";


      }
    }

    public static function listraUsuarios(){
      $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
      $listarDeCuanto = 5;$pagina = 1;
      $resultodoUsuarios = $us->SelectPorBusquedaListarUsuario("",false,false);
      $num_filas_total = mysqli_num_rows($resultodoUsuarios);
      $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
              //calculamos el registro inicial
      $inicioList = ($pagina - 1) * $listarDeCuanto;

      $resul = $us->SelectPorBusquedaListarUsuario('',$inicioList,$listarDeCuanto);
      require("vista/usuario/gestion_usuario.php");
    }

    public static function buscandoEmpleadoAhora($buscar){
      $us = new Usuario();
      $re = $us->buscarEmpleadoNuevo($buscar);
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

    public static function RegistrarNuevoUsuario($a){
      $us = new Usuario();  // Crear instancia de la clase Usuario

      // Validar campos requeridos
      $camposRequeridos = ["id_empleado", "usuario", "contrasena"];
      $vacio = false;

      foreach ($camposRequeridos as $campo) {
          if (!isset($a[$campo]) || trim($a[$campo]) === '') {
              $vacio = true;
              break;
          }
      }

      if (!$vacio) {
          $resul = $us->registrarUsuario($a);
          echo $resul ? "correcto" : "error";
      } else {
          echo "vacio";
      }
    }


        public static function BuscarUsuarioUno($pagina,$listarDeCuanto,$buscar){
          $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
          $resultodoUsuarios = $us->SelectPorBusquedaListarUsuario($buscar,false,false);
          $num_filas_total = mysqli_num_rows($resultodoUsuarios);
          $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
                  //calculamos el registro inicial
          $inicioList = ($pagina - 1) * $listarDeCuanto;

          $resul = $us->SelectPorBusquedaListarUsuario($buscar,$inicioList,$listarDeCuanto);
          echo '<div class="overflow-x-auto">
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
                  <tbody>';
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
                    echo "
                  </tbody>
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

        public static function buscandoRolUsuarios($buscar){
            $us = new Usuario();
          $re = $us->buscarInformacionRolUsuario($buscar);
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

    public static function RegistrarRolUsuario($a){
      $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
      $data = ["usuario_id","id_rol"];
      $vacio = false;
      if($data[0]==''||$data[1]==''){
        $vacio = true;
      }
      if($vacio == true){
        echo "vacio";
      }else{
        $resul = $us->registrarRolesUsuarios($a);
        if ($resul) {
          echo "correcto";
        } else {
          echo "error";
        }
      }
    }

    public static function BuscarRolesUsuarios($pagina,$listarDeCuanto,$buscar){
      $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
      $resultodoUsuarios = $us->SelectPorBusquedaU($buscar,false,false);
      $num_filas_total = mysqli_num_rows($resultodoUsuarios);
      $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
              //calculamos el registro inicial
      $inicioList = ($pagina - 1) * $listarDeCuanto;

      $resul = $us->SelectPorBusquedaU($buscar,$inicioList,$listarDeCuanto);
      echo '<div class="overflow-x-auto">
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
            <tbody>';
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

    public static function DesabilitarUsuario($id,$estado){
      $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
      $resul = $us->desactivarUsuarioTodo($id,$estado);
      if($resul){
        echo "correcto";
      }else {
        echo "error";
      }
    }

    public static function EliminarRolUsuarioo($id){
      $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
      $resul = $us->EliminarRolesUsuario($id);
      if($resul){
        echo "correcto";
      }else {
        echo "error";
      }
    }
    public static function EliminarRolesNuevos($id){
      $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
      $resul = $us->EliminarRolesNu($id);
      if($resul){
        echo "correcto";
      }else {
        echo "error";
      }
    }


}


?>
