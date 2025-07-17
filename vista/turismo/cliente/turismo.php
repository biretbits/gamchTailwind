<?php
require_once('vista/esquema/header.php');
?>
<div class="container mx-auto my-8 px-4">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Lugares Turísticos</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

            <!-- Lugar 3 -->
            <?php
            if ($resul && mysqli_num_rows($resul) > 0) {
                while($fi = mysqli_fetch_array($resul)) {
                    echo "<div class='group relative bg-gray-200 rounded-lg overflow-hidden shadow-lg transition duration-300 hover:shadow-xl hover:scale-105'>";
                    echo "<img src='".$fi["imagen_url"]."' class='w-full h-64 object-cover' alt='Lugar 3'>";

                    echo "<div class='p-4 bg-white'>
                        <h5 class='text-xl font-semibold text-gray-800 group-hover:text-blue-600 transition duration-300'>".strtoupper($fi["nombre_destino"])."</h5>
                        <p class='text-sm text-gray-500 mt-2 overflow-hidden text-ellipsis whitespace-nowrap overflow-hidden -webkit-box -webkit-line-clamp-2'>
                            ".$fi["descripcion"]."
                        </p>

                        <button type='button' class='hover:bg-blue-700 bg-blue-500 text-white rounded-md py-2 px-4 shadow-md hover:shadow-lg transition duration-300 w-full' onclick='loadModalData(".json_encode([
                            "id" => $fi["id"],
                            "nombre_destino" => strtoupper($fi["nombre_destino"]),
                            "descripcion" => $fi["descripcion"],
                            "tipo_destino" => $fi["tipo_destino"],
                            "actividades_disponibles" => $fi["actividades_disponibles"],
                            "ubicacion" => $fi["ubicacion"],
                            "contacto" => $fi["contacto"],
                            "enlace_web" => $fi["enlace_web"],
                            "imagen_url" => $fi["imagen_url"]
                        ]).")'>
                            Más Información
                        </button>
                    </div>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modalLugar1" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-50 hidden">
  <div class="flex items-center justify-center min-h-screen p-4 text-center">
    <div class="relative w-full max-w-2xl bg-white rounded-lg shadow-lg">
        <!-- Header del Modal -->
        <div class="flex justify-between items-center p-4 border-b bg-blue-600 text-white">
            <i class="fas fa-plane-departure me-2"></i> <span id="modalLugar1Title">Playa Bonita</span>
            <button type="button" class="text-white hover:text-gray-700" onclick="closeModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <!-- Cuerpo del Modal -->
        <div class="modal-body bg-gray-50 p-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Imagen -->
                <div>
                    <img id="modalImagen" src="https://via.placeholder.com/500x300" class="w-full h-64 object-cover rounded-lg shadow-md" alt="Imagen del destino">
                </div>
                <!-- Información del destino -->
                <div>
                    <p id="modalDescripcion" class="text-md text-gray-800 mb-4 text-justify font-medium"></p>
                    <ul class="space-y-4 text-gray-700">
                        <li class="flex items-center"><i class="fas fa-map-marker-alt me-3 text-blue-600"></i><strong>Ubicación:</strong> <span id="modalUbicacion"></span></li>
                        <li class="flex items-center"><i class="fas fa-water me-3 text-blue-600"></i><strong>Actividades:</strong> <span id="modalActividades"></span></li>
                        <li class="flex items-center"><i class="fas fa-map-pin me-3 text-blue-600"></i><strong>Tipo Destino:</strong> <span id="tipo_destino"></span></li>
                        <li class="flex items-center"><i class="fas fa-phone me-3 text-blue-600"></i><strong>Contacto:</strong> <span id="modalContacto"></span></li>
                        <li class="flex items-center"><i class="fas fa-link me-3 text-blue-600"></i><strong>Enlace web:</strong> <a href="" id="modalEnlaceWeb" class="text-blue-600 hover:underline" target="_blank">Visitar</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Footer del Modal -->
        <div class="modal-footer border-t-2 border-gray-300 py-4 px-6 bg-gray-50 rounded-b-lg">
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Cerrar</button>
        </div>
    </div>
  </div>
</div>

<script>
// Función para cargar los datos del modal
function loadModalData(data) {
    // Llenar el modal de Tailwind con los datos
    document.getElementById('modalImagen').src = data.imagen_url;
    document.getElementById('modalLugar1Title').innerText = data.nombre_destino;
    document.getElementById('modalDescripcion').innerText = data.descripcion;
    document.getElementById('modalUbicacion').innerText = data.ubicacion;
    document.getElementById('modalActividades').innerText = data.actividades_disponibles;
    document.getElementById('tipo_destino').innerText = data.tipo_destino;
    document.getElementById('modalContacto').innerText = data.contacto;
    var enlace = document.getElementById("modalEnlaceWeb");
    enlace.href = data.enlace_web;

    // Mostrar el modal
    document.getElementById('modalLugar1').classList.remove('hidden');
}

// Función para cerrar el modal
function closeModal() {
    document.getElementById('modalLugar1').classList.add('hidden');
}
</script>

<?php
require_once('vista/esquema/footeruni.php');
?>
