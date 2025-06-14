<?php
require_once('vista/esquema/header.php');
?>

<!-- CDN Tailwind -->
<script src="https://cdn.tailwindcss.com"></script>

<div class="relative w-full overflow-hidden h-[35vh] sm:h-[90vh]">
  <div id="carouselSlides" class="relative h-full">
    <div class="carousel-item absolute inset-0 transition-opacity duration-700 opacity-100">
      <img src="imagenes/img-challapata/Banner1.webp" alt="Imagen 1" class="w-full h-full object-cover object-center" />
    </div>
    <div class="carousel-item absolute inset-0 transition-opacity duration-700 opacity-0 pointer-events-none">
      <img src="imagenes/img-challapata/banner2.jpg" alt="Imagen 2" class="w-full h-full object-cover object-center" />
    </div>
    <div class="carousel-item absolute inset-0 transition-opacity duration-700 opacity-0 pointer-events-none">
      <img src="imagenes/img-challapata/BannerWeb2025.jpg" alt="Imagen 3" class="w-full h-full object-cover object-center" />
    </div>
  </div>

  <!-- Botones -->
  <button id="prevBtn" aria-label="Anterior" class="absolute top-1/2 left-4 -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full p-3 hover:bg-opacity-75 z-10">
    &#10094;
  </button>
  <button id="nextBtn" aria-label="Siguiente" class="absolute top-1/2 right-4 -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full p-3 hover:bg-opacity-75 z-10">
    &#10095;
  </button>

  <!-- Indicadores -->
  <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-3">
    <button aria-label="Slide 1" class="w-3 h-3 rounded-full bg-white opacity-80"></button>
    <button aria-label="Slide 2" class="w-3 h-3 rounded-full bg-white opacity-40"></button>
    <button aria-label="Slide 3" class="w-3 h-3 rounded-full bg-white opacity-40"></button>
  </div>
</div>
<script>
  const slides = document.querySelectorAll('.carousel-item');
  const indicators = document.querySelectorAll('.absolute.bottom-4.left-1\\/2 > button');
  let currentIndex = 0;
  let intervalId;

  function showSlide(index) {
    slides.forEach((slide, i) => {
      if (i === index) {
        slide.classList.remove('opacity-0', 'pointer-events-none');
        slide.classList.add('opacity-100');
        indicators[i].classList.remove('opacity-40');
        indicators[i].classList.add('opacity-80');
      } else {
        slide.classList.add('opacity-0', 'pointer-events-none');
        slide.classList.remove('opacity-100');
        indicators[i].classList.remove('opacity-80');
        indicators[i].classList.add('opacity-40');
      }
    });
  }

  function nextSlide() {
    currentIndex = (currentIndex + 1) % slides.length;
    showSlide(currentIndex);
  }

  document.getElementById('prevBtn').addEventListener('click', () => {
    currentIndex = (currentIndex === 0) ? slides.length - 1 : currentIndex - 1;
    showSlide(currentIndex);
    resetInterval();
  });

  document.getElementById('nextBtn').addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % slides.length;
    showSlide(currentIndex);
    resetInterval();
  });

  // Reestablecer el intervalo cuando el usuario navega manualmente
  function resetInterval() {
    clearInterval(intervalId);
    intervalId = setInterval(nextSlide, 5000); // cambia cada 5 segundos
  }

  // Inicializar
  showSlide(currentIndex);
  intervalId = setInterval(nextSlide, 5000);
</script>


