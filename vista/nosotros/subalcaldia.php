<?php require("vista/esquema/header.php"); ?>

<?php
$subalcaldias = [
  [
    "titulo" => "SUB ALCALDIA DE CHALLAPATA",
    "direccion" => "Plaza Potosi",
    "oficina" => "Oficina Plaza Potosi",
    "imagen" => "imagenes/subalcaldias/challapata.jpg"
  ],
  [
    "titulo" => "SUB ALCALDIA DE QAQACHACA",
    "direccion" => "Ex mercado Central",
    "oficina" => "Oficina ex mercado central",
    "imagen" => "imagenes/subalcaldias/qaqachaca.jpeg"
  ],
  [
    "titulo" => "SUB ALCALDIA DE HUANCANE",
    "direccion" => "Plaza Eduardo Avaroa, Esquina Av. Mariano Baptista",
    "oficina" => "Oficina en la Alcaldia Municipal de Challapata",
    "imagen" => "imagenes/subalcaldias/huancane.jpg"
  ],
  [
    "titulo" => "SUB ALCALDIA DE NORTE CONDO ABAJO",
    "direccion" => "Plaza Eduardo Avaroa, Esquina Av. Mariano Baptista",
    "oficina" => "Oficina planta baja",
    "imagen" => "imagenes/img-challapata/nortecondoAbajo.jpeg"
  ],
  [
    "titulo" => "SUB ALCALDIA DE NORTE CONDO NRO. 3",
    "direccion" => "Plaza Eduardo Avaroa, Esquina Av. Mariano Baptista",
    "oficina" => "Oficina Último piso de la alcaldía: Telf. (02)5820814",
    "imagen" => "imagenes/subalcaldias/norten3.JPG"
  ],
  [
    "titulo" => "SUB ALCALDIA DE CULTA",
    "direccion" => "Ex mercado central de Challapata",
    "oficina" => "Oficina ex mercado central",
    "imagen" => "imagenes/subalcaldias/culta.jpeg"
  ],
  [
    "titulo" => "SUB ALCALDIA DE ANCACATO",
    "direccion" => "Plaza Eduardo Avaroa, Esquina Av. Mariano Baptista",
    "oficina" => "Oficina planta baja",
    "imagen" => "imagenes/subalcaldias/ancacato.jpeg"
  ],
];
?>

<?php foreach ($subalcaldias as $item): ?>

  <div class="bg-gray-100 py-8">
    <div class="max-w-screen-lg mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center mb-12" id="challapata">
      <div data-aos="zoom-in" data-aos-duration="600">
        <h1 class="text-3xl font-bold uppercase mb-2 text-gray-800"><?= $item["titulo"] ?></h1>
        <h2 class="text-lg text-gray-600 mb-4">Información</h2>
        <ul class="space-y-2 text-base text-gray-700">
          <li><i class="fa fa-check-circle text-green-500 mr-2"></i><strong>Dirección:</strong> <?= $item["direccion"] ?></li>
          <li><i class="fa fa-check-circle text-green-500 mr-2"></i><strong>Oficina:</strong> <?= $item["oficina"] ?></li>
        </ul>
      </div>
      <div data-aos="zoom-in" data-aos-duration="800">
        <img src="<?= $item["imagen"] ?>" alt="Sub Alcaldía" class="w-full h-72 object-cover rounded shadow" />
      </div>
    </div>
  </div>
<?php endforeach; ?>


<?php require("vista/esquema/footeruni.php"); ?>
