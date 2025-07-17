<?php
require_once('vista/esquema/header.php');
?>

<h5 class="text-2xl font-semibold mb-4">CULTURA</h5>

<div class="container mx-auto bg-white rounded-lg shadow-lg p-4 my-5">
  <h5 class="text-center text-3xl font-bold mb-4">CULTURA</h5>
  <?php
  $index = 0;
  $activities = [];
  if ($resul && mysqli_num_rows($resul) > 0) {
      while ($fi = mysqli_fetch_array($resul)) {
          $activity = [
              'nombre_actividad' => $fi['nombre_actividad'],
              'descripcion' => $fi['descripcion'],
              'imagen_url' => $fi['imagen_url'],
              'tipo_actividad' => $fi['tipo_actividad'],
              'ubicacion' => $fi['ubicacion'],
              'fecha_inicio' => $fi['fecha_inicio'],
              'fecha_fin' => $fi['fecha_fin'],
              'contacto' => $fi['contacto'],
              'enlace_web' => $fi['enlace_web']
          ];
          $activities[] = $activity;
      }
      echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">';
      foreach ($activities as $fi) {
          echo '<div class="card max-w-sm bg-white rounded-lg border-2 border-gray-200 shadow-md overflow-hidden transform transition duration-300  hover:shadow-lg hover:border-blue-500">';
          // Imagen
          echo '<div class="relative transition duration-300 transform hover:scale-105">';
          if (!empty($fi['imagen_url'])) {
              echo '<img src="' . htmlspecialchars($fi['imagen_url']) . '" alt="Imagen actividad" class="w-full h-48 object-cover rounded-t-lg transform transition duration-300 hover:scale-110">';
          } else {
              echo '<div class="bg-gray-300 text-white p-5 text-center rounded-t-lg">Sin imagen</div>';
          }
          echo '</div>';

          // Contenido de la tarjeta
          echo '<div class="p-6 space-y-4">';
          echo '<h3 class="text-xl font-semibold text-gray-800 hover:text-blue-500 transition duration-300 transform hover:scale-105">' . htmlspecialchars(strtoupper($fi['nombre_actividad'])) . '</h3>';
          echo '<p class="text-sm text-gray-500"><strong><i class="fas fa-tag"></i> Tipo:</strong> ' . htmlspecialchars($fi['tipo_actividad']) . '</p>';
          echo '<p class="text-sm text-gray-600 truncate"><strong><i class="fas fa-pencil-alt"></i> Descripción:</strong> ' . nl2br(htmlspecialchars($fi['descripcion'])) . '</p>';
          echo '<p class="text-sm text-gray-500"><strong><i class="fas fa-map-marker-alt"></i> Ubicación:</strong> ' . htmlspecialchars($fi['ubicacion']) . '</p>';
          echo '<p class="text-sm text-gray-500"><strong><i class="fas fa-calendar-day"></i> Fecha Actividad:</strong> ' . htmlspecialchars($fi['fecha_inicio']) . ($fi['fecha_fin'] ? ' - ' . htmlspecialchars($fi['fecha_fin']) : '') . '</p>';

          // Botón de más información
          echo "<button class=' hover:bg-blue-700 bg-blue-500 text-white rounded-md py-2 px-4 shadow-md hover:shadow-lg transition duration-300 w-full' onclick='openModal(" . htmlspecialchars(json_encode($fi)) . ")'>
                  Más información</button>";
          echo '</div>';
          echo '</div>';
      }
      echo '</div>';
  } else {
      echo '<p class="text-center mt-5 text-lg">No se encontraron actividades.</p>';
  }
  ?>

</div>

<!-- Modal -->
<div id="infoModal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-50 hidden">
  <div class="flex items-center justify-center min-h-screen p-4 text-center">
    <div class="relative w-full max-w-2xl bg-white rounded-lg shadow-lg">
      <!-- Modal Header -->
      <div class="flex justify-between items-center p-4 border-b bg-blue-600 text-white">
        <h6 id="modalLugar1Title" class="font-semibold">Título del lugar</h6>
        <button type="button" class="text-white hover:text-gray-700" onclick="closeModal()">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="p-4 space-y-4">
        <img id="modalImagen" class="w-full rounded-lg" src="" alt="Imagen del lugar">
        <div class="text-sm text-gray-700">
          <p id="modalDescripcion"></p>
          <p><strong><i class="fas fa-tag"></i> Tipo de Actividad:</strong> <span id="modalTipo"></span></p>
          <p><strong><i class="fas fa-map-marker-alt"></i> Ubicación:</strong> <span id="modalUbicacion"></span></p>
          <p><strong><i class="fas fa-calendar-day"></i> Fecha de Inicio:</strong> <span id="modalFechaInicio"></span></p>
          <p><strong><i class="fas fa-calendar-times"></i> Fecha de Fin:</strong> <span id="modalFechaFin"></span></p>
          <p><strong><i class="fas fa-phone-alt"></i> Contacto:</strong> <span id="modalContacto"></span></p>
          <p><strong><i class="fas fa-link"></i> Enlace Web:</strong> <a id="modalEnlaceWeb" href="" target="_blank" class="text-blue-500">Ir al enlace</a></p>
        </div>
      </div>

      <!-- Modal Footer -->
      <div class="flex justify-end space-x-2 p-4 border-t">
        <button type="button" class="bg-red-500 text-white rounded-md py-2 px-4 hover:bg-red-600" onclick="closeModal()">
          <i class="fas fa-times"></i> Cerrar
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  // Función para abrir el modal
  function openModal(data) {
    // Setear el contenido del modal con el objeto JSON pasado desde PHP
    document.getElementById("modalLugar1Title").textContent = data.nombre_actividad;
    document.getElementById("modalDescripcion").textContent = data.descripcion;
    document.getElementById("modalImagen").src = data.imagen_url || '';
    document.getElementById("modalTipo").textContent = data.tipo_actividad;
    document.getElementById("modalFechaInicio").textContent = data.fecha_inicio;
    document.getElementById("modalFechaFin").textContent = data.fecha_fin || 'N/A';
    document.getElementById("modalUbicacion").textContent = data.ubicacion;
    document.getElementById("modalContacto").textContent = data.contacto || 'N/A';
    document.getElementById("modalEnlaceWeb").href = data.enlace_web || '#';

    // Mostrar el modal
    document.getElementById("infoModal").classList.remove('hidden');
  }

  // Función para cerrar el modal
  function closeModal() {
    document.getElementById("infoModal").classList.add('hidden');
  }
</script>

<?php
require_once('vista/esquema/footeruni.php');
?>
