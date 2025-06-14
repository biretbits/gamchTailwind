<?php require_once('vista/esquema/header.php'); ?>
<input type="hidden" name="paginas"id='paginas' value="">

<!-- Banner superior -->
<br>
<div class="w-full px-4 py-4 ">
  <div class="flex flex-wrap">
    <div class="w-full md:w-1/12"></div>

    <div class="w-full md:w-10/12">
      <h3 class="text-left text-xl text-white font-semibold">
        <span class="bg-[#DC191B] px-1">Noticias.</span>
      </h3>
      <hr class="border-t-2 border-blue my-2">
    </div>
    <div class="w-full md:w-1/12"></div>
  </div>
</div>

<div class="container mx-auto px-4 p-3 bg-[#CFCFCF]/90  rounded-2xl">
  <div class="grid grid-cols-12 gap-4">

    <!-- margen izquierdo: oculto en móvil, visible en lg -->
    <div class="hidden sm:block col-span-0 lg:col-span-1"></div>

    <!-- contenido principal: ocupa todo en móvil, 8 columnas en lg -->
    <div class="col-span-12 lg:col-span-8 p-1">
      <?php
      function mostrarNoticia($fil, $tamanoClase = 'medium-news') {
          ?>
          <div class="md:w-1/2 p-3 border border-red-500 ">
              <div class="news-card <?php echo $tamanoClase; ?>">
                <div class="w-full flex justify-center items-center overflow-hidden">
                  <img
                    src="<?php echo ($fil['foto'] != '') ? $fil['foto'] : 'imagenes/img-challapata/banner2.jpg'; ?>"
                    class="object-contain max-h-full max-w-full"
                    alt="Imagen dinámica">
                </div>
                <div class="news-overlay">
                  <a href="#" class="news-title stroke-text " onclick="SeguirLeyendo(<?php echo $fil["id"]; ?>)"><?php echo $fil['titulo']; ?></a>
                </div>
              </div>
              <div class="news-desc3 text-[#0F1618]"><?php echo $fil['contenido']; ?></div>
              <div class="news-date text-[#0F1618]">Fecha:
                <?php echo fechaAnoMesDia($fil["fecha"]); ?></div>
              <div class="text-right">
                <a href="#" onclick="SeguirLeyendo(<?php echo $fil["id"]; ?>)" class="text-white bg-[#DC191B] p-1 rounded-lg hover:bg-[#A30716]">Ver más</a>
              </div>
          </div>
          <?php
      }

      $j = 0;
      $abiertaFila = false;
      while ($fil = mysqli_fetch_assoc($resul)) {
          if ($j == 0) {
              ?>

              <div class="flex flex-wrap">
                <div class="news-card md:w-full p-2 border border-red-500">
                    <div class="w-full flex justify-center items-center overflow-hidden">
                        <img
                            src="<?php echo ($fil['foto'] != '') ? $fil['foto'] : 'imagenes/img-challapata/banner2.jpg'; ?>"
                            class="object-contain max-h-full max-w-full"
                            alt="Imagen dinámica">
                    </div>
                    <div class="news-overlay w-full flex justify-center items-center">
                        <a href="#"  onclick="SeguirLeyendo(<?php echo $fil["id"]; ?>)" class="news-title stroke-text "><?php echo $fil['titulo']; ?></a>
                    </div>
                </div>

                <!-- Contenedor de los elementos contenido y fecha con flexbox -->
                <div class="flex flex-col w-full text-left">
                    <div class="news-desc3 md:w-full text-[#0F1618]"><?php echo $fil['contenido']; ?></div>
                    <div class="news-date md:w-full text-left text-[#0F1618]"><?php echo fechaAnoMesDia($fil["fecha"]); ?></div>
                </div>
                <!-- Contenedor para el enlace "Ver más" alineado a la derecha -->
                <div class="text-right w-full p-1">
                    <a href="#" onclick="SeguirLeyendo(<?php echo $fil["id"]; ?>)" class="text-white bg-[#DC191B] p-1 rounded-lg hover:bg-[#A30716]">Ver más</a>
                </div>
              </div>

              <?php
          } else {
              if ($j % 2 == 1) {
                  echo '<div class="flex flex-wrap">';
                  $abiertaFila = true;
              }
              mostrarNoticia($fil);
              if ($j % 2 == 0 && $abiertaFila) {
                  echo '</div>';
                  $abiertaFila = false;
              }
          }
          $j++;
      }
      if ($abiertaFila) {
          echo '</div>';
      }
      ?>
    </div>

    <!-- noticias pasadas: ocupa todo en móvil, 2 columnas en lg -->
    <div class="col-span-12 lg:col-span-2 p-1">
      <div class="space-y-2">
        <h6 class="text-white bg-[#DC191B] p-1">Noticias Pasadas</h6>
        <?php if(mysqli_num_rows($resulNo) > 0){?>
          <?php while($fi = mysqli_fetch_assoc($resulNo)){?>
            <div class="border-t border-red-500 py-0">
            <div class="flex justify-center items-center overflow-hidden">
              <img
                src="<?php echo ($fi['foto'] != '') ? $fi['foto'] : 'imagenes/img-challapata/banner2.jpg'; ?>"
                alt="Imagen dinámica"
                class="object-contain max-w-full max-h-40" />
            </div>
            <a href="#" onclick="SeguirLeyendo(<?php echo $fi["id"]; ?>)"
               class="block mt-2 mb-1 text-base font-semibold truncate news-title1 text-[#0F1618]">
              <?php echo $fi["titulo"]; ?>
            </a>
            <div class="text-sm text-[#0F1618] ">
              Fecha: <?php echo fechaAnoMesDia($fi["fecha"]); ?>
            </div>
          </div>

          <?php } ?>
        <?php } ?>
      </div>
    </div>

    <!-- margen derecho: oculto en móvil, visible en lg -->
    <div class="hidden sm:block col-span-0 lg:col-span-1"></div>

  </div>
