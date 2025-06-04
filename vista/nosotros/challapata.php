<?php
// Incluir el archivo header.php desde la carpeta diseno
require_once('vista/esquema/header.php');
?>

<main class="container mx-auto my-10 px-4 bg-gray-100" style="font-family: 'Georgia', serif;">
  <header class="hero py-20 text-white text-center">
      <div class="bg-black bg-opacity-50 py-16"style="font-family: 'Georgia', serif;">
          <h1 class="text-5xl font-bold mb-4">Challapata</h1>
          <p class="text-xl">La Joya del Altiplano Boliviano</p>
      </div>
  </header>
    <!-- Geografía -->
    <section id="geografia" class="mb-12">
        <h2 class="section-title text-3xl font-bold text-amber-800 relative inline-flex items-center" style="font-family: 'Georgia', serif;">
            <span class="mr-3">|</span>Ubicación Geográfica</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
            <div>
                <p>Capital de la provincia Eduardo Avaroa en el departamento de Oruro, Bolivia. Se encuentra ubicada entre las coordenadas 18°38' y 19°15' de latitud sur; 67°05' y 67°39' de longitud este del Meridiano de Greenwich, a una altitud de 3,720 msnm.</p>
                <p>Limita al norte con la provincia Poopó, al sur con Sebastián Pagador, al este con Potosí y al oeste con el lago Poopó. Con una extensión de 3,014 km², es la primera sección municipal de la provincia.</p>
            </div>
            <div>
                <div class="mt-4">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28398.74324955076!2d-67.23341061032716!3d-18.73318269999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x93f5f1f5c4c4c4d5%3A0x5c2c0c0c0c0c0c0c!2sChallapata!5e0!3m2!1ses!2sbo!4v1717489523456!5m2!1ses!2sbo" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Historia -->
    <section id="historia" class="mb-12">
        <h2 class="section-title text-3xl font-bold text-amber-800 relative inline-flex items-center" style="font-family: 'Georgia', serif;">
            <span class="mr-3">|</span>Historia y Fundaciones</h2>
        <div class="space-y-6 p-8">
            <div>
                <h3 class="text-xl font-semibold">1560: Fundación Chimpa Cagually</h3>
                <p>Primer asentamiento bajo el nombre de Chimpa Cagually al pie del cerro Quiwiri, durante el periodo de los imperios aymaras-quechuas originarios de los Quillacas y Azanaque.</p>
            </div>
            <div>
                <h3 class="text-xl font-semibold">1700: Fundación Española</h3>
                <p>Los españoles construyeron la iglesia "San Juan Bautista de Challapata", cuya campana aún conserva la fecha de fundación. Esta iglesia fue ubicada en el lugar del cementerio de los Qaguallies.</p>
            </div>
            <div>
                <h3 class="text-xl font-semibold">1893: Fundación como Ciudad</h3>
                <p>Mediante Ley del 30 de Mayo promulgada el 23 de Agosto, se estableció la ciudad en su ubicación actual entre el pueblo antiguo y la estación ferroviaria inaugurada en 1890. Diseñada por el ingeniero Julio Pinkas con calles anchas y rectas.</p>
            </div>
            <div>
                <h3 class="text-xl font-semibold">1903: Creación de la Provincia</h3>
                <p>La provincia Eduardo Avaroa fue creada por ley el 16 de octubre de 1903 durante la presidencia de José Manuel Pando, en honor al héroe civil de Calama.</p>
            </div>
        </div>
    </section>

    <!-- Cultura -->
    <section id="cultura" class="mb-12">
        <h2 class="section-title text-3xl font-bold text-amber-800 relative inline-flex items-center" style="font-family: 'Georgia', serif;">
            <span class="mr-3">|</span>Cultura y Población</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
            <div>
                <h3 class="text-xl font-semibold mb-2">Diversidad Lingüística</h3>
                <ul class="list-disc pl-5 mb-4">
                    <li>92% habla castellano</li>
                    <li>71% habla quechua</li>
                    <li>23% habla aymara</li>
                    <li>10% de los Uru Muratos habla puquina</li>
                </ul>
                <p>El 50% de la población es trilingüe, resultado del intercambio cultural con otras regiones.</p>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-2">Organización Social</h3>
                <p>Los Ayllus mantienen una estructura comunitaria ancestral, mientras que la comunidad Vila Ñeque del grupo étnico Uru Muratos destaca por su vivienda cónica y tradiciones únicas.</p>

                <div class="mt-4">
                    <img src="/imagenes/challapata/urus.jpeg" alt="Comunidad Uru Muratos" class="w-[300px] mx-auto rounded-lg">
                </div>
            </div>

        </div>
    </section>

    <!-- Turismo -->
    <section id="turismo" class="mb-12">
      <h2 class="section-title text-3xl font-bold text-amber-800 relative inline-flex items-center" style="font-family: 'Georgia', serif;">
          <span class="mr-3">|</span>Turismo y Recursos</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-8">
            <div class="h-full">
                <div class="bg-white border-0 shadow-sm h-full">
                    <img src="/imagenes/challapata/ferrocaril.jpg" class="w-full h-48 object-cover rounded-t-lg" alt="Ferrocarril Histórico">
                    <div class="p-4">
                        <h5 class="text-amber-700 font-semibold">Ferrocarril Histórico</h5>
                        <p>La estación ferroviaria de Challapata fue crucial en el transporte de minerales durante el siglo XX, conectando Bolivia con Chile.</p>
                    </div>
                </div>
            </div>
            <div class="h-full">
                <div class="bg-white border-0 shadow-sm h-full">
                    <img src="/imagenes/challapata/poopo.png" class="w-full h-48 object-cover rounded-t-lg" alt="Lago Poopó">
                    <div class="p-4">
                        <h5 class="text-amber-700 font-semibold">Lago Poopó</h5>
                        <p>Ubicado al oeste de Challapata, este lago representa un importante recurso ecológico y cultural para la región.</p>
                    </div>
                </div>
            </div>
            <div class="h-full">
                <div class="bg-white border-0 shadow-sm h-full">
                    <img src="/imagenes/challapata/mina.jpeg" class="w-full h-48 object-cover rounded-t-lg" alt="Minería Artesanal">
                    <div class="p-4">
                        <h5 class="text-amber-700 font-semibold">Minería Tradicional</h5>
                        <p>A pesar de existir recursos minerales importantes, la población se ha opuesto a la minería industrial por riesgos ambientales [[6]].</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Clima y Ecología -->
    <section class="mb-12">

        <h2 class="section-title text-3xl font-bold text-amber-800 relative inline-flex items-center" style="font-family: 'Georgia', serif;">
            <span class="mr-3">|</span>Clima y Ecología</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
            <div>
                <p>El clima se caracteriza por ser seco y frígido con temperaturas promedio de 8°C, mínimas de -14°C y máximas de 23°C. La topografía presenta una planicie con ligera pendiente hacia el este hasta las laderas de la cordillera Azanaque [[4]].</p>
                <p>La fauna incluye especies emblemáticas del altiplano como el zorro, vicuña, vizcacha y varias aves, manteniendo un equilibrio ecológico importante.</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h3 class="font-bold mb-3">Datos Climáticos</h3>
                <table class="min-w-full table-auto text-sm">
                  <tr>
                      <th class="text-left p-2 border-b border-gray-300">Temperatura Promedio:</th>
                      <td class="p-2 border-b border-gray-300">8°C</td>
                  </tr>
                  <tr>
                      <th class="text-left p-2 border-b border-gray-300">Mínima:</th>
                      <td class="p-2 border-b border-gray-300">-14°C</td>
                  </tr>
                  <tr>
                      <th class="text-left p-2 border-b border-gray-300">Máxima:</th>
                      <td class="p-2 border-b border-gray-300">23°C</td>
                  </tr>
              </table>


            </div>
        </div>
    </section>


    <section class="mb-12">

        <h2 class="section-title text-3xl font-bold text-amber-800 relative inline-flex items-center" style="font-family: 'Georgia', serif;">
            <span class="mr-3">|</span>Economía y Recursos</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
            <div>
              <h3 class="text-xl font-semibold mb-2">Agropecuaria</h3>
              <p>Challapata es conocida como la capital agropecuaria y ganadera del departamento de Oruro. La actividad económica principal se basa en la crianza de ganado vacuno, camélidos y ovino, así como en la agricultura de subsistencia.</p>
            </div>
            <div>
              <h3 class="text-xl font-semibold mb-2">Minería</h3>
              <p>Se han encontrado recursos mineralógicos como cúpricos, auríferos y piedra caliza. La explotación de estos recursos ha sido limitada debido a la oposición de la población por riesgos ambientales [[6]].</p>
            </div>
        </div>
    </section>
</main>

<?php
// Incluir el archivo footer.php desde la carpeta diseno
require_once('vista/esquema/footeruni.php');
?>
