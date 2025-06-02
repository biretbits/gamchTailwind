
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
        <h1 class="text-4xl font-bold">Secretaría Municipal de Obras Públicas</h1>
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
      "Sub Alcaldía de Challapata",
      "Sub Alcaldía de Qaqachaca",
      "Sub Alcaldía de Norte Condo Abajo",
      "Sub Alcaldía de Norte Condo Nro. 3",
      "Sub Alcaldía de Culta",
      "Sub Alcaldía de Huancané",
      "Sub Alcaldía de Aguas Calientes",
      "Sub Alcaldía de Ancacato",
      "Sub Alcaldía de Tolapalca",
      "Dirección de Catastro"
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
    "9.jpeg", "2.jpeg", "4.jpeg", "6.jpeg", "3.jpeg", "5.jpeg", "8.jpeg", "7.jpeg"
];
      foreach ($imagenes as $index => $imagen) {
        echo "<div class='col-span-1'>
                <img src='imagenes/secretarias/obras/{$imagen}' alt='Imagen {$index}' class='w-full rounded-lg object-cover h-64 transform transition duration-300 hover:scale-105'>
              </div>";
      }
      ?>
    </div>
  </div>
</section>

<?php
require_once('vista/esquema/footeruni.php');
?>
