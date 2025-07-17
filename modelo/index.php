<?php
/**
 *
 */

class Index
{
    public $con;
  function __construct()
	{
		require_once("conexion.php");

			//llamando al metodo Conectaras de la clase Conexion para realizar los metodos de insert update delete
			$co=new Conexion();
			$this->con= $co->Conectaras();
	}
  public function BuscarRespuesta(){
    $sql = "select *from consultas";
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }
  public function SeleccionarNoticiasNuevas($inicioList = false, $listarDeCuanto = false) {
      if (is_numeric($inicioList) && is_numeric($listarDeCuanto)) {
          $sql = "SELECT * FROM nuevas_paginas ORDER BY id DESC LIMIT ? OFFSET ?";
          $stmt = $this->con->prepare($sql);
          $stmt->bind_param("ii", $listarDeCuanto, $inicioList);
          $stmt->execute();
          $resul = $stmt->get_result();
          return $resul;
      } else {
          // Si no hay paginación, traer todo
          $sql = "SELECT * FROM nuevas_paginas ORDER BY id DESC";
          return $this->con->query($sql);
      }
  }
  public function SeleccionarNoticiasDeDosDias($limite) {
      // Calcular la fecha de hace 5 días (el rango inferior)
    //  $fechaLimite5Dias = date('Y-m-d H:i:s', strtotime('-5 days'));
    // Rango de fechas: desde hace 5 días hasta hoy
    $sql = "SELECT MAX(fecha) AS ultima_fecha FROM nuevas_paginas";
    $resultado = $this->con->query($sql);

    if ($fila = $resultado->fetch_assoc()) {
        if($fila["ultima_fecha"] == null || $fila["ultima_fecha"] == ''){
          $fila["ultima_fecha"] = date("Y-m-d");
        }
        $ultimaFecha = $fila['ultima_fecha']; // string tipo '2025-06-14'
        //echo "Última fecha:<br><br><br><br> " . $ultimaFecha;

        // Convertir a timestamp
        $timestampUltima = strtotime($ultimaFecha);

        // Calcular rango
        $fechaInicio = date('Y-m-d', strtotime('-65 days', $timestampUltima));
        $fechaFin    = date('Y-m-d', strtotime('-5 days', $timestampUltima)); // hace 1 día desde la última
        //echo "ddd  ".$fechaInicio."     ".$fechaFin;
        // Consulta con BETWEEN
        $consulta = "SELECT * FROM nuevas_paginas
                     WHERE fecha BETWEEN '$fechaInicio' AND '$fechaFin'
                     ORDER BY id DESC
                     LIMIT $limite";

        return $this->con->query($consulta);
    }

  }
}


 ?>
