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
    // Obtiene la información de la base de datos
    $conn = new Conexion();
    $dBD = $conn->getDatabase();
    $database = $dBD['database'];

    // Crear la base de datos si no existe
    $sqlCreateDb = "CREATE DATABASE IF NOT EXISTS `$database`";
    if ($this->con->query($sqlCreateDb) === TRUE) {
        // Selecciona la base de datos recién creada
        $this->con->select_db($database);

        // Verifica si el archivo existe y es legible
        if (file_exists($ruta) && is_readable($ruta)) {
            // Lee el contenido del archivo SQL
            $sql = file_get_contents($ruta);

            // Ejecuta el archivo SQL
            if ($this->con->multi_query($sql)) {
                $counter = 0;  // Contador para saber cuántas consultas se han ejecutado
                do {
                    // Almacena resultados para evitar errores de lectura
                    if ($result = $this->con->store_result()) {
                        $result->free();
                    }

                    // Imprime la consulta actual para rastrear el progreso
                    //echo "Ejecutando consulta: $counter\n";  // Mostrar el contador de consultas

                    // Muestra la consulta que se está ejecutando
                    //echo "Consulta SQL: " . $sql . "\n";

                    // Si ocurre un error, muestra detalles de la consulta y el error
                    if ($this->con->errno) {
                        echo "Error en la consulta: " . $this->con->error . "\n";
                        "Consulta que falló: " . $sql . "\n";
                        break;  // Detiene la ejecución en caso de error
                    }

                    $counter++;

                } while ($this->con->more_results() && $this->con->next_result());

                echo "Correcto";
            } else {
                // Imprime error de la ejecución del multi_query
                echo "Error en la importación";
            }
        } else {
            echo "El archivo no se encuentra o no es legible";
        }
    } else {
        echo "Error al crear la base de datos";
    }
}


}



 ?>
