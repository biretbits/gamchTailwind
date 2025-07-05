<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>G.A.M. Challapata</title>
    <meta name="description" content="Portal oficial del municipio de Challapata. Información, servicios, noticias y más.">
    <meta name="keywords" content="Challapata, Oruro, Bolivia, gobierno, municipio">
    <meta name="author" content="Gobierno Autónomo Municipal de Challapata">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Open Graph para compartir en redes sociales -->
    <meta property="og:title" content="Challapata - Municipio Oficial">
    <meta property="og:description" content="Portal oficial del municipio de Challapata.">
    <meta property="og:image" content="http://challapata.gob.bo/LEYES-MUNICIPALES"> <!-- URL de tu logo -->
    <meta property="og:url" content="http://challapata.gob.bo/">
    <meta property="og:type" content="website">

    <!-- Favicon (ícono en pestaña del navegador) -->
    <link rel="icon" href="/imagenes/gamch/escudoo.ico" type="image/webp">


    <script src='/vista/esquema/browser@4.js'></script>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <!--<link rel="stylesheet" href="/vista/activos/bootstrap/bootstrap.min.css">-->

  <!-- Librerías CSS -->
  <link rel="stylesheet" href="/vista/activos/select2/css/select2.min.css">
  <link rel="stylesheet" href="/vista/activos/sweetAlert2/sweetalert2.min.css">
  <link rel="stylesheet" href="/vista/activos/pdfjs-5.2.133/build/pdf_viewer.css">
  <link rel="stylesheet" href="/vista/activos/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="/vista/activos/fonts/font-awesome.min.css">
  <link rel="stylesheet" href="/vista/activos/fonts/line-awesome.min.css">
  <link rel="stylesheet" href="/vista/activos/css/cssNoticia.css">
  <link rel="stylesheet" href="/vista/activos/css/Simple-Header-y-Navbar-adaptativo-nav.css">

  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="/vista/activos/css/styles.css">
  <!-- y demás hojas de estilo... -->

  <!-- jQuery -->

  <script src="/vista/activos/pdf-js/pdf.min.js"></script>
  <script src="/vista/activos/jquery-3.5.1.min.js"></script>

    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Al final del <body> -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <style>

        .mayu {
            text-transform: uppercase;
        }

        /* Estilos para eliminar flechas en inputs numéricos */
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

    </style>
    <!-- Modal Loader con Tailwind -->

</head>
<body class="bg-[#EDEDED]">
<!-- #ECEFFC <button type="button" id="openChatbot" class="bg-teal-600 text-white text-xl px-4 py-2 rounded-full shadow hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-400">
    💬
  </button>-->
  <div id="loaderModal" class="fixed inset-0 z-50 flex items-center justify-center bg-white">
    <div class="flex flex-col items-center">
      <!-- Bandera SVG -->
      <svg viewBox="0 0 600 400" class="w-24 h-16 border-l-4 border-gray-800 shadow" preserveAspectRatio="none">
        <defs>
          <linearGradient id="flagGradient" x1="0" x2="0" y1="0" y2="1">
            <stop offset="0%" stop-color="#d10000" />
            <stop offset="50%" stop-color="#d10000" />
            <stop offset="50%" stop-color="#0047ab" />
            <stop offset="100%" stop-color="#0047ab" />
          </linearGradient>
        </defs>
        <path id="flagPath" fill="url(#flagGradient)" />
      </svg>
      <p class="mt-2 text-sm text-gray-600 animate-pulse">Cargando...</p>
    </div>
  </div>

  <script>
    const path = document.getElementById("flagPath");
    let t = 0;

    function animateFlag() {
      const wave = (x, amp, freq) => Math.sin(x * freq + t) * amp;
      let top = "M0,0 ";
      for (let x = 0; x <= 600; x += 100) {
        const y = 20 + wave(x / 100, 20, 0.5);
        top += `Q${x + 50},${y} ${x + 100},0 `;
      }

      let bottom = "L600,400 ";
      for (let x = 600; x >= 0; x -= 100) {
        const y = 400 - wave(x / 100, 20, 0.5);
        bottom += `Q${x - 50},${y} ${x - 100},400 `;
      }

      path.setAttribute("d", top + bottom + "Z");
      t += 0.05;
      requestAnimationFrame(animateFlag);
    }

    animateFlag();

    // Ocultar loader cuando todo haya cargado

  </script>

