<?php require("vista/esquema/header.php"); ?>

<!-- Banner -->
<div class="bg-cover bg-center bg-no-repeat" style="background-image: url('imagenes/img-challapata/frontis2.jpg');">
    <div class="container mx-auto">
        <!-- Row -->
        <div class="flex justify-center py-10">
            <!-- Column -->
            <div class="text-center" data-aos="fade-down" data-aos-duration="1200">
                <div class="bg-white p-8 rounded-lg shadow-lg bg-opacity-90">
                    <h1 class="text-4xl font-extrabold text-gray-800 uppercase">Gaceta Municipal</h1>
                    <h6 class="text-lg text-gray-600 italic">Gobierno Autónomo Municipal de Challapata</h6>
                </div>
            </div>
            <!-- Column -->
        </div>
    </div>
</div>

<!-- Spacer & Tabs -->
<div class="bg-gray-100 py-10">


    <div class="container mx-auto px-5 mt-4">
      <div class="flex justify-start">
  <!-- Tabs -->
  <a class="text-blue-600 font-semibold text-lg" href="#wp-hos" data-toggle="tab" aria-expanded="true">
      <span class="inline"><?php echo $ruta; ?></span>  <!-- Cambié hidden sm:inline por inline -->
  </a>
</div>

        <input type="text" id='buscar' name="buscar" placeholder="Buscar..." class="w-full py-3 px-4 text-lg border rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500" onkeyup="buscando()">
    </div>
<input type="hidden" name="ruta" id='ruta' value="<?php echo $ruta;  ?>">
    <div id="verDatos">
        <div class="container mx-auto px-5 mt-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <?php
              if ($resul && mysqli_num_rows($resul) > 0) {
                while ($doc = mysqli_fetch_array($resul)) {
                    if ($doc["publicar"] == 1) {
                        echo '
                        <div class="col-md-6 mb-4" data-aos="fade-right" data-aos-duration="1200">
                            <div class="bg-white rounded-lg shadow-xl hover:shadow-2xl transition-all duration-300">
                                <div class="p-6">
                                    <div class="flex flex-col sm:flex-row gap-4">
                                        <div class="w-full sm:w-9/12">
                                            <h6 class="font-medium text-md text-gray-800">' . $doc['nombre_documento'] . '</h6>
                                            <hr class="my-2">';
                                            echo "<p id='descripcion-" . $doc['id'] . "' class='text-sm text-gray-500 mt-2 line-clamp-4'>";
                                            echo htmlspecialchars($doc['descripcion']);
                                            echo "</p>";
                                            // Botón para alternar entre "ver más" y "ver menos"
                                            echo "<button id='verMasBtn-" . $doc['id'] . "' class='text-blue-500 hover:text-blue-700 mt-2' onclick='toggleDescripcion(" . $doc['id'] . ")'>Ver más</button>";


                                        echo'<hr class="my-2">
                                            <h6 class="font-medium text-xs text-gray-500">Fecha: ' . $doc['fecha_creacion'] . ' Código: '.$doc['cod'].'</h6>
                                        </div>

                                        <div class="w-full sm:w-2/12 flex flex-col sm:flex-row items-center justify-center text-center space-y-2 sm:space-y-0 sm:space-x-2">
                                          <a href="javascript:void(0)"
                                             class="bg-red-600 text-white text-sm py-2 px-4 rounded shadow-sm hover:bg-orange-700 flex items-center gap-2"
                                             data-bs-toggle="modal"
                                             data-bs-target="#pdfModal"
                                             onclick="ejecutar(\'' . $doc['archivo'] . '\')">
                                            <i class="fas fa-eye"></i>
                                            <span>Ver</span>
                                          </a>

                                          <a href="' . $doc['archivo'] . '"
                                             download="' . $doc['nombre_documento'] . '.pdf"
                                             class="text-red-600 hover:text-red-700 flex items-center">
                                            <i class="fa fa-download fa-2x"></i>
                                          </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>';
                    }
                }
              } else {
                echo '
                <div class="col-md-6 mb-4">
                    <div class="bg-white rounded-lg shadow-xl hover:shadow-2xl transition-all duration-300">
                        <div class="p-6 text-center">
                            <p class="text-gray-500 mb-0">NO SE ENCONTRARON DOCUMENTOS</p>
                        </div>
                    </div>
                </div>';
              }
              ?>

        </div>
    </div>
</div>


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
        <div id="pdf_container" class="w-full max-w-[1000px] mx-auto">
          <div id="canvas-container">
            <canvas id="pdf_canvas" class="border border-gray-300 block mx-auto"></canvas>
          </div>
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

