<?php
/**
 *
 */

class Cargo
{
  public $con = '';
  function __construct()
	{
		require_once("conexion.php");

			//llamando al metodo Conectaras de la clase Conexion para realizar los metodos de insert update delete
			$co=new Conexion();
			$this->con= $co->Conectaras();
	}
  public function seleccionarCargos($buscar="",$inicioList=false,$listarDeCuanto=false) {
    // Convertir $buscar a minúsculas si está definido
      $buscar = strtolower(trim($buscar));
      // Base SQL
      $sql = "SELECT c.id,c.nivel_id,c.cargo_empleado,c.creado_en,c.actualizado_en,c.estado, n.id as id_nivel, n.nivel_empleado
      FROM cargos as c inner join niveles as n on c.nivel_id = n.id";

      // Parámetros dinámicos
      $tipos = '';         // Tipos para bind_param (s: string, i: integer, etc.)
      $parametros = [];    // Valores a enlazar
      $existe = 'no';

      if ($buscar !== "") {
          $sql .= " WHERE (LOWER(c.cargo_empleado) LIKE ? OR LOWER(n.nivel_empleado) LIKE ?)";
          $tipos .= 'ss'; // Dos parámetros tipo string
          $parametros[] = '%' . strtolower($buscar) . '%';
          $parametros[] = '%' . strtolower($buscar) . '%';
          $existe = 'si';
      }


    $sql .= " ORDER BY c.id DESC";

    if (is_numeric($inicioList) && is_numeric($listarDeCuanto)) {
        $sql .= " LIMIT ? OFFSET ?";
        $tipos .= 'ii';
        $parametros[] = (int)$listarDeCuanto;
        $parametros[] = (int)$inicioList;
    }
    // Preparar la consulta
    $stmt = $this->con->prepare($sql);

    // Verifica si la preparación fue exitosa
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $this->con->error);
    }

    // Enlazar parámetros si existen
    if (!empty($parametros)) {
        $stmt->bind_param($tipos, ...$parametros);
    }

    // Ejecutar y obtener resultados
    $stmt->execute();
    $resul = $stmt->get_result();

    // Retornar el resultado
    return $resul;

  }

  public function Registrar($a){
    $id = $a["id"];
    if ($id != "") {
        // ACTUALIZAR
          $sql = "UPDATE cargos SET
            nivel_id = '".$a["id_nivel"]."',
            cargo_empleado = '".$a["cargo"]."',
            creado_en = '".$a["fecha_creacion"]."'
            ";

        // Fecha de actualización
        $sql .= ", actualizado_en = NOW() WHERE id = $id";
        $resul = $this->con->query($sql);
        return $resul;
    } else {
        // INSERTAR NUEVO
        $sql = "INSERT INTO cargos (nivel_id,cargo_empleado,creado_en,actualizado_en
        ) VALUES (
            '".$a["id_nivel"]."','".$a["cargo"]."', '".$a["fecha_creacion"]."', NOW()
        )";
        $resul = $this->con->query($sql);
        return $resul;
    }

  }

  public function ultimaNoticia(){
    $sql = "SELECT * FROM nuevas_paginas
    ORDER BY id DESC
    LIMIT 2;
    ";
    $resul = $this->con->query($sql);
    return $resul;
  }

  public function Eliminar($id){
    $sql= "delete from cargos where id = $id";
    $resul = $this->con->query($sql);
    return $resul;
  }


  public function buscarNivel($buscar) {
    // Convierte la búsqueda a minúsculas
    $min = strtolower($buscar);
    // SQL con INNER JOIN entre usuarios y empleados, solo seleccionando los campos requeridos
    $sql = "SELECT *
    FROM niveles
    WHERE nivel_empleado LIKE '%$min%'
    LIMIT 5 OFFSET 0;
    ";  // Puedes ajustar el OFFSET si lo necesitas

    // Ejecutar la consulta
    $resul = $this->con->query($sql);

    return $resul;
  }


}



 ?>