</div>

<div class="bg-white">
  <div class="container mx-auto py-8">
    <div class="flex justify-start">
      <div data-aos="fade-down" data-aos-duration="1200">
        <div>
          <h4 class="text-xl font-bold uppercase text-gray-800 text-left">MAS NOTICIAS</h4>
          <h6 class="text-base text-gray-500 italic text-left">Gobierno Autónomo Municipal de Challapata</h6>
          <hr class="border-t border-gray-300 my-2">
        </div>
      </div>
    </div>

    <div id='viewTabla' class="mt-6">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <?php if ($resul2 && $resul2->num_rows > 0): ?>
          <?php while ($newpage = $resul2->fetch_object()): ?>
            <div class="mb-4">
              <div class="card1 border-2 border-cyan-500 rounded-lg shadow-md hover:shadow-lg transition-all">
                <div class="p-4">
                  <div class="w-full h-52 overflow-hidden">
                    <img src="<?= htmlspecialchars($newpage->foto) ?>" alt="noticia" class="w-full h-full object-cover">
                  </div>
                </div>
                <div class="p-4 text-xs">
                  <ul class="flex space-x-2 uppercase text-gray-500 text-sm mb-2">
                    <li><a href="#" class="text-black">Publicado</a></li>
                    <li><a href="#" class="text-black"><?= htmlspecialchars(fechaAnoMesDia($newpage->fecha)) ?></a></li>
                  </ul>

                  <h5 class="text-sm font-bold">
                    <a href="#" class="text-center mb-2 text-gray-900 font-semibold text-sm break-words px-3" onclick="SeguirLeyendo(<?= htmlspecialchars($newpage->id) ?>)" class="text-black">
                      <?= htmlspecialchars($newpage->titulo) ?>
                    </a>

                  </h5>

                  <p class="text-gray-500">
                    <?= substr(strip_tags($newpage->contenido), 0, 200) . '...' ?>
                  </p>

                  <a href="#" onclick="SeguirLeyendo(<?= $newpage->id ?>)" class="text-cyan-600 text-sm">Seguir Leyendo Más</a>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <div class="text-center">
            <p class="text-gray-600">No se encontraron noticias.</p>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

function verificarList(valor){
  if(valor != "" && valor != "--"){
    return valor;
  }else{
    return 5;
  }
}
function BuscarUsuarios(page){
  var obt_lis = 5;
    var listarDeCuanto = verificarList(obt_lis);
    document.getElementById("paginas").value=page;
    //alert(buscar);
    //ponerFechactualAlModalDeReporte(listarDeCuanto,buscar,page,fecha);
    var datos = new FormData(); // Crear un objeto FormData vacío
    datos.append('pagina', page);
    datos.append('listarDeCuanto',listarDeCuanto);
      $.ajax({
        url: "/listarNoticias",
        type: "POST",
        data: datos,
        contentType: false, // Deshabilitar la codificación de tipo MIME
        processData: false, // Deshabilitar la codificación de datos
        success: function(data) {
        ///alert(data+"dasdas");
          $("#viewTabla").html(data);
        }
      });
  }

</script>

<?php require_once('vista/esquema/footeruni.php'); ?>