<style>
        /* Estilos adicionales para hacer que la imagen ocupe casi todo el modal */
        .swal2-image {
          width: 100%;
          height: auto;
          max-height: 500px; /* Limita el alto de la imagen */
          object-fit: cover; /* Asegura que la imagen se ajuste bien al contenedor */
        }
      </style>
    <!-- Script para mostrar la alerta al cargar la página -->
    <?php
    // Simulación de variable que indica si el usuario es admin
    $esAdmin = true; // o false

    // Generar el HTML/JS
    ?>
    <?php
      if(mysqli_num_rows($resulAlert)>0){
        $fila = mysqli_fetch_assoc($resulAlert);

        // Limitar el contenido a las primeras 4 líneas
        $contenido = $fila["contenido"];
        $lineas = explode("\n", $contenido);  // Dividir el contenido en líneas
        $contenidoLimitado = implode("\n", array_slice($lineas, 0, 4));  // Tomar las primeras 4 líneas

        echo '<script>
        window.onload = function() {
          const dateTimeText = "Fecha y Hora: 12/01/2025 00:00";
          Swal.fire({
            html: `
              <div class="swal2-date-time" style="text-align: left; font-size: 12px;">' . fechaAnoMesDia($fila["fecha"]) . '</div>
              <div class="swal2-title" style="text-align:center; font-size: 16px; font-weight: bold; margin-top: 10px;">' . $fila["titulo"] . '</div>
              <div style="text-align:center; margin-top: 10px;">' . nl2br(htmlspecialchars($contenidoLimitado)) . '</div>  <!-- Mostrar solo las primeras 4 líneas -->
            `,
            imageUrl: "' . $fila["foto"] . '",
            imageWidth: "100%",
            imageHeight: "auto",
            imageAlt: "Imagen de alerta",
            confirmButtonText: "Cerrar",
            showConfirmButton: true,
            heightAuto: false,
            customClass: {
              htmlContainer: "swal2-html-container"
            },
            timer: 9000,
            timerProgressBar: true,
          });
        };
        </script>';
      }else{
        echo '<script>
        window.onload = function() {
          const dateTimeText = "Fecha y Hora: 12/01/2025 00:00";
          Swal.fire({
            html: `
              <div class="swal2-date-time" style="text-align: left; font-size: 12px;">' . fechaAnoMesDia(date("Y-m-d")) . '</div>
              <div class="swal2-title" style="text-align:center; font-size: 16px; font-weight: bold; margin-top: 10px;">Gobierno Aútonomo Municipal de Challapata</div>
              <div style="text-align:center; margin-top: 10px;">Por un municipio saludable, fuerte y con mente productiva</div>  <!-- Mostrar solo las primeras 4 líneas -->
            `,
            imageUrl: "/imagenes/gamch/EscudoChallapata2024mediano2.png",
            imageWidth: "100%",
            imageHeight: "auto",
            imageAlt: "Imagen de alerta",
            confirmButtonText: "Cerrar",
            showConfirmButton: true,
            heightAuto: false,
            customClass: {
              htmlContainer: "swal2-html-container"
            },
            timer: 9000,
            timerProgressBar: true,
          });
        };
        </script>';

      }

     ?>
<br>
<div class="p-0 bg-cover bg-center bg-no-repeat" style="font-family: "Homer Simpson UI";background-image: url('imagenes/fondo/fondo3.svg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
  <!-- Encabezado -->
  <div class="text-center py-10">
    <h1  data-aos="zoom-in" data-aos-duration="600" class="text-4xl md:text-5xl font-bold text-[#DC191B] tracking-widest transform transition-all duration-300 hover:scale-110 hover:text-[#A30734] font-serif"
        style="font-family:  "Homer Simpson UI";
               text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3), 0 0 25px rgba(255, 255, 255, 0.1), 0 0 5px rgba(0, 0, 0, 0.2);">
        Destacados
    </h1>
    <hr class="mx-auto w-1/4 border border-yellow-500 opacity-100 mt-4 shadow-lg" />
</div>


