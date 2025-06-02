<?php
require_once('vista/esquema/header.php');
?>

<!-- Biografía Section -->
<div class="container mx-auto py-16">
  <!-- Fila superior -->
  <div class="flex flex-wrap gap-8 justify-center">
    <div class="w-full sm:w-1/3 mb-8">
      <div class="flex flex-col h-full bg-white rounded-lg shadow-xl p-6 hover:shadow-2xl transition-shadow duration-300">
        <h3 class="text-xl font-semibold text-center text-gray-800">Espacio en Cementerio</h3>
        <p class="text-center text-gray-600 mt-4">Espacio en el cementerio municipal.</p>
        <button class="bg-indigo-600 text-white px-6 py-2 rounded mt-6 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300"
          onclick="openModal({
            descripcion: 'El cementerio Municipal es un espacio físico designado y habilitado oficialmente para la inhumación (entierro), resguardo y recordación de los restos mortales de las personas fallecidas.',
            titulo: 'ESPACIO EN EL CEMENTERIO MUNICIPAL',
            requisitos: 'Compra de espacio en el cementerio. Nichos. Otros.',
            contacto: '',
            correo: '',
            horario: 'Lunes a Viernes, Mañana de 8:00 a 12:00 AM - Tarde 2:00 a 6:00 PM',
            imagen: 'imagenes/img-challapata/cementerio.jpeg'
          })">Más Información</button>
      </div>
    </div>

    <div class="w-full sm:w-1/3 mb-8">
      <div class="flex flex-col h-full bg-white rounded-lg shadow-xl p-6 hover:shadow-2xl transition-shadow duration-300">
        <h3 class="text-xl font-semibold text-center text-gray-800">Registro de Vehículos</h3>
        <p class="text-center text-gray-600 mt-4">Realiza trámites relacionados con el RUAT.</p>
        <button class="bg-indigo-600 text-white px-6 py-2 rounded mt-6 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300"
          onclick="openModal({
            descripcion: 'El RUAT es una Institución Pública Descentralizada, no lucrativa con personería jurídica, patrimonio propio y autonomía de gestión administrativa, financiera, legal y técnica.',
            titulo: 'REGISTRO DE VEHÍCULOS',
            requisitos: 'INSCRIPCIÓN VEHÍCULOS AUTOMOTORES. INSCRIPCIÓN VEHÍCULOS ELÉCTRICOS NACIONALES. INSCRIPCIÓN MOTOCICLETAS. TRANSFERENCIA VEHÍCULOS AUTOMOTORES.',
            contacto: '',
            correo: 'ruat@gmail.com',
            horario: 'Lunes a Viernes, Mañana de 8:00 a 12:00 AM - Tarde 2:00 a 6:00 PM',
            imagen: 'imagenes/img-challapata/RUAT.jpg'
          })">Más Información</button>
      </div>
    </div>

    <div class="w-full sm:w-1/3 mb-8">
      <div class="flex flex-col h-full bg-white rounded-lg shadow-xl p-6 hover:shadow-2xl transition-shadow duration-300">
        <h3 class="text-xl font-semibold text-center text-gray-800">Unidad de Tributaciones</h3>
        <p class="text-center text-gray-600 mt-4">Pago de impuestos.</p>
        <button class="bg-indigo-600 text-white px-6 py-2 rounded mt-6 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300"
          onclick="openModal({
            descripcion: 'Encargada de gestionar, controlar y recaudar los tributos municipales.',
            titulo: 'UNIDAD DE TRIBUTACIONES',
            requisitos: 'Impuesto a la Propiedad de Bienes Inmuebles.',
            contacto: '',
            correo: '',
            horario: 'Lunes a Viernes, Mañana de 8:00 a 12:00 AM - Tarde 2:00 a 6:00 PM',
            imagen: 'imagenes/img-challapata/RUAT.jpg'
          })">Más Información</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal (overlay encima del menú) -->
<div id="infoModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-75 hidden z-50">
  <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/3 p-6 max-h-screen overflow-auto relative">
    <button onclick="closeModal()" class="absolute top-4 right-4 text-white bg-gray-800 p-3 rounded-full hover:bg-gray-700 focus:outline-none focus:ring-2
    focus:ring-gray-500 transition duration-300 transform hover:scale-110">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-2 w-2 text-md" fill="none" viewBox="2 3 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
    </svg>
  </button>

    <h3 id="modalTitle" class="text-md font-semibold text-left mb-4 text-gray-800"></h3>
    <div class="text-center mb-4">
      <img id="modalImage" src="" alt="Imagen del evento" class="w-full h-72 object-cover rounded-lg shadow-md"/>
    </div>
    <p id="modalDescription" class="text-sm text-gray-600 mb-4"></p>
    <h6 class="font-semibold text-gray-800">Sub Servicios:</h6>
    <ul id="modalRequisitos" class="mb-4 list-disc pl-6">
      <li>Requisito 1</li>
      <li>Requisito 2</li>
    </ul>
    <p><strong>Contacto:</strong> <span id="modalContacto" class="text-gray-800">Celular: </span></p>
    <p><strong>Correo electrónico:</strong> <span id="modalCorreo" class="text-gray-800"></span></p>
    <p><strong>Horario de atención:</strong> <span id="modalHorario" class="text-gray-800"></span></p>
  </div>
</div>

<script type="text/javascript">
  function openModal(data) {
    // Llenar el modal con los datos proporcionados
    document.getElementById('modalTitle').textContent = data.titulo;
    document.getElementById('modalDescription').textContent = data.descripcion;
    document.getElementById('modalImage').src = data.imagen;

    // Llenar los requisitos
    let requisitosList = document.getElementById('modalRequisitos');
    requisitosList.innerHTML = ''; // Limpiar lista
    data.requisitos.split('.').forEach(requisito => {
      if (requisito.trim()) {
        let li = document.createElement('li');
        li.textContent = requisito.trim();
        requisitosList.appendChild(li);
      }
    });

    // Rellenar datos de contacto
    document.getElementById('modalContacto').textContent = `Celular: ${data.contacto}`;
    document.getElementById('modalCorreo').textContent = `Correo electrónico: ${data.correo}`;
    document.getElementById('modalHorario').textContent = data.horario;

    // Mostrar el modal
    document.getElementById('infoModal').classList.remove('hidden');
  }

  function closeModal() {
    // Ocultar el modal
    document.getElementById('infoModal').classList.add('hidden');
  }
</script>

<?php
require_once('vista/esquema/footeruni.php');
?>