<nav class="bg-white border-gray-200 dark:bg-black-900 dark:border-gray-700 sticky top-0 z-[25]">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-2">
    <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="imagenes/gamch/Logo%20Alcaldía_Mesa%20de%20trabajo%201%20copia.webp" class="h-12" alt="Flowbite Logo" >
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"></span>
    </a>

    <!-- Botón para abrir el menú en dispositivos móviles -->
    <button id="menu-btn" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-dropdown" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
      </svg>
    </button>

    <!-- Menú de navegación -->
    <div class="hidden w-full md:block md:w-auto text-[11px] " id="navbar-dropdown">
      <ul class="flex flex-col font-medium p-2 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-0 rtl:space-x-0 md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">

        <li class="relative group">
          <button class="submenu-btn w-full flex justify-between items-center px-4 py-2 rounded-md transition bg-gradient-to-r from-blue-50 to-white hover:from-blue-200 hover:to-blue-100 hover:text-blue-700 lg:inline-flex lg:items-center lg:space-x-1">
            <i class="fas fa-home"></i> <span>INICIO</span>
            <svg class="w-4 h-4 ml-2 lg:ml-1 lg:mt-0 mt-1 transform transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <ul class="submenu-content hidden lg:absolute lg:left-0 lg:mt-2 bg-white border border-gray-300 shadow-lg space-y-3 py-3 px-6 text-left z-50 rounded-lg min-w-[180px]">
            <li><a  class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition" href="/inicio">HOME</a></li>
            <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario'] != ''): ?>
            <li><a href="/salir" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition"><i class="fas fa-power-off"></i> Cerrar sesión</a></li>
            <?php else: ?>
            <li><a href="/iniciar" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition"><i class="fas fa-sign-in-alt"></i> Iniciar sesión</a></li>
            <?php endif; ?>
          </ul>
        </li>

        <li class="relative group">
          <button class="submenu-btn w-full flex justify-between items-center px-4 py-2 rounded-md transition bg-gradient-to-r from-blue-50 to-white hover:from-blue-200 hover:to-blue-100 hover:text-blue-700 lg:inline-flex lg:items-center lg:space-x-1">
            <i class="fas fa-users"></i> <span class="ml-2">NOSOTROS</span>
            <svg class="w-4 h-4 ml-2 lg:ml-1 lg:mt-0 mt-1 transform transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <ul class="submenu-content hidden lg:absolute lg:left-0 lg:mt-2 bg-white border border-gray-300 shadow-lg space-y-3 py-3 px-6 text-left z-50 rounded-lg min-w-[180px]">
            <li><a href="/MIVI" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">MISIÓN Y VISIÓN</a></li>
            <li><a href="/ORGANIGRAMA" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">ORGANIGRAMA</a></li>
            <li><a href="/SUBALCALDIA" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">SUB ALCALDIAS</a></li>
            <li><a href="/ALCALDE" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">ALCALDE MUNICIPAL</a></li>
            <li><a href="/CHALLAPATA" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">CHALLAPATA</a></li>
          </ul>
        </li>
        <li class="relative group">
          <a href="/Noticia" class="w-full flex justify-between items-center px-4 py-2 rounded-md transition bg-gradient-to-r from-blue-50 to-white hover:from-blue-200 hover:to-blue-100 hover:text-blue-700 lg:inline-flex lg:items-center lg:space-x-1">
            <i class="fa fa-newspaper-o"></i> <span class="ml-2">NOTICIAS</span>
            <svg class="w-4 h-4 ml-2 lg:ml-1 lg:mt-0 mt-1 transform transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            </svg>
          </a>
        </li>

        <li class="relative group">
          <a href="/Servicios" class="w-full flex justify-between items-center px-4 py-2 rounded-md transition bg-gradient-to-r from-blue-50 to-white hover:from-blue-200 hover:to-blue-100 hover:text-blue-700 lg:inline-flex lg:items-center lg:space-x-1">
            <i class="fas fa-briefcase"></i> <span class="ml-1">SERVICIOS</span>
            <svg class="w-4 h-4 ml-2 lg:ml-1 lg:mt-0 mt-1 transform transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            </svg>
          </a>
        </li>
        <li class="relative group">
          <button class="submenu-btn w-full flex justify-between items-center px-4 py-2 rounded-md transition bg-gradient-to-r from-blue-50 to-white hover:from-blue-200 hover:to-blue-100 hover:text-blue-700 lg:inline-flex lg:items-center lg:space-x-1">
            <i class="fa fa-file-alt"></i> <span class="ml-2">GACETA</span>
            <svg class="w-4 h-4 ml-2 lg:ml-1 lg:mt-0 mt-1 transform transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <ul class="submenu-content hidden lg:absolute lg:left-0 lg:mt-2 bg-white border border-gray-300 shadow-lg space-y-3 py-3 px-6 text-left z-50 rounded-lg min-w-[180px]">
            <li><a href="/LEYES-MUNICIPALES" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">LEYES MUNICIPALES</a></li>
            <li><a href="/RESOLUCIONES-MUNICIPALES" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">RESOLUCIONES MUNICIPALES</a></li>
            <li><a href="/RESOLUCIONES-MUNICIPALES-ADMINISTRATIVOS" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">RESOLUCIONES MUNICIPALES ADMINISTRATIVOS</a></li>
            <li><a href="/DECRETOS-EDILES" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">DECRETOS EDILES</a></li>
            <li><a href="/DECRETOS-MUNICIPALES" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">DECRETOS MUNICIPALES</a></li>
            <li><a href="/TRANSPARENCIA" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">TRANSPARENCIA</a></li>
            <li><a href="/AUDITORIA-INTERNA" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">AUDITORIA INTERNA</a></li>
            <li><a href="/INFORME-DE-GESTION" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">INFORME DE GESTIÓN</a></li>
            <li><a href="/DOCUMENTOS-IMPORTANTES" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">DOCUMENTOS IMPORTANTES</a></li>
          </ul>
        </li>

        <li class="relative group">
          <button class="submenu-btn w-full flex justify-between items-center px-4 py-2 rounded-md transition bg-gradient-to-r from-blue-50 to-white hover:from-blue-200 hover:to-blue-100 hover:text-blue-700 lg:inline-flex lg:items-center lg:space-x-1">
            <i class="fas fa-list-alt"></i> <span class="ml-2">NORMATIVA</span>
            <svg class="w-4 h-4 ml-2 lg:ml-1 lg:mt-0 mt-1 transform transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <ul class="submenu-content hidden lg:absolute lg:left-0 lg:mt-2 bg-white border border-gray-300 shadow-lg space-y-3 py-3 px-6 text-left z-50 rounded-lg min-w-[180px]">
            <li><a href="/REGLAMENTOS-ESPECIFICOS" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">REGLAMENTOS</a></li>
            <li><a href="/GESTION-DE-PERSONAL" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">GESTIÓN DE PERSONAL</a></li>
            <li><a href="/GESTION-TECNICA" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">GESTIÓN TÉCNICA</a></li>
            <li><a href="/GESTION-NORMATIVA" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">GESTIÓN NORMATIVA</a></li>
            <li><a href="/GESTION-ADMINISTRATIVA" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">GESTIÓN ADMINISTRATIVA</a></li>
            <li><a href="/MANUALES-ADMINISTRATIVOS" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">MANUALES ADMINISTRATIVOS</a></li>
            <li><a href="/MANUAL-DE-ORGANIZACION-FUNCIONES" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">MANUALES DE ORGANIZACIONES Y FUNCIONES</a></li>
          </ul>
        </li>
        <li class="relative group">
          <button class="submenu-btn w-full flex justify-between items-center px-4 py-2 rounded-md transition bg-gradient-to-r from-blue-50 to-white hover:from-blue-200 hover:to-blue-100 hover:text-blue-700 lg:inline-flex lg:items-center lg:space-x-1">
            <i class="fas fa-list-alt"></i> <span class="ml-2">GESTIÓN TRANSPARENTE</span>
            <svg class="w-4 h-4 ml-2 lg:ml-1 lg:mt-0 mt-1 transform transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <ul class="submenu-content hidden lg:absolute lg:left-0 lg:mt-2 bg-white border border-gray-300 shadow-lg space-y-3 py-3 px-6 text-left z-50 rounded-lg min-w-[180px]">
            <li><a href="/INFORMES-DE-GESTION" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">INFORMES DE GESTIÓN</a></li>
            <li><a href="/REPORTES-DE-EJECUCION" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">REPORTES DE EJECUCIÓN</a></li>
            <li><a href="/BOLETINES-DE-INFORMACION" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">BOLETINES DE INFORMACIÓN</a></li>
            <li><a href="/PLANES-ESTRATEGICOS" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">PLANES ESTRATEGICOS</a></li>
            <li><a href="/PRESUPUESTO-POA" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">PRESUPUESTO - POA</a></li>
            <li><a href="/UNIDAD-DE-AUDITORIA-INTERNA" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">UNIDAD DE AUDITORIA INTERNA</a></li>
          </ul>
        </li>

        <?php if (isset($_SESSION['id']) && $_SESSION['id'] != '' && isset($_SESSION['nombre_role']) && $_SESSION['nombre_role'] != ''): ?>
          <li class="relative group">
            <button class="submenu-btn w-full flex justify-between items-center px-4 py-2 rounded-md transition bg-gradient-to-r from-blue-50 to-white hover:from-blue-200 hover:to-blue-100 hover:text-blue-700 lg:inline-flex lg:items-center lg:space-x-1">
              <i class="fas fa-tachometer-alt"></i> <span class="ml-2">PANEL</span>
              <svg class="w-4 h-4 ml-2 lg:ml-1 lg:mt-0 mt-1 transform transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
              </svg>
            </button>
            <ul class="submenu-content hidden lg:absolute lg:left-0 lg:mt-2 bg-white border border-gray-300 shadow-lg space-y-3 py-3 px-6 text-left z-50 rounded-lg min-w-[180px]">
              <li><a href="/panel" class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">PANEL DE CONTROL</a></li>
              <li>
                <a href="javascript:void(0);"
                   id="openOffcanvasLink"
                   class="block px-3 py-1 rounded hover:bg-blue-100 hover:text-blue-700 transition">
                  MENU PANEL
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>


