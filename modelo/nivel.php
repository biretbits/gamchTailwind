<?php
/**
 *
 */

class Nivel
{
  public $con = '';
  function __construct()
	{
		require_once("conexion.php");

			//llamando al metodo Conectaras de la clase Conexion para realizar los metodos de insert update delete
			$co=new Conexion();
			$this->con= $co->Conectaras();
	}
  public function seleccionarNiveles($buscar="",$inicioList=false,$listarDeCuanto=false) {
    // Convertir $buscar a minúsculas si está definido
      $buscar = strtolower(trim($buscar));
      // Base SQL
      $sql = "SELECT * FROM niveles";

      // Parámetros dinámicos
      $tipos = '';         // Tipos para bind_param (s: string, i: integer)
      $parametros = [];    // Valores a enlazar
      $existe = 'no';
      if ($buscar !== "") {
          $sql .= " WHERE LOWER(nivel_empleado) LIKE ?";
          $tipos .= 's';
          $parametros[] = '%' . strtolower($buscar) . '%';
          $existe = 'si';
    }

    $sql .= " ORDER BY id DESC";

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
          $sql = "UPDATE niveles SET
            nivel_empleado = '".$a["nivel"]."',
            creado_en = '".$a["fecha_creacion"]."'
            ";

        // Fecha de actualización
        $sql .= ", actualizado_en = NOW() WHERE id = $id";
        $resul = $this->con->query($sql);
        return $resul;
    } else {
        // INSERTAR NUEVO
        $sql = "INSERT INTO niveles (nivel_empleado,creado_en,actualizado_en
        ) VALUES (
            '".$a["nivel"]."', '".$a["fecha_creacion"]."', NOW()
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
    $sql= "delete from niveles where id = $id";
    $resul = $this->con->query($sql);
    return $resul;
  }



}



 ?>
