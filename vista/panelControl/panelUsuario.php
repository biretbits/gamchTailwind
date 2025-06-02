<?php
require_once('vista/esquema/header.php');
?>

<!-- Navbar -->
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

<!-- Contenido principal -->
<div class="container mx-auto px-4 py-8" id="dashboardContent">
  <div class="bg-transparent">
    <h1 class="text-white text-4xl font-semibold text-center mb-4">¡Bienvenido al Panel de Control!</h1>
    <p class="text-white text-center text-lg">Seleccione una opción del menú para comenzar</p>
  </div>
</div>

<?php
require_once('vista/esquema/footeruni.php');
?>
<!-- Botón para abrir menú lateral -->