<!-- Script para manejar la visibilidad de los submenús -->
<script>
  // Manejo de submenú dinámico para cualquier submenú
  const submenuButtons = document.querySelectorAll('.submenu-btn');
  const submenus = document.querySelectorAll('.submenu-content');

  submenuButtons.forEach((btn, index) => {
    btn.addEventListener('click', () => {
      const submenu = submenus[index];
      const isHidden = submenu.classList.contains('hidden');

      // Cerrar todos los submenús
      submenus.forEach(sub => sub.classList.add('hidden'));
      // Solo abrir el submenú correspondiente
      submenu.classList.toggle('hidden', !isHidden);

      // Cambiar el estado aria-expanded
      btn.setAttribute('aria-expanded', isHidden);
      // Rotar el ícono del flecha
      btn.querySelector('svg').classList.toggle('rotate-180', isHidden);
    });
  });

  // Manejo de menú en dispositivos móviles
  const menuBtn = document.getElementById('menu-btn');
  const navbarDropdown = document.getElementById('navbar-dropdown');

  menuBtn.addEventListener('click', () => {
    const isExpanded = navbarDropdown.classList.contains('hidden');
    navbarDropdown.classList.toggle('hidden', !isExpanded);
    menuBtn.setAttribute('aria-expanded', isExpanded);
  });
