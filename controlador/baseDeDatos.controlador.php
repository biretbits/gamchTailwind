<?php
require_once ("modelo/BaseDeDatos.php");
class BaseDeDatosControlador{
  public static function visualizarBaseDeDatos(){
    require("vista/base/basededatos.php");
  }

  public static function ExportarBD() {
      $u = new BaseDeDatos();
      $tablas = $u->showTables();  // Asumiendo que esta función retorna una lista de nombres de tablas.
      $backupArchivo = 'cds_' . date("Y-m-d-H-i-s") . '.sql';
      $handle = fopen($backupArchivo, 'w+');
      self::exportarDatos($tablas, $handle, $u);
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename=' . basename($backupArchivo));
      header('Content-Length: ' . filesize($backupArchivo));
      readfile($backupArchivo);
      // Eliminar el archivo del servidor
      unlink($backupArchivo);
      exit;
  }

  public static function exportarDatos($tables, $handle, $u) {
      // Escribe el encabezado del volcado
      fwrite($handle, "-- Exportación de la base de datos\n");
      fwrite($handle, "-- Base de datos: gamch\n");
      fwrite($handle, "-- Versión: " . mysqli_get_client_version() . "\n\n");
      // Desactiva las claves foráneas temporalmente
      fwrite($handle, "SET FOREIGN_KEY_CHECKS = 0;\n");

      // Aquí empieza el volcado de las tablas
      foreach ($tables as $table) {
          // Escribe el comando para eliminar la tabla si existe
          fwrite($handle, "DROP TABLE IF EXISTS `$table`;\n");

          // Obtiene el comando de creación de la tabla
          $createTableQuery = $u->CrearTabla($table)->fetch_row();
          fwrite($handle, $createTableQuery[1] . ";\n");

          fwrite($handle, "\n-- Dumping data for table `$table`\n\n");

          // Obtiene los datos de la tabla
          $result = $u->seleccionarTablas($table);
          $numFields = $result->field_count;

          // Inicializa el string de los valores de los INSERT
          $insertValues = [];

          // Recorre los datos y los agrega en formato INSERT
          while ($row = $result->fetch_row()) {
              $values = [];
              for ($i = 0; $i < $numFields; $i++) {
                  // Si el valor es nulo, lo reemplaza por NULL
                  $value = isset($row[$i]) ? $row[$i] : null;

                  // Si es un valor nulo, lo agrega como NULL
                  if ($value === null) {
                      $values[] = 'NULL';
                  } elseif (is_numeric($value)) {
                      // Si es un valor numérico, lo agrega directamente
                      $values[] = $value;
                  } else {
                      // Si es una cadena, la escapa y la pone entre comillas simples
                      $escaped_value = "'" . addslashes($value) . "'";
                      // Reemplaza valores vacíos por NULL si es necesario
                      if (empty($value)) {
                          $escaped_value = 'NULL';
                      }
                      $values[] = $escaped_value;
                  }
              }

              // Agrega la fila al arreglo de valores
              $insertValues[] = "(" . implode(',', $values) . ")";
          }

          // Escribe la sentencia INSERT con todos los valores
          if (!empty($insertValues)) {
              fwrite($handle, "INSERT INTO `$table` VALUES\n" . implode(",\n", $insertValues) . ";\n");
          }
      }

      // Reactiva las claves foráneas
      fwrite($handle, "SET FOREIGN_KEY_CHECKS = 1;\n"); // Asegúrate de que aquí esté escrito correctamente
      fwrite($handle, "-- Se exporta la base de datos correctamente\n");
      // Cierra el archivo
      fclose($handle);

  }

  public static function ImportaRbd(){
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
         // Obtener información del archivo
         $fileTmpPath = $_FILES["file"]["tmp_name"];
         $fileName = $_FILES["file"]["name"];
         $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
         // Validar la extensión del archivo
         if ($fileExtension === 'sql') {
             // Especifica el directorio de destino para el archivo subido
             $uploadDir = 'vista/esquema/bd/';
             $destination = $uploadDir . basename($fileName);
             //echo ($destination);
             // Mover el archivo al directorio de destino
             if (move_uploaded_file($fileTmpPath, $destination)) {
                 // Aquí puedes llamar a la función ImportarBD con la ruta del archivo
                 // Suponiendo que ImportarBD espera la ruta del archivo
                 $u = new BaseDeDatos();
                 echo $u->ImportarYcrearBd($destination);
             } else {
                 echo "Error al mover el archivo.";
             }
         } else {
             echo "Extensión de archivo no permitida. Solo se permiten archivos .sql.";
         }
     } else {
         echo "Error al subir el archivo.";
     }
  }


}


?>
