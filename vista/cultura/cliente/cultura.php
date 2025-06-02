<?php
require_once('vista/esquema/header.php');
?>
<style>
     /* Estilos para las imágenes en las tarjetas */
     .card-img-top {
         height: 200px;
         object-fit: cover;
     }
</style>

<!-- Barra de navegación -->
<h5 class="text-2xl font-semibold mb-4">CULTURA</h5>

<!-- Sección de Lugares Turísticos -->
<div class="container mx-auto bg-white rounded-lg shadow-lg p-4 my-5">
    <h4 class="text-center text-3xl font-bold mb-4" data-aos="fade-up">CULTURA</h4>

    <!-- Lugar 3 -->
    <?php
    $index = 0;
    if ($resul && mysqli_num_rows($resul) > 0) {
        echo '<div class="container mx-auto">';
        while ($fi = mysqli_fetch_array($resul)) {
            $reverseClass = ($index % 2 !== 0) ? 'md:flex-row-reverse' : '';

            // Animaciones alternas
            $imgAnimation = ($index % 2 === 0) ? 'fade-right' : 'fade-left';
            $textAnimation = ($index % 2 === 0) ? 'fade-left' : 'fade-right';

            echo '<div class="flex flex-col md:flex-row mb-5 items-center ' . $reverseClass . '" data-aos="' . $textAnimation . '">';

            // Columna de imagen
            echo '<div class="md:w-1/2 p-2 flex justify-center mb-3 md:mb-0" data-aos="' . $imgAnimation . '">';
            if (!empty($fi['imagen_url'])) {
                echo '<img src="' . htmlspecialchars($fi['imagen_url']) . '" alt="Imagen actividad" class="w-full h-72 object-cover rounded-lg shadow-md">';
            } else {
                echo '<div class="bg-gray-300 text-white p-5 text-center rounded-lg shadow-sm">Sin imagen</div>';
            }
            echo '</div>';

            // Columna de contenido
            echo '<div class="md:w-1/2 p-4 bg-gray-100 rounded-lg shadow-md">';
            echo '<h3 class="text-xl font-semibold text-gray-800 mb-3">' . htmlspecialchars(strtoupper($fi['nombre_actividad'])) . '</h3>';
            echo '<p><strong>Tipo:</strong> ' . htmlspecialchars($fi['tipo_actividad']) . '</p>';
            echo '<p class="text-sm text-gray-600 text-truncate-3"><strong>Descripción:</strong> ' . nl2br(htmlspecialchars($fi['descripcion'])) . '</p>';
            echo '<p><strong>Ubicación:</strong> ' . htmlspecialchars($fi['ubicacion']) . '</p>';
            echo '<p><strong>Fecha Actividad:</strong> ' . htmlspecialchars($fi['fecha_inicio']) .
                ($fi['fecha_fin'] ? ' - ' . htmlspecialchars($fi['fecha_fin']) : '') . '</p>';
            if (!empty($fi['contacto'])) {
                echo '<p><strong>Contacto:</strong> ' . htmlspecialchars($fi['contacto']) . '</p>';
            }

            echo "<button class='mt-4 px-6 py-2 bg-blue-600 text-white rounded-full shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300'
            data-bs-toggle='modal'
            data-bs-target='#infoModal'
            data-nombre='" . htmlspecialchars($fi["nombre_actividad"], ENT_QUOTES) . "'
            data-descripcion='" . htmlspecialchars($fi["descripcion"], ENT_QUOTES) . "'
            data-imagen='" . htmlspecialchars($fi["imagen_url"], ENT_QUOTES) . "'
            onclick='loadModalDataFromButton(this)'>
            Más información</button>";

            echo '</div>'; // Cierra col-md-6

            echo '</div>'; // Cierra .row
            $index++;
        }
        echo '</div>'; // Cierra container
    } else {
        echo '<p class="text-center text-lg text-gray-600 mt-5">No se encontraron actividades.</p>';
    }
    ?>
</div>

<!-- Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-white rounded-lg shadow-lg">
            <div class="modal-header bg-blue-600 text-white rounded-t-lg">
                <h5 class="modal-title text-xl font-semibold" id="modalLugar1Label">
                    <i class="fas fa-plane-departure me-2"></i><span id="modalLugar1Title">Playa Bonita</span>
                </h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-6 bg-gray-100 rounded-b-lg">
                <div class="row">
                    <div class="col-md-12">
                        <p id="modalDescripcion" class="mb-4 text-justify text-gray-800"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function loadModalDataFromButton(button) {
        const nombre = button.getAttribute('data-nombre');
        const descripcion = button.getAttribute('data-descripcion');
        const imagenUrl = button.getAttribute('data-imagen');

        document.getElementById("modalLugar1Title").textContent = nombre;
        document.getElementById("modalDescripcion").textContent = descripcion;
        document.getElementById("modalImagen").src = imagenUrl;
    }
</script>

<?php
// Incluir el archivo footer.php desde la carpeta diseno
require_once('vista/esquema/footeruni.php');
?>
