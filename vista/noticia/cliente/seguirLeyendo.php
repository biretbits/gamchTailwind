<?php require_once('vista/esquema/header.php'); ?>
<?php
// Asegúrate de que $resul contiene datos válidos antes de continuar
$fi = mysqli_fetch_array($resul);
?>
<div class="bg-white">

  <div class="container mx-auto px-4">
    <!-- Fila -->
    <div class="flex justify-center border-2 border-black py-10">
      <div class="w-full md:w-8/12">

        <!-- Tarjeta de la noticia -->
        <div class="space-y-6">

          <!-- Título de la noticia -->
          <h4 class="text-center mb-4 text-gray-900 font-semibold text-lg break-words px-4">
            <?= htmlspecialchars($fi['titulo']) ?>
          </h4>

          <!-- Imagen de la noticia -->
          <div class="text-center mb-4">
            <img
              src="<?= htmlspecialchars($fi['foto']) ?>"
              alt="noticia"
              class="mx-auto max-w-full h-auto object-cover rounded"
            />
          </div>

          <!-- Información de la noticia -->
          <ul class="flex space-x-4 uppercase text-left mb-4 text-xs font-medium text-gray-900">
            <li><a href="#" class="font-bold hover:underline">Publicado</a></li>
            <li><a href="#" class="font-bold hover:underline"><?= htmlspecialchars($fi['fecha']) ?></a></li>
          </ul>

          <!-- Contenedor cuadrado para el contenido -->
          <div class="border rounded p-4 mb-4 bg-gray-100">
            <p class="text-justify mb-4 text-gray-600 break-words whitespace-pre-wrap">
              <?= nl2br(htmlspecialchars($fi['contenido'])) ?>
            </p>
          </div>

          <!-- Cita opcional -->
          <div class="mt-10 mb-2 text-center text-gray-400 text-4xl opacity-50">
            <i class="fa fa-quote-left"></i>
          </div>
          <hr class="opacity-50">

          <!-- Botones de redes sociales (comentados) -->
          <!--
          <div class="mt-8 text-center space-x-4">
            <button type="button" class="btn btn-primary btn-rounded" data-href="#" data-layout="button">
              <i class="fa fa-facebook"></i> Facebook
            </button>
            <button type="button" class="btn btn-info btn-rounded">
              <i class="fa fa-twitter"></i> Twitter
            </button>
          </div>
          -->

        </div>
        <!-- Fin Tarjeta de la noticia -->

      </div>
    </div>
    <!-- Fin Fila -->
  </div>

</div>

<!-- Scripts si los necesitas -->
<div id="fb-root"></div>

<?php require_once('vista/esquema/footeruni.php'); ?>
