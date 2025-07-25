<?php
/**
 *
 */

class BaseDeDatos
{
  public $con;
  function __construct()
	{
    // ← Declaración adecuada
		require_once("conexion.php");

			//llamando al metodo Conectaras de la clase Conexion para realizar los metodos de insert update delete
			$co=new Conexion();
			$this->con= $co->Conectaras();
	}
  public function getConexion() {
      return $this->con; // asumiendo que $this->con es tu conexión mysqli
  }

  public function showTables(){
    $tables = array();
    $result = $this->con->query("SHOW TABLES");
    while ($row = $result->fetch_row()) {
        $tables[] = $row[0];
    }
    return $tables;
  }

  public function CrearTabla($table){
    $sql = "SHOW CREATE TABLE $table";
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
  }

  public function seleccionarTablas($tabla){
    $sql = "select *from $tabla";
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    //mysqli_close($this->con);
  }

  public function ImportarYcrearBd($ruta) {
      $conn = new Conexion();
      $dBD = $conn->getDatabase();
      $database = $dBD['database'];

      $sqlCreateDb = "CREATE DATABASE IF NOT EXISTS `$database`";
      if ($this->con->query($sqlCreateDb) === TRUE) {
          $this->con->select_db($database);

          if (file_exists($ruta) && is_readable($ruta)) {
              $sql = file_get_contents($ruta);

              // Dividimos las consultas usando ';' para poder mostrar la consulta que falla
              $consultas = array_filter(array_map('trim', explode(';', $sql)));

              if ($this->con->multi_query($sql)) {
                  $counter = 0;
                  do {
                      if ($result = $this->con->store_result()) {
                          $result->free();
                      }

                      //echo "Ejecutando consulta: $counter\n";

                      // Mostrar solo la consulta actual (si existe)
                      if (isset($consultas[$counter])) {
                          //echo "Consulta SQL que se está ejecutando:\n" . $consultas[$counter] . ";\n";
                      } else {
                          //echo "Consulta SQL no encontrada para índice $counter\n";
                      }

                      if ($this->con->errno) {
                          //echo "Error en la consulta: " . $this->con->error . "\n";
                          if (isset($consultas[$counter])) {
                              //echo "Consulta que falló:\n" . $consultas[$counter] . ";\n";
                          }
                          break;  // Detiene la ejecución si hay error
                      }

                      $counter++;

                  } while ($this->con->more_results() && $this->con->next_result());

                  echo "Correcto";

              } else {
                  echo "Error en la ejecución general del multi_query: " . $this->con->error . "\n";
              }
          } else {
              echo "El archivo no se encuentra o no es legible\n";
          }
      } else {
          echo "Error al crear la base de datos: " . $this->con->error . "\n";
      }
  }


}



 ?>