<script type="text/javascript">
    function buscando() {
        var buscar = document.getElementById("buscar").value;
        var datos = new FormData(); // Crear un objeto FormData vacío
        datos.append("buscar", buscar);
        datos.append("ruta", document.getElementById("ruta").value);
        $.ajax({
            url: "/buscando",
            type: "POST",
            data: datos,
            contentType: false, // Deshabilitar la codificación de tipo MIME
            processData: false, // Deshabilitar la codificación de datos
            success: function (data) {
                data = $.trim(data);
                if (data == "error") {
                    error();
                } else {
                    $("#verDatos").html(data);
                }
            }
        });
    }


      pdfjsLib.GlobalWorkerOptions.workerSrc = 'vista/activos/pdf-js/pdf.worker.min.js';

      let archivoPDF = "";

      // Función para ejecutar el visor PDF
      function ejecutar(ruta) {
        document.getElementById('pdfModal').classList.remove('hidden');
        archivoPDF = ruta;
        loadPDF(archivoPDF);
        const button = document.getElementById('download');
        const buttonp = document.getElementById('print');

        button.setAttribute('data-pdf', archivoPDF);
        buttonp.setAttribute('data-pdf', archivoPDF);
      }

      function closeModal() {
        document.getElementById('pdfModal').classList.add('hidden');
      }

      let pdfDoc = null,
          pageNum = 1,
          pageRendering = false,
          pageNumPending = null;

      const canvas = document.getElementById("pdf_canvas");
      const ctx = canvas.getContext('2d');

      // ✅ Función para renderizar la página con escala dinámica responsiva
      function renderPage(num) {
        pageRendering = true;

        pdfDoc.getPage(num).then((page) => {
          const container = document.getElementById("pdf_container");
          const containerWidth = container ? container.clientWidth : window.innerWidth;

          const unscaledViewport = page.getViewport({ scale: 1 });
          const scale = containerWidth / unscaledViewport.width;
          const viewport = page.getViewport({ scale });

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

      // ✅ Re-renderizar en redimensionamiento de pantalla
      window.addEventListener("resize", () => {
        if (pdfDoc) {
          renderPage(pageNum);
        }
      });

      // Función para agregar las páginas a la cola
      function queueRenderPage(num) {
        if (pageRendering) {
          pageNumPending = num;
        } else {
          renderPage(num);
        }
      }

      function onPrevPage() {
        if (pageNum <= 1) return;
        pageNum--;
        queueRenderPage(pageNum);
      }

      function onNextPage() {
        if (pageNum >= pdfDoc.numPages) return;
        pageNum++;
        queueRenderPage(pageNum);
      }

      function loadPDF(archivoPDF) {
        document.getElementById('loading-message').style.display = 'block';
        pdfjsLib.getDocument(archivoPDF).promise.then((pdfDoc_) => {
          pdfDoc = pdfDoc_;
          document.getElementById('loading-message').style.display = 'none';
          document.getElementById('top-bar').style.display = 'block';
          document.getElementById('page_count').textContent = pdfDoc.numPages;
          renderPage(pageNum);
        }).catch((error) => {
          document.getElementById('loading-message').style.display = 'none';
          document.getElementById('canvas-container').innerHTML = '<div class="text-danger">No se pudo cargar el PDF.</div>';
        });
      }

      document.getElementById('prev').addEventListener('click', onPrevPage);
      document.getElementById('next').addEventListener('click', onNextPage);

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

      document.getElementById('download').addEventListener('click', () => {
        const datapdf = document.getElementById("download").getAttribute('data-pdf');
        const link = document.createElement('a');
        link.href = datapdf;
        link.download = archivoPDF.split('/').pop();
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      });

      document.getElementById('print').addEventListener('click', () => {
        const archivoPDF = document.getElementById('print').getAttribute('data-pdf');
        const printWindow = window.open(archivoPDF, '_blank');
        printWindow.focus();
        printWindow.onload = function() {
          printWindow.print();
        };
      });

      document.addEventListener('contextmenu', function(event) {
        event.preventDefault();
      });
      function toggleDescripcion(id) {
          const descripcion = document.getElementById('descripcion-' + id);
          const btn = document.getElementById('verMasBtn-' + id);

          // Si el texto está recortado, mostramos todo el texto y cambiamos el botón
          if (descripcion.classList.contains('line-clamp-4')) {
              descripcion.classList.remove('line-clamp-4');
              btn.innerText = 'Ver menos';
          } else {
              descripcion.classList.add('line-clamp-4');
              btn.innerText = 'Ver más';
          }
      }

</script>


<?php require("vista/esquema/footeruni.php"); ?>
