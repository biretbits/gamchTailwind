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
    <div class="flex justify-start px-5">
        <!-- Tabs -->
        <a class="text-blue-600 font-semibold text-lg" href="#wp-hos" data-toggle="tab" aria-expanded="true">
            <span class="hidden sm:inline"><?php echo $ruta; ?></span>
        </a>
    </div>

    <div class="container mx-auto px-5 mt-4">
        <input type="text" id='buscar' name="buscar" placeholder="Buscar..." class="w-full py-3 px-4 text-lg border rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500" onkeyup="buscando()">
    </div>

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
                                        <div class="flex">
                                            <div class="w-9/12">
                                                <h6 class="font-medium text-md text-gray-800">' . $doc['nombre_documento'] . '</h6>
                                                <hr class="my-2">
                                                <p class="text-sm text-gray-600 mt-3">' . $doc['descripcion'] . '</p>
                                            </div>
                                            <div class="w-2/12 text-left">
                                                <a href="' . $doc['archivo'] . '" target="_blank">
                                                  <img src="/imagenes/pdf.png" alt="PDF" class="max-w-[30px] mx-auto">
                                                </a>

                                                <h6 class="font-medium text-xs text-gray-500 mt-2">' . $doc['fecha_creacion'] . '</h6>
                                                <a href="' . $doc['archivo'] . '" download="' . $doc['nombre_documento'] . '.pdf">
                                                    <i class="fa fa-download fa-2x text-red-600 mt-2"></i>
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
</div>

<script type="text/javascript">
    function buscando() {
        var buscar = document.getElementById("buscar").value;
        var datos = new FormData(); // Crear un objeto FormData vacío
        datos.append("buscar", buscar);

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
</script>

<?php require("vista/esquema/footeruni.php"); ?>