<!-- Contenido principal -->
<div class="container mx-auto py-10 px-4">
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
    <!-- Item 1 -->
    <div class="flex" data-aos="zoom-in" data-aos-duration="600">
      <div class="bg-black bg-opacity-80 text-white rounded-2xl shadow-lg transition-transform duration-300 hover:-translate-y-2 hover:shadow-2xl w-full flex flex-col items-center text-center p-6">
        <i class="fas fa-users text-3xl text-yellow-400 mb-4"></i>
        <h4 class="text-xl font-bold mb-2" style="font-family: "Homer Simpson UI";">Desarrollo Humano y Social</h4>
        <p class="text-gray-400 mb-4">La Secretaria de Desarrollo Humano y social del G.A.M.CH. es una dependencia que busca mejorar la calidad de vida de los ciudadanos del municipio de Challapata mediante la gestión de servicios de salud y protección de grupos vulnerables deportes alimentacion escolar y desarrollo integral de capacidades humanas.</p>
        <a href="/SDHS" class="btn border border-yellow-400 text-yellow-400 hover:bg-yellow-400 hover:text-black mt-auto px-4 py-2 rounded transition">Ver más »</a>
      </div>
    </div>

    <!-- Item 2 -->
    <div class="flex" data-aos="zoom-in" data-aos-duration="600">
      <div class="bg-black bg-opacity-80 text-white rounded-2xl shadow-lg transition-transform duration-300 hover:-translate-y-2 hover:shadow-2xl w-full flex flex-col items-center text-center p-6">
        <i class="fas fa-leaf text-3xl text-yellow-400 mb-4"></i>
        <h4 class="text-xl font-bold mb-2" style="font-family: "Homer Simpson UI";">Desarrollo Productivo</h4>
        <p class="text-gray-400 mb-4">La finalidad de la secretaría de Desarrollo Productivo y Medio Ambiente es gestionar programas y proyectos de desarrollo forestal, agroforestal y manejo de recursos naturales que promuevan actividades productivas sostenibles mientras se conservan los suelos, cuencas y se cumple con las normas ambientales municipales.</p>
        <a href="/SDP" class="btn border border-yellow-400 text-yellow-400 hover:bg-yellow-400 hover:text-black mt-auto px-4 py-2 rounded transition">Ver más »</a>
      </div>
    </div>

    <!-- Item 3 -->
    <div class="flex" data-aos="zoom-in" data-aos-duration="600">
      <div class="bg-black bg-opacity-80 text-white rounded-2xl shadow-lg transition-transform duration-300 hover:-translate-y-2 hover:shadow-2xl w-full flex flex-col items-center text-center p-6">
        <i class="fas fa-hard-hat text-3xl text-yellow-400 mb-4"></i>
        <h4 class="text-xl font-bold mb-2" style="font-family: "Homer Simpson UI";">Obras Públicas</h4>
        <p class="text-gray-400 mb-4">La finalidad de la Secretaria de Obras Públicas es planificar ejecutar y administrar la construcción y mantenimiento de infraestructuras públicas, para mejorar las condiciones de vida de los habitantes y promover el desarrollo socio economico del municipio.</p>
        <a href="/SOP" class="btn border border-yellow-400 text-yellow-400 hover:bg-yellow-400 hover:text-black mt-auto px-4 py-2 rounded transition">Ver más »</a>
      </div>
    </div>

    <!-- Item 4 -->
    <div class="flex" data-aos="zoom-in" data-aos-duration="600">
      <div class="bg-black bg-opacity-80 text-white rounded-2xl shadow-lg transition-transform duration-300 hover:-translate-y-2 hover:shadow-2xl w-full flex flex-col items-center text-center p-6">
        <i class="fas fa-dollar-sign text-3xl text-yellow-400 mb-4"></i>
        <h4 class="text-xl font-bold mb-2" style="font-family: "Homer Simpson UI";">Finanzas</h4>
        <p class="text-gray-400 mb-4">La finalidad de la Secretaría de Finanzas es administrar los recursos económicos municipales mediante la planificación, ejecución y control del presupuesto, la recaudación de ingresos y la gestión del gasto público para garantizar la sostenibilidad financiera y el cumplimiento de los objetivos municipales.</p>
        <a href="/SF" class="btn border border-yellow-400 text-yellow-400 hover:bg-yellow-400 hover:text-black mt-auto px-4 py-2 rounded transition">Ver más »</a>
      </div>
    </div>

    <!-- Item 5 -->
    <div class="flex" data-aos="zoom-in" data-aos-duration="600">
      <div class="bg-black bg-opacity-80 text-white rounded-2xl shadow-lg transition-transform duration-300 hover:-translate-y-2 hover:shadow-2xl w-full flex flex-col items-center text-center p-6">
        <i class="fas fa-plane text-3xl text-yellow-400 mb-4"></i>
        <h4 class="text-xl font-bold mb-2" style="font-family: "Homer Simpson UI";">Turismo</h4>
        <p class="text-gray-400 mb-4">Turismo es implementar políticas que promuevan el desarrollo turístico del municipio de Challapata, aprovechando sus atractivos naturales y culturales para generar oportunidades económicas y mejorar la calidad de vida de los habitantes.</p>
        <a href="/turismo" class="btn border border-yellow-400 text-yellow-400 hover:bg-yellow-400 hover:text-black mt-auto px-4 py-2 rounded transition">Ver más »</a>
      </div>
    </div>

    <!-- Item 6 -->
    <div class="flex" data-aos="zoom-in" data-aos-duration="600">
      <div class="bg-black bg-opacity-80 text-white rounded-2xl shadow-lg transition-transform duration-300 hover:-translate-y-2 hover:shadow-2xl w-full flex flex-col items-center text-center p-6">
        <i class="fas fa-theater-masks text-3xl text-yellow-400 mb-4"></i>
        <h4 class="text-xl font-bold mb-2" style="font-family: "Homer Simpson UI";">Cultura</h4>
        <p class="text-gray-400 mb-4">La finalidad de Cultura es fomentar el desarrollo de las ciencias, letras y artes en servicio de la cultura nacional, preservando el patrimonio cultural local y promoviendo actividades artísticas y culturales que fortalezcan la identidad del municipio.</p>
        <a href="/cultura" class="btn border border-yellow-400 text-yellow-400 hover:bg-yellow-400 hover:text-black mt-auto px-4 py-2 rounded transition">Ver más »</a>
      </div>
    </div>
  </div>
