
<?php
require_once('vista/esquema/header.php');
?>

<!-- Sección principal con icono a la izquierda -->
<header class="hero bg-gradient-to-t from-black via-black to-transparent bg-cover text-white py-24 text-center">
  <div class="container mx-auto">
    <div class="flex justify-center items-center">
      <div class="mr-3">
        <!-- Icono de la secretaría -->
        <img src="imagenes/secretarias/sdhs.png" alt="Icono Secretaría" width="100" height="100" class="mr-3">
      </div>
      <div class="text-left">
        <h1 class="text-4xl font-bold">Secretaría Municipal de Desarrollo Humano Y Social</h1>
        <p class="text-lg"></p>
      </div>
    </div>
  </div>
</header>

<!-- Sección de Unidades -->
<!-- ======= UNIDADES DE LA SECRETARÍA ======= -->
<section class="container mx-auto py-12">
  <h2 class="text-center text-3xl mb-8 text-white">Unidades de la Secretaría</h2>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <?php
    $unidades = [
      "Fortalecimiento al desarrollo productivo agropecuario",
      "Inseminación artificial",
      "Apoyo funcionamiento zoonosis",
      "Previsiones para contrapartes de Proy. Productivos con Inst. Públicas y Privadas",
      "Const. Sistema de Micro Riego a Canal Abierto – Challapata",
      "Equipamiento de Maquinaria Pesada G.A.M. Challapata",
      "Implementación y mantenimiento de áreas verdes",
      "Apoyo al medio ambiente – Municipio de Challapata",
      "Proyecto forestación en micro-cuenca – Challapata",
      "Forestación en áreas estratégicas – Challapata",
      "Funcionamiento de aseo urbano",
      "Apoyo al funcionamiento y regulación de mercados",
      "Servicio de inhumación – Cementerio",
      "Fortalecimiento a la Unidad de UGR",
      "Previsión de recursos para Gestión de Riesgo – Ley 602",
      "Centro Municipal de Servicio de Maquinaria Agrícola – DS 2785",
      "Producción de camélidos en 5 distritos indígenas – FDI",
      "Mejoramiento de la producción de ganado bovino"
  ];

    foreach ($unidades as $index => $unidad) {
      echo "<div class='col-span-1'>
              <div class='bg-white bg-opacity-10 border border-white border-opacity-20 rounded-lg p-4 transform transition duration-300 hover:scale-105'>
                <h5 class='text-lg font-medium text-white'>{$unidad}</h5>
              </div>
            </div>";
    }
    ?>
  </div>
</section>

<!-- Galería de Imágenes -->
<section class="bg-light py-12">
  <div class="container mx-auto">
    <h2 class="text-center text-3xl mb-8">Galería</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php
      $imagenes = [
    "1.jpg", "2.jpg", "4.jpeg", "6.jpg", "3.jpg", "5.jpg", "8.jpeg", "7.jpeg"
];
      foreach ($imagenes as $index => $imagen) {
        echo "<div class='col-span-1'>
                <img src='imagenes/secretarias/productivo/{$imagen}' alt='Imagen {$index}' class='w-full rounded-lg object-cover h-64 transform transition duration-300 hover:scale-105'>
              </div>";
      }
      ?>
    </div>
  </div>
</section>

<?php
require_once('vista/esquema/footeruni.php');
?>
