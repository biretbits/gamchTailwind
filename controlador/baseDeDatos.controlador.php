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
      fwrite($handle, "-- MariaDB dump\n");
      fwrite($handle, "-- Host: localhost    Database: cds\n");
      fwrite($handle, "-- Server version 10.4.32-MariaDB\n\n");

      fwrite($handle, "/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\n");
      fwrite($handle, "/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\n");
      fwrite($handle, "/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\n");
      fwrite($handle, "/*!40101 SET NAMES utf8mb4 */;\n");
      fwrite($handle, "/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;\n");
      fwrite($handle, "/*!40103 SET TIME_ZONE='+00:00' */;\n");
      fwrite($handle, "/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;\n");
      fwrite($handle, "/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;\n");
      fwrite($handle, "/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;\n");
      fwrite($handle, "/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;\n\n");

      // Aquí empieza el volcado de las tablas
      foreach ($tables as $table) {
          // Escribe el comando para eliminar la tabla si existe
          fwrite($handle, "DROP TABLE IF EXISTS `$table`;\n");

          // Obtiene el comando de creación de la tabla
          $createTableQuery = $u->CrearTabla($table)->fetch_row();
          fwrite($handle, $createTableQuery[1] . ";\n");

          fwrite($handle, "\n-- Dumping data for table `$table`\n\n");

          // Escribe el bloque LOCK TABLES y desactiva las claves
          fwrite($handle, "LOCK TABLES `$table` WRITE;\n");
          fwrite($handle, "/*!40000 ALTER TABLE `$table` DISABLE KEYS */;\n");

          // Obtiene los datos de la tabla
          $result = $u->seleccionarTablas($table);
          $numFields = $result->field_count;

          // Inicializa el string de los valores de los INSERT
          $insertValues = [];

          // Recorre los datos y los agrega en formato INSERT
          while ($row = $result->fetch_row()) {
              $values = [];
              for ($i = 0; $i < $numFields; $i++) {
                  // Si el valor es nulo, lo reemplaza por una cadena vacía
                  $value = isset($row[$i]) ? $row[$i] : '';

                  // Decodifica las entidades HTML antes de escapar los valores
                  $value = html_entity_decode((string)$value);

                  // Escapa los valores
                  $value = addslashes($value);

                  // Si es un valor numérico o null, lo agrega directamente
                  if ($value === '' || is_numeric($value)) {
                      $values[] = $value;
                  } else {
                      $values[] = "'" . $value . "'";  // Usando comillas simples
                  }
              }

              // Agrega la fila al arreglo de valores
              $insertValues[] = "(" . implode(',', $values) . ")";
          }

          // Escribe la sentencia INSERT con todos los valores
          if (!empty($insertValues)) {
              fwrite($handle, "INSERT INTO `$table` VALUES\n" . implode(",\n", $insertValues) . ";\n");
          }

          // Escribe el bloque para habilitar las claves y liberar las tablas
          fwrite($handle, "/*!40000 ALTER TABLE `$table` ENABLE KEYS */;\n");
          fwrite($handle, "UNLOCK TABLES;\n\n");
      }

      // Restaurar las configuraciones finales
      fwrite($handle, "\n/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;\n");
      fwrite($handle, "/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;\n");
      fwrite($handle, "/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;\n");
      fwrite($handle, "/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;\n");
      fwrite($handle, "/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\n");
      fwrite($handle, "/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\n");
      fwrite($handle, "/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;\n");
      fwrite($handle, "/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;\n");

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