</div>
</div>



<div class="w-full px-4 py-4 ">
  <div class="flex flex-wrap">
    <div class="w-full md:w-1/12"></div>

    <div class="w-full md:w-10/12">
      <h3 class="text-left text-xl text-white font-semibold">
        <span class="bg-[#DC191B] px-1">Noticias.</span>
      </h3>
      <hr class="border-t-2 border-[#DC191B] my-2">
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
                  <a href="#" class="news-title stroke-text" onclick="SeguirLeyendo(<?php echo $fil["id"]; ?>)"><?php echo $fil['titulo']; ?></a>
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

<div class="w-full text-center my-4">
  <button onclick="abriMasNoticias()" class="bg-[#DC191B] hover:bg-[#A30716] text-white px-6 py-3 shadow rounded-full transition duration-300">
    Ver más Noticias
  </button>
</div>
<div class="container mx-auto px-4">
  <div class="border border-red-700 w-full grid grid-cols-1 lg:grid-cols-2" data-aos="fade-right" data-aos-duration="1200">

    <!-- Columna izquierda (texto) -->
    <div class="bg-gray-900 text-white flex flex-col justify-center p-6">
      <h1 class="text-4xl font-bold typewriter text-[#DC191B] mb-4">Challapata</h1>
      <hr class="border-t border-white mb-4">
      <p class="text-justify text-gray-300 mb-6">
        Challapata, capital de la provincia Eduardo Abaroa en el Departamento de Oruro, Bolivia, es un municipio que encapsula la esencia de la cultura andina, la historia heroica y la autenticidad de un destino aún por descubrir. Fundado en 1896, este enclave de aproximadamente 29,000 habitantes, se erige como un símbolo de resistencia y legado, honrando la memoria de Eduardo Abaroa, prócer boliviano cuyo nombre identifica a la provincia.
      </p>
      <div class="text-center">
        <button type="button" class="bg-white text-black text-lg px-6 py-2 rounded shadow hover:bg-gray-200 transition">
          Ver más
        </button>
      </div>
    </div>

    <!-- Columna derecha (imagen) -->
    <div class="bg-cover bg-center h-64 lg:h-auto" style="background-image: url('imagenes/gamch/challapata-población.jpg');">
      <!-- imagen responsiva -->
    </div>

  </div>
</div>


<section class="container mx-auto px-4 py-8">
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">

    <!-- POBLACIÓN -->
    <div class="border border-red-700 p-6 transition-transform duration-300 hover:scale-105">
      <div class="bg-transparent">
        <div>
          <span class="counter text-red-600 text-4xl font-bold" data-target="35339">0</span>
        </div>
        <p class="text-black">POBLACIÓN</p>
      </div>
    </div>

    <!-- ALTITUD -->
    <div class="border border-red-700 p-6 transition-transform duration-300 hover:scale-105">
      <div class="bg-transparent">
        <div>
          <span class="counter text-orange-500 text-4xl font-bold" data-target="3738">0</span>
          <span class="unit text-[#DC191B]"> Msnm</span>
        </div>
        <p class="text-black">ALTITUD</p>
      </div>
    </div>

    <!-- SUPERFICIE -->
    <div class="border border-red-700 p-6 transition-transform duration-300 hover:scale-105">
      <div class="bg-transparent">
        <div>
          <span class="counter text-green-600 text-4xl font-bold" data-target="2815">0</span>
          <span class="unit text-[#DC191B]"> km²</span>
        </div>
        <p class="text-black">SUPERFICIE</p>
      </div>
    </div>

  </div>
</section>

<style media="screen">
.estrofa {
text-align: justify;
font-size: 1rem;
}

@media (max-width: 576px) {
.estrofa {
  font-size: 0.65rem;
}
}