</script>

<!-- Tailwind requiere que agregues esta animación en tu archivo de configuración -->
<style>
  @keyframes scroll-left {
    0% {
      transform: translateX(0%);
    }
    100% {
      transform: translateX(-50%);
    }
  }

  .animate-scroll-left {
    animation: scroll-left 70s linear infinite;
  }
</style>

<div class="w-full overflow-hidden bg-transparent fixed top-[66px] left-0 z-[1]">
  <!-- Fila superior con flexbox -->
  <div class="flex items-center bg-[#383838]">
    <!-- Banner Rojo Estático -->
    <div class="bg-red-600 text-white text-[15px] font-bold mr-[10px] px-2 py-[3px]">
      Noticias:
    </div>

    <?php
    $titulos = $_SESSION['TITULOS'];
    ?>

    <!-- Marquesina -->
    <div class="overflow-hidden whitespace-nowrap bg-black relative w-full">
      <div class="inline-block whitespace-nowrap animate-scroll-left">
        <?php
        for ($j = 0; $j < 10; $j++){
        for ($i = 0; $i < count($titulos); $i++) {
          $titulo = $titulos[$i]; ?>
          <span class="text-red-600 text-[16px] mx-[10px]">●</span>
          <span class="text-white text-[13px] font-bold mr-[110px]"><?php echo htmlspecialchars($titulo["titulo"]); ?></span>
        <?php } ?>
        <?php } ?>
      </div>
    </div>
  </div>
