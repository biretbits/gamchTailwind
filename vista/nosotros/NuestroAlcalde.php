<?php
// Incluir el archivo header.php desde la carpeta diseno
require_once('vista/esquema/header.php');
?>

<!-- Biografía Section -->
<section class="bio-section text-center py-16 bg-grey-600">
  <div class="container mx-auto px-4">
    <h1 class="text-red-500 text-4xl mb-4">Biografía del Alcalde</h1>
    <div class="flex flex-col lg:flex-row justify-center items-center">
      <div class="lg:w-1/4 mb-8 lg:mb-0">
        <!-- Marco antiguo con la imagen ovalada -->
        <div class="p-4 border-4 border-[#cfa67d] bg-[#e9dbb2] rounded-xl shadow-lg inline-block">
          <img src="imagenes/gamch/alcalde.png" alt="Foto del Alcalde" class="w-72 h-72 object-cover rounded-full border-10 border-[#d8b1a0] shadow-lg bg-[#f4e1c1]">
        </div>
      </div>
      <div class="lg:w-2/3 lg:ml-8">
        <p class="text-black text-2xl leading-relaxed">Nuestro alcalde, Técnico Superior Marcos Choqueticlla Tito, nació en Challapata. Desde joven ha estado comprometido con el desarrollo de nuestro municipio, impulsando proyectos sociales, educativos y culturales.</p>
        <p class="text-black mt-4 text-xl">Ha ocupado diversos cargos en el ámbito público y, como alcalde, ha logrado [Mencionar logros importantes].</p>
      </div>
    </div>
  </div>
</section>


<!-- Logros Section -->
<section id="logros" class="bg-gray-100 py-10">
  <div class="container mx-auto text-center px-4">
    <h2 class="text-2xl mb-8">Logros del Alcalde</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
      <div class="card shadow-lg">
        <div class="card-body p-6 bg-white rounded-lg">
          <h5 class="text-xl font-semibold">Proyecto de Infraestructura</h5>
          <p class="mt-2">Se ha invertido en la mejora de infraestructuras públicas, incluyendo calles, parques y edificios municipales.</p>
        </div>
      </div>
      <div class="card shadow-lg">
        <div class="card-body p-6 bg-white rounded-lg">
          <h5 class="text-xl font-semibold">Educación</h5>
          <p class="mt-2">Se ha implementado un programa para mejorar la calidad educativa en las escuelas públicas del municipio.</p>
        </div>
      </div>
      <div class="card shadow-lg">
        <div class="card-body p-6 bg-white rounded-lg">
          <h5 class="text-xl font-semibold">Seguridad</h5>
          <p class="mt-2">Gracias a políticas de seguridad innovadoras, el municipio ha registrado una disminución significativa en los índices de criminalidad.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require("vista/esquema/footeruni.php"); ?>