</style>
<!-- Columna del pergamino -->
<!-- Contenedor del Pergamino con Scroll y ancho más delgado -->
<div class="bg-yellow-100 border-4 border-yellow-600 rounded-xl shadow-xl p-6 overflow-y-auto max-h-[500px] relative font-serif max-w-md mx-auto">
  <h2 class="text-2xl font-bold text-center mb-4 text-yellow-900">Himno a Challapata</h2>
  <div class="text-center text-sm text-gray-600 italic mb-6">
    Letra: Saturnino Barre &nbsp;&nbsp;&nbsp; Música: Enrique Pérez
  </div>

  <!-- Estrofa Izquierda -->
  <div class="mb-6 text-left text-gray-800 leading-relaxed">
    Somos hijos de Eduardo Abaroa<br>
    que desde el Topater nos llegó<br>
    bello ejemplo de hombría y coraje<br>
    al morir sin rendirse jamás.
  </div>

  <!-- Estrofa Derecha -->
  <div class="mb-6 text-right text-gray-800 leading-relaxed">
    En la inmensidad del altiplano<br>
    muy celoso guardamos su mensaje<br>
    trabajando ahínco por su gloria<br>
    por la patria, la pobreza y la unión.
  </div>

  <!-- Estrofa Izquierda -->
  <div class="mb-6 text-left text-gray-800 leading-relaxed">
    Con cerebro y corazón<br>
    centinelas son tus hijos<br>
    con el cóndor de nuestro escudo<br>
    vigilando el Mapocho y al ladrón.
  </div>

  <!-- Estrofa Derecha -->
  <div class="mb-6 text-right text-gray-800 leading-relaxed">
    Noble pueblo de Challapata<br>
    la vanguardia vengadora<br>
    de su sangre aún caliente<br>
    llama al mar a nuestro bello litoral.
  </div>
</div>
<br>
    <!-- Caja de Audio -->
    <div class="mt-10 text-center">
      <h3 class="text-xl text-white bg-gray-800 py-2 rounded-lg mb-6">Himno A Challapata</h3>
      <div class="flex justify-center">
        <div class="w-full max-w-sm bg-white rounded-lg shadow-lg p-4" data-aos="fade-up">
          <h5 class="text-lg font-semibold text-gray-600 mb-2">Himno a Challapata</h5>
          <p class="text-sm text-gray-500 mb-4">
            Himno a Challapata - BANDA F.F.E.E. 24 RANGER de Challapata
          </p>
          <audio controls class="w-full">
            <source src="imagenes/audios/himno%20a%20challapata.mp3" type="audio/mpeg">
            Tu navegador no soporta el elemento de audio.
          </audio>
        </div>
      </div>
    </div>

  </div>
</div>
<br>
<div class="max-w-5xl mx-auto px-4">
  <h3 class="mb-4 text-white text-center rounded-lg bg-gray-800 py-2">
    Melodías de Nuestra Tierra
  </h3>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Tarjeta de audio 1 -->
    <div class="bg-white shadow-md rounded-lg hover:shadow-lg transition-shadow" data-aos="fade-up">
      <div class="p-4">
        <h5 class="text-lg font-semibold mb-2">Mi Challapata Querida</h5>
        <p class="text-gray-600 mb-4">Kalchas - Mi Challapata Querida</p>
      </div>
      <div class="px-4 pb-4">
        <audio controls class="w-full">
          <source src="imagenes/audios/Kalchas%20-%20Mi%20Challapata%20querida.mp3" type="audio/mpeg" />
          Tu navegador no soporta el elemento de audio.
        </audio>
      </div>
    </div>

    <!-- Tarjeta de audio 2 -->
    <div class="bg-white shadow-md rounded-lg hover:shadow-lg transition-shadow" data-aos="fade-up">
      <div class="p-4">
        <h5 class="text-lg font-semibold mb-2">Mi Challapata Querida</h5>
        <p class="text-gray-600 mb-4">Kilapaya - Mi Challapata Querida</p>
      </div>
      <div class="px-4 pb-4">
        <audio controls class="w-full">
          <source src="imagenes/audios/Kilapaya%20-%20Mi%20Challapata%20querida.mp3" type="audio/mpeg" />
          Tu navegador no soporta el elemento de audio.
        </audio>
      </div>
    </div>
  </div>
</div>
<br>

    <script>
      function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return rect.top <= (window.innerHeight || document.documentElement.clientHeight);
      }

      function formatNumber(num) {
        return num.toLocaleString('es-ES'); // Usa punto como separador de miles
      }

      function animateCounter(counter) {
        const target = parseInt(counter.getAttribute('data-target'));
        const speed = 200;
        const increment = Math.ceil(target / speed);
        let current = 0;

        const updateCounter = () => {
          if (current < target) {
            current += increment;
            if (current > target) current = target;
            counter.innerText = formatNumber(current);
            setTimeout(updateCounter, 10);
          } else {
            counter.innerText = formatNumber(target);
          }
        };

        updateCounter();
      }

      let countersStarted = false;
      window.addEventListener('scroll', () => {
        const counters = document.querySelectorAll('.counter');
        if (!countersStarted && Array.from(counters).some(isInViewport)) {
          counters.forEach(animateCounter);
          countersStarted = true;
        }
      });

    function abriMasNoticias(){
      window.location.href = "/Noticia";
    }
    </script>

<?php
// Incluir el archivo footer.php desde la carpeta diseno
require_once('vista/esquema/footeruni.php');
?>
