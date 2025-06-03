<?php require("vista/esquema/header.php"); ?>
<input type="hidden" name="categoria" id='categoria' value="<?php echo $categoria; ?>"><!--campo donde se guarda la categoria de documentos a buscarse con ajax-->

<div class="container mx-auto p-5 bg-white">
    <!-- Grid: una fila con dos columnas -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- Columna Izquierda: Lista de PDFs -->
        <div class="col-span-12 lg:col-span-9">
            <div class="bg-green-500 text-white p-3 rounded">
                <div class="flex items-end gap-3 w-full">

                    <!-- Texto o categoría -->
                    <div class="flex-grow font-bold text-sm">
                        <?php echo str_replace("-", " ", $categoria); ?>
                    </div>

                    <!-- Select de cantidad -->
                    <div class="min-w-[100px]">
                        <select class="form-select text-sm" id="selectList" name="selectList" onchange="BuscarUsuarios(1)">
                            <option selected disabled>--</option>
                            <option>5</option>
                            <option>10</option>
                            <option>25</option>
                            <option>50</option>
                            <option>100</option>
                            <option>250</option>
                            <option>500</option>
                            <option>1000</option>
                        </select>
                    </div>

                    <!-- Campo de búsqueda -->
                    <div class="flex-grow">
                        <div class="relative inline-flex items-center w-full">
                            <span class="absolute left-3 text-muted">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="form-input p-2 w-full text-sm pl-10 placeholder-white" id="buscar" name="buscar" placeholder="Buscar..." onkeyup="BuscarUsuarios(1)">
                        </div>
                    </div>

                </div>
            </div>
            <br>
            <div id='viewTabla'>
                <?php if ($resul && mysqli_num_rows($resul) > 0) { ?>
                    <?php while($fi = mysqli_fetch_array($resul)){ ?>
                        <div class="flex items-center justify-between border p-3 rounded-lg shadow-sm mb-3">
                            <div class="flex items-center">
                                <i class="fas fa-file-pdf text-red-600 text-3xl mr-3"></i>
                                <div>
                                    <a href="#" target="_blank" class="text-decoration-none font-bold text-black">
                                        <?php echo $fi["nombre_documento"]; ?>
                                    </a>
                                    <div class="text-muted text-xs description"><?php echo $fi["descripcion"]; ?></div>
                                    <div class="text-muted text-xs"><?php echo $fi["fecha_creacion"]; ?></div>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <!-- Botón para previsualizar -->
                                <a href="javascript:void(0)" class="btn bg-green-600 text-white text-sm py-2 px-4 rounded shadow-sm hover:bg-green-700 flex items-center gap-2" data-bs-toggle="modal" data-bs-target="#pdfModal"
                                   onclick="ejecutar('<?php echo $fi["archivo"]; ?>')">
                                    <i class="fas fa-eye"></i>
                                </a>


                                <!-- Botón para descargar -->
                                <a href="<?php echo $fi["archivo"]; ?>" download class="btn bg-transparent border border-gray-300 text-sm py-2 px-4 rounded shadow-sm text-gray-700 hover:bg-gray-100 flex items-center gap-2" title="Descargar PDF">
                                    <i class="fas fa-download"></i>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else {
                    echo "<div class='text-center text-gray-500'>No se encontraron resultados</div>";
                } ?>

                <?php if ($TotalPaginas != 0):
                      $adjacents = 1;
                      $anterior = "&lsaquo; Anterior";
                      $siguiente = "Siguiente &rsaquo;";
                  ?>
                  <div class="mt-3">
                      <nav aria-label="Paginación de resultados">
                          <ul class="flex justify-center space-x-2 bg-white p-3 rounded-lg shadow-md">

                              <!-- Primera página -->
                              <?php if ($pagina > 1): ?>
                                  <li class="page-item">
                                      <a class="page-link text-gray-700 hover:text-blue-600 hover:bg-gray-200 px-4 py-2 rounded-md" href="javascript:void(0);" onclick="BuscarUsuarios(1)" aria-label="Primera">
                                          <span aria-hidden="true">&laquo;</span>
                                      </a>
                                  </li>
                              <?php endif; ?>

                              <!-- Anterior -->
                              <?php if ($pagina == 1): ?>
                                  <li class="page-item disabled">
                                      <span class="page-link text-gray-400 cursor-not-allowed px-4 py-2 rounded-md"><?= $anterior ?></span>
                                  </li>
                              <?php else: ?>
                                  <li class="page-item">
                                      <a class="page-link text-gray-700 hover:text-blue-600 hover:bg-gray-200 px-4 py-2 rounded-md" href="javascript:void(0);" onclick="BuscarUsuarios(<?= $pagina - 1 ?>)"><?= $anterior ?></a>
                                  </li>
                              <?php endif; ?>

                              <!-- Páginas -->
                              <?php
                                  if ($pagina > ($adjacents + 1)) {
                                      echo '<li class="page-item"><a class="page-link text-gray-700 hover:text-blue-600 hover:bg-gray-200 px-4 py-2 rounded-md" href="javascript:void(0);" onclick="BuscarUsuarios(1)">1</a></li>';
                                  }

                                  if ($pagina > ($adjacents + 2)) {
                                      echo '<li class="page-item disabled"><span class="page-link text-gray-400 cursor-not-allowed px-4 py-2 rounded-md">...</span></li>';
                                  }

                                  $pmin = ($pagina > $adjacents) ? ($pagina - $adjacents) : 1;
                                  $pmax = ($pagina < ($TotalPaginas - $adjacents)) ? ($pagina + $adjacents) : $TotalPaginas;

                                  for ($i = $pmin; $i <= $pmax; $i++) {
                                      if ($i == $pagina) {
                                          echo '<li class="page-item"><span class="page-link text-white bg-blue-600 px-4 py-2 rounded-md">' . $i . '</span></li>';
                                      } else {
                                          echo '<li class="page-item"><a class="page-link text-gray-700 hover:text-blue-600 hover:bg-gray-200 px-4 py-2 rounded-md" href="javascript:void(0);" onclick="BuscarUsuarios(' . $i . ')">' . $i . '</a></li>';
                                      }
                                  }

                                  if ($pagina < ($TotalPaginas - $adjacents - 1)) {
                                      echo '<li class="page-item disabled"><span class="page-link text-gray-400 cursor-not-allowed px-4 py-2 rounded-md">...</span></li>';
                                  }

                                  if ($pagina < ($TotalPaginas - $adjacents)) {
                                      echo '<li class="page-item"><a class="page-link text-gray-700 hover:text-blue-600 hover:bg-gray-200 px-4 py-2 rounded-md" href="javascript:void(0);" onclick="BuscarUsuarios(' . $TotalPaginas . ')">' . $TotalPaginas . '</a></li>';
                                  }
                              ?>

                              <!-- Siguiente -->
                              <?php if ($pagina < $TotalPaginas): ?>
                                  <li class="page-item">
                                      <a class="page-link text-gray-700 hover:text-blue-600 hover:bg-gray-200 px-4 py-2 rounded-md" href="javascript:void(0);" onclick="BuscarUsuarios(<?= $pagina + 1 ?>)"><?= $siguiente ?></a>
                                  </li>
                              <?php else: ?>
                                  <li class="page-item disabled">
                                      <span class="page-link text-gray-400 cursor-not-allowed px-4 py-2 rounded-md"><?= $siguiente ?></span>
                                  </li>
                              <?php endif; ?>

                              <!-- Última página -->
                              <?php if ($pagina != $TotalPaginas): ?>
                                  <li class="page-item">
                                      <a class="page-link text-gray-700 hover:text-blue-600 hover:bg-gray-200 px-4 py-2 rounded-md" href="javascript:void(0);" onclick="BuscarUsuarios(<?= $TotalPaginas ?>)" aria-label="Última">
                                          <span aria-hidden="true">&raquo;</span>
                                      </a>
                                  </li>
                              <?php endif; ?>
                          </ul>
                      </nav>
                  </div>
                  <?php endif; ?>

            </div>
        </div>

        <!-- Columna Derecha: Última Noticia -->
        <div class="col-span-12 lg:col-span-3">
            <div class="container-md">
                <div class="card shadow-sm">
                    <div class="card-header bg-green-500 text-white">
                        <h6 class="mb-0">📰 NOTAS RECIENTES</h6>
                    </div>
                    <div class="card-body p-3">
                        <?php while($fila = mysqli_fetch_array($rnoticia)): ?>
                            <?php if (!empty($fila["foto"])): ?>
                              <div class="news-item mb-4 border rounded shadow-sm overflow-hidden">
                                <div class="news-image">
                                    <img class="w-full h-32 object-cover" src="<?php echo $fila["foto"]; ?>" alt="noticia" />
                                </div>
                                <div class="p-3 flex flex-col justify-between h-full">
                                    <!-- Título del artículo con ajuste para que no se corte -->
                                    <h6 class="font-semibold text-gray-800" style="white-space: normal; overflow-wrap: break-word;">
                                        <?php echo $fila["titulo"]; ?>
                                    </h6>
                                    <!-- Contenido ajustado -->
                                    <p class="text-xs text-gray-500" style="white-space: normal; overflow-wrap: break-word;">
                                        <?php echo $fila["contenido"]; ?>
                                    </p>
                                    <a href="#" class='text-red-500' onclick="SeguirLeyendo(<?php echo $fila["id"]; ?>)">Ver mas</a>
                                </div>
                            </div>

                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



<!-- Modal -->
<!-- Modal -->
<div id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50">
  <div class="flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl">
      <!-- Modal Header -->
      <div class="bg-gray-100 px-4 py-3 flex justify-between items-center">
        <h5 class="text-lg font-semibold" id="pdfModalLabel">Visor de PDF</h5>
        <button type="button" class="text-gray-600 hover:text-gray-800" id="close-modal" onclick="closeModal()">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!-- Modal Body with scrollable content -->
      <div class="px-4 py-2 max-h-[75vh] overflow-y-auto">
        <div id="loading-message" class="text-center text-xl" style="display: none;">Cargando PDF...</div>

        <!-- Top Bar (Buttons and Pagination) -->
        <div class="bg-light py-1 px-2 shadow-sm mb-2" id="top-bar" style="display: none;">
          <div class="flex justify-between items-center">
            <!-- Buttons -->
            <div class="flex gap-2">
              <button class="bg-transparent hover:bg-blue-100 text-blue-500 p-2 rounded-md" id="prev" title="Anterior">
                <i class="fas fa-arrow-left"></i>
              </button>
              <button class="bg-transparent hover:bg-blue-100 text-blue-500 p-2 rounded-md" id="next" title="Siguiente">
                <i class="fas fa-arrow-right"></i>
              </button>
              <button class="bg-transparent hover:bg-green-100 text-green-500 p-2 rounded-md" id="download" title="Descargar" data-pdfd="vista/DocumentosPDF/RPC2024.pdf">
                <i class="fas fa-download"></i>
              </button>
              <button class="bg-transparent hover:bg-indigo-100 text-indigo-500 p-2 rounded-md" id="print" title="Imprimir" data-pdf="vista/DocumentosPDF/RPC2024.pdf">
                <i class="fas fa-print"></i>
              </button>
            </div>

            <!-- Pagination -->
            <div class="flex items-center">
              <span class="text-sm mr-2">Página</span>
              <input type="number" id="page_num_input" class="w-16 px-2 py-1 text-sm border border-gray-300 rounded-md" value="1" min="1" />
              <span class="text-sm ml-2">de <span id="page_count"></span></span>
            </div>
          </div>
        </div>

        <!-- Canvas Container with scroll -->
        <div class="container-md max-h-[60vh] overflow-auto" id="canvas-container">
          <canvas id="pdf_canvas" class="w-full border shadow-sm rounded"></canvas>
        </div>
      </div>

      <!-- Modal Footer -->
      <div class="bg-gray-100 px-4 py-3 text-right">
        <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md" id="close-modal-footer" onclick="closeModal()">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<input type="text" name="" id='pdfElejido' value="">
<script>

function verificarList(valor){
  if(valor != "" && valor != "--"){
    return valor;
  }else{
    return 9;
  }
}
function BuscarUsuarios(page){

  var obt_lis = document.getElementById("selectList").value;
    var listarDeCuanto = verificarList(obt_lis);
    var buscar = document.getElementById("buscar").value;
    var categoria = document.getElementById("categoria").value;

    //alert(buscar);
    //ponerFechactualAlModalDeReporte(listarDeCuanto,buscar,page,fecha);
    var datos = new FormData(); // Crear un objeto FormData vacío
    datos.append('pagina', page);
    datos.append('listarDeCuanto',listarDeCuanto);
    datos.append("buscar",buscar);
    datos.append("categoria",categoria);
      $.ajax({
        url: "/buscarViewTransparente",
        type: "POST",
        data: datos,
        contentType: false, // Deshabilitar la codificación de tipo MIME
        processData: false, // Deshabilitar la codificación de datos
        success: function(data) {
        //alert(data+"dasdas");
          $("#viewTabla").html(data);
        }
      });
  }


  pdfjsLib.GlobalWorkerOptions.workerSrc = 'vista/activos/pdf-js/pdf.worker.min.js';

let archivoPDF = "";

// Función para ejecutar el visor PDF
function ejecutar(ruta) {
  document.getElementById('pdfModal').classList.remove('hidden');
  archivoPDF = ruta; // Asigna la ruta al archivo PDF
  loadPDF(archivoPDF); // Carga el PDF
  const button = document.getElementById('download');
  const buttonp = document.getElementById('print');

  // Asignar el archivo PDF al atributo data-pdf
  button.setAttribute('data-pdf', archivoPDF);
  buttonp.setAttribute('data-pdf', archivoPDF);
}
function closeModal() {
  document.getElementById('pdfModal').classList.add('hidden');
}
let pdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
    scale = 1.5;

const canvas = document.getElementById("pdf_canvas");
const ctx = canvas.getContext('2d');

// Función para renderizar la página
function renderPage(num) {
  pageRendering = true;

  pdfDoc.getPage(num).then((page) => {
    const viewport = page.getViewport({ scale: scale });
    const outputScale = window.devicePixelRatio || 1;

    canvas.width = Math.floor(viewport.width * outputScale);
    canvas.height = Math.floor(viewport.height * outputScale);
    canvas.style.width = `${viewport.width}px`;
    canvas.style.height = `${viewport.height}px`;

    const transform = outputScale !== 1 ? [outputScale, 0, 0, outputScale, 0, 0] : null;

    const renderContext = {
      canvasContext: ctx,
      transform: transform,
      viewport: viewport
    };

    const renderTask = page.render(renderContext);
    renderTask.promise.then(() => {
      pageRendering = false;
      if (pageNumPending !== null) {
        renderPage(pageNumPending);
        pageNumPending = null;
      }
    });
  });

  document.getElementById('page_num_input').value = num;
}

// Función para agregar las páginas a la cola
function queueRenderPage(num) {
  if (pageRendering) {
    pageNumPending = num;
  } else {
    renderPage(num);
  }
}

// Función para ir a la página anterior
function onPrevPage() {
  if (pageNum <= 1) return;
  pageNum--;
  queueRenderPage(pageNum);
}

// Función para ir a la siguiente página
function onNextPage() {
  if (pageNum >= pdfDoc.numPages) return;
  pageNum++;
  queueRenderPage(pageNum);
}

// Cargar el archivo PDF
function loadPDF(archivoPDF) {
  document.getElementById('loading-message').style.display = 'block'; // Muestra el mensaje de carga
  pdfjsLib.getDocument(archivoPDF).promise.then((pdfDoc_) => {
    pdfDoc = pdfDoc_;
    document.getElementById('loading-message').style.display = 'none'; // Oculta el mensaje de carga
    document.getElementById('top-bar').style.display = 'block'; // Muestra la barra superior
    document.getElementById('page_count').textContent = pdfDoc.numPages;
    renderPage(pageNum);
  }).catch((error) => {
    document.getElementById('loading-message').style.display = 'none'; // Oculta el mensaje de carga en caso de error
    document.getElementById('canvas-container').innerHTML = '<div class="text-danger">No se pudo cargar el PDF.</div>';
  });
}

// Eventos para los botones de navegación
document.getElementById('prev').addEventListener('click', onPrevPage);
document.getElementById('next').addEventListener('click', onNextPage);

// Funcionalidad para cambiar la página desde el input
document.getElementById('page_num_input').addEventListener('keypress', function(event) {
  if (event.key === 'Enter') {
    const inputPageNum = parseInt(this.value, 10);
    if (inputPageNum >= 1 && inputPageNum <= pdfDoc.numPages) {
      pageNum = inputPageNum;
      queueRenderPage(pageNum);
    } else {
      alert(`Por favor, ingrese un número válido (1 - ${pdfDoc.numPages}).`);
    }
  }
});

// Descargar PDF
document.getElementById('download').addEventListener('click', () => {
  const datapdf = document.getElementById("download").getAttribute('data-pdfd');
  const link = document.createElement('a');
  link.href = datapdf;
  link.download = archivoPDF.split('/').pop();
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
});

// Imprimir PDF
document.getElementById('print').addEventListener('click', () => {
  const archivoPDF = document.getElementById('print').getAttribute('data-pdf');

  // Abre el PDF en una nueva pestaña
  const printWindow = window.open(archivoPDF, '_blank');
  printWindow.focus();

  // Espera a que la ventana cargue y luego imprime
  printWindow.onload = function() {
    printWindow.print();
  };
});

// Bloqueo clic derecho (opcional)
document.addEventListener('contextmenu', function(event) {
  event.preventDefault();
});


</script>

<?php require("vista/esquema/footeruni.php"); ?>
