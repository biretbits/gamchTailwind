
<?php
require_once('vista/esquema/header.php');
?>

<!-- Sección principal con icono a la izquierda -->
<header class="hero bg-gradient-to-t from-black via-black to-transparent bg-cover text-white py-24 text-center">
  <div class="container mx-auto">
    <div class="flex justify-center items-center">
      <div class="mr-3">
        <!-- Icono de la secretaría -->
        <img src="imagenes/secretarias/op.png" alt="Icono Secretaría" width="100" height="100" class="mr-3">
      </div>
      <div class="text-left">
        <h1 class="text-4xl font-bold">Secretaría Municipal Administrativa y Financiera</h1>
        <p class="text-lg"></p>
      </div>
    </div>
  </div>
</header>

<!-- Sección de Unidades -->
<!-- ======= UNIDADES DE LA SECRETARÍA ======= -->
<section class="container mx-auto py-12">
  <h2 class="text-center text-3xl mb-8 text-[#DC191B]">Unidades de la Secretaría</h2>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <?php
    $unidades = [
      "Responsable de Contrataciones",
      "Contador tesorero",
      "Responsable de Presupuestos",
  ];

    foreach ($unidades as $index => $unidad) {
      echo "<div class='col-span-1'>
              <div class='bg-opacity-10 border border-black border-opacity-20 rounded-lg p-4 transform transition duration-300 hover:scale-105'>
                <h5 class='text-lg font-medium text-black'>{$unidad}</h5>
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
    "1.png", "2.png", "3.png", "6.jpeg", "3.jpeg", "5.jpeg", "8.jpeg", "7.jpeg"
];
      foreach ($imagenes as $index => $imagen) {
        echo "<div class='col-span-1'>
                <img src='imagenes/secretarias/finanzas/{$imagen}' alt='Imagen {$index}' class='w-full rounded-lg object-cover h-64 transform transition duration-300 hover:scale-105'>
              </div>";
      }
      ?>
    </div>
  </div>
</section>

<?php
require_once('vista/esquema/footeruni.php');
?>