</div>

    <div style="margin-top: 20px;"> <!-- Ajusta este valor para que esté justo debajo del otro div -->
      <!-- Tu contenido aquí -->
    </div>
    <!-- Menú lateral de administración con Tailwind -->
    <!-- Contenido principal -->

    <!-- Scripts para menú -->
    <script>
    function SeguirLeyendo(id){
          var form = document.createElement('form');
           form.method = 'post';
           form.action = '/seguirLey'; // Coloca la URL de destino correcta
           // Agregar campos ocultos para cada dato
           var datos = {
               id: id
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


      AOS.init();
    </script>


    <!--
  <div id="loader">
    <div class="spinner">
      <i class="fas fa-spinner fa-spin"></i>
    </div>
    <div style="
      font-size: 10px;
      background: linear-gradient(to right, red 50%, blue 50%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-weight: bold;
      ">
      CHALLAPATA
    </div>

  </div>
  <script>
      window.onload = function() {
        // Mostrar el loader al inicio
        const loader = document.getElementById('loader');
        loader.style.display = 'flex'; // Mostrar el loader

        // Ocultar el loader después de 2 segundos (para simular carga)
        setTimeout(function() {
          loader.style.display = 'none';
        }, 500); // Puedes cambiar el tiempo según el tiempo que desees mostrar el "Cargando"
      };
    </script>-->

      <div class="content">
        <div class="main-content">
          <div id="offcanvasWithBackdrop" class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out" aria-labelledby="offcanvasWithBackdropLabel">
            <div class="flex items-center justify-between p-4 border-b">
              <h5 class="text-lg font-semibold" id="offcanvasWithBackdropLabel">MENÚ PANEL DE CONTROL</h5>
              <button type="button" class="text-gray-500 hover:text-black" onclick="document.getElementById('offcanvasWithBackdrop').classList.add('-translate-x-full')">
                ✕
              </button>
            </div>
            <div class="p-4">
              <div class="flex flex-col space-y-2">
                  <?php if(isset($_SESSION['nombre_role']) && $_SESSION['nombre_role'] == 'Admin'){ ?>
                    <div data-role="admin,developer">
                      <a class="flex items-center text-gray-700 hover:text-blue-600" href="/empleado"><i class="fas fa-users-cog mr-3"></i> Gestión de empleados</a>
                    </div>
                  <?php } ?>

                  <?php if(isset($_SESSION['nombre_role']) && in_array($_SESSION['nombre_role'], ['Admin', 'Developer'])) { ?>
                    <div data-role="admin,developer">
                      <a class="flex items-center text-gray-700 hover:text-blue-600" href="/usuarios"><i class="fas fa-users-cog mr-3"></i> Gestión de Usuarios</a>
                    </div>
                  <?php } ?>

                  <?php if(isset($_SESSION['nombre_role']) && in_array($_SESSION['nombre_role'], ['Admin', 'Developer'])) { ?>
                    <div data-role="admin,developer">
                      <a class="flex items-center text-gray-700 hover:text-blue-600" href="/rolU"><i class="fas fa-users-cog mr-3"></i> Gestión de Role Usuarios</a>
                    </div>
                  <?php } ?>

                  <?php if(isset($_SESSION['nombre_role']) && in_array($_SESSION['nombre_role'], ['Admin', 'Developer'])) { ?>
                    <div data-role="admin,developer">
                      <a class="flex items-center text-gray-700 hover:text-blue-600" href="/rol"><i class="fas fa-file-alt mr-3"></i> Gestión de Roles</a>
                    </div>
                  <?php } ?>

                  <?php if(isset($_SESSION['nombre_role']) && in_array($_SESSION['nombre_role'], ['Employee', 'Admin', 'Developer','Documentos'])) { ?>
                    <div data-role="employee,admin,developer">
                      <a class="flex items-center text-gray-700 hover:text-blue-600" href="/Doc"><i class="fas fa-plus-circle mr-3"></i> Gestión Documentos</a>
                    </div>
                  <?php } ?>

                  <?php if(isset($_SESSION['nombre_role']) && in_array($_SESSION['nombre_role'], ['Employee', 'Admin', 'Developer','Documentos'])) { ?>
                    <div data-role="employee,admin,developer">
                      <a class="flex items-center text-gray-700 hover:text-blue-600" href="/Normas"><i class="fas fa-plus-circle mr-3"></i> Gestión de Normativas</a>
                    </div>
                  <?php } ?>

                  <?php if(isset($_SESSION['nombre_role']) && in_array($_SESSION['nombre_role'], ['Employee', 'Admin', 'Developer','Documentos'])) { ?>
                    <div data-role="employee,admin,developer">
                      <a class="flex items-center text-gray-700 hover:text-blue-600" href="/Transparente"><i class="fas fa-plus-circle mr-3"></i> Gestión de Transparencia</a>
                    </div>
                  <?php } ?>

                  <?php if(isset($_SESSION['nombre_role']) && in_array($_SESSION['nombre_role'], ['Employee', 'Admin', 'Developer'])) { ?>
                    <div data-role="employee,admin,developer">
                      <a class="flex items-center text-gray-700 hover:text-blue-600" href="/RegNot"><i class="fas fa-plus-circle mr-3"></i> Gestión Noticias</a>
                    </div>
                  <?php } ?>

                  <?php if(isset($_SESSION['nombre_role']) && in_array($_SESSION['nombre_role'], ['Admin', 'Developer'])) { ?>
                    <div data-role="admin,developer">
                      <a class="flex items-center text-gray-700 hover:text-blue-600" href="/gTurismo"><i class="fas fa-plane mr-3"></i> Gestión de Turismo</a>
                    </div>
                  <?php } ?>

                  <?php if(isset($_SESSION['nombre_role']) && in_array($_SESSION['nombre_role'], ['Admin', 'Developer'])) { ?>
                    <div data-role="admin,developer">
                      <a class="flex items-center text-gray-700 hover:text-blue-600" href="/gCultura"><i class="fas fa-theater-masks mr-3"></i> Gestión de Cultura</a>
                    </div>
                  <?php } ?>

                  <?php if(isset($_SESSION['nombre_role']) && in_array($_SESSION['nombre_role'], ['Admin', 'Developer'])){ ?>
                    <div data-role="developer">
                      <a class="flex items-center text-gray-700 hover:text-blue-600" href="#reportes"><i class="fas fa-chart-pie mr-3"></i> Reportes</a>
                    </div>
                  <?php } ?>

                  <?php if(isset($_SESSION['nombre_role']) && in_array($_SESSION['nombre_role'], ['Admin', 'Developer'])){ ?>
                    <div data-role="developer">
                      <a class="flex items-center text-gray-700 hover:text-blue-600" href="/baseDeDatos"><i class="fas fa-chart-pie mr-3"></i> Gestión de Base de Datos</a>
                    </div>
                  <?php } ?>

              </div>
            </div>
          </div>
