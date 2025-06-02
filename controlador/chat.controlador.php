<?php
require 'modelo/chat.php';

class ChatControlador{

  public function VisualizarTablaChat(){
    $ch = new Chatbot();
    $listarDeCuanto = 5;$pagina = 1;$buscar = "";
    $resul1 = $ch->SeleccionarChat($buscar,false,false);
    $num_filas_total = mysqli_num_rows($resul1);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $ch->SeleccionarChat($buscar,$inicioList,$listarDeCuanto);

    require("../vista/chat/tablaChat.php");
  }

  public function buscarYvisualizarTabla($pagina,$listarDeCuanto,$buscar){
    $ch = new Chatbot();
    $resul1 = $ch->SeleccionarChat($buscar,false,false);
    if(is_string($resul1)){
      echo "<h6>Ocurrio un error, $resul1</h6>";
    }else{
      $num_filas_total = mysqli_num_rows($resul1);
      $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
              //calculamos el registro inicial
      $inicioList = ($pagina - 1) * $listarDeCuanto;

      $resul = $ch->SeleccionarChat($buscar,$inicioList,$listarDeCuanto);
      echo "<div class='row'>
        <div class='col'>
          <div class='table-responsive' style='font-size:12px'>
          <table class='table'  style='font-size:12px'>
            <thead style='font-size:12px'>
              <tr>
                <th>N°</th>
                <th>Consulta</th>
                <th>Respuesta</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>";

        if (mysqli_num_rows($resul) > 0){
            $i = $inicioList;
          while($fi=mysqli_fetch_array($resul)){
              echo "<tr>";
                echo "<td>".($i+1)."</td>";
                echo "<td>".$fi['consulta']."</td>";
                echo "<td>".$fi['respuesta_consulta']."</td>";
                echo "<td>";
                  echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>";
									$dd = "<button type='button' class='btn btn-info' title='Editar' onclick='ActualizarNombreGenerico(".$fi["cod_cons"].",\"".$fi["consulta"]."\",\"".$fi["respuesta_consulta"]."\")' data-bs-toggle='modal' data-bs-target='#ModalRegistro'><img src='../imagenes/edit.ico' height='17' width='17' class='rounded-circle'></button>";
									echo $dd;
                //  echo "<button type='button' class='btn btn-danger' title='Desactivar' onclick='accionBtnActivar(".$fi["cod_cons"].")'><img src='../imagenes/drop.ico' height='17' width='17' class='rounded-circle'></button>";
                echo "<button type='button' class='btn btn-danger' title='Eliminar' onclick='accionBtnActivar(".$fi["cod_cons"].")'><img src='../imagenes/drop.ico' height='17' width='17' class='rounded-circle'></button>";

                  echo "</div>";
              echo "</td>";

              echo "</tr>";
              $i++;
            }
          }else{
            echo "<tr>";
            echo "<td colspan='15' align='center'>No se encontraron resultados</td>";
            echo "</tr>";
          }
      echo "</tbody>
        </table>
        </div>
      </div>
    </div>";
    if($TotalPaginas!=0){
      $adjacents=1;
      $anterior = "&lsaquo; Anterior";
      $siguiente = "Siguiente &rsaquo;";
  echo "<div class='row'>
        <div class='col'>";

      echo "<div class='d-flex flex-wrap flex-sm-row justify-content-between'>";
        echo '<ul class="pagination">';
          echo "pagina &nbsp;".$pagina."&nbsp;con&nbsp;";
            $total=$inicioList+$pagina;
            if($TotalPaginas > $num_filas_total){
              $TotalPaginas = $num_filas_total;
            }
          echo '<li class="page-item active"><a class=" href="#"> '.($TotalPaginas).' </a></li> ';
          echo " &nbsp;de&nbsp;".$num_filas_total." registros";
        echo '</ul>';

        echo '<ul class="pagination d-flex flex-wrap">';

        // previous label
        if ($pagina != 1) {
          echo "<li class='page-item'><a class='page-link'  onclick=\"Buscar(1)\"><span aria-hidden='true'>&laquo;</span></a></li>";
        }
        if($pagina==1) {
          echo "<li class='page-item'><a class='page-link text-muted'>$anterior</a></li>";
        } else if($pagina==2) {
          echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"Buscar(1)\" class='page-link'>$anterior</a></li>";
        }else {
          echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"Buscar($pagina-1)\">$anterior</a></li>";

        }
        // first label
        if($pagina>($adjacents+1)) {
          echo "<li class='page-item'><a href='javascript:void(0);' class='page-link' onclick=\"Buscar(1)\">1</a></li>";
        }
        // interval
        if($pagina>($adjacents+2)) {
          echo"<li class='page-item'><a class='page-link'>...</a></li>";
        }

        // pages

        $pmin = ($pagina>$adjacents) ? ($pagina-$adjacents) : 1;
        $pmax = ($pagina<($TotalPaginas-$adjacents)) ? ($pagina+$adjacents) : $TotalPaginas;
        for($i=$pmin; $i<=$pmax; $i++) {
          if($i==$pagina) {
            echo "<li class='page-item active'><a class='page-link'>$i</a></li>";
          }else if($i==1) {
            echo"<li class='page-item'><a href='javascript:void(0);' class='page-link'onclick=\"Buscar(1)\">$i</a></li>";
          }else {
            echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"Buscar(".$i.")\" class='page-link'>$i</a></li>";
          }
        }

        // interval

        if($pagina<($TotalPaginas-$adjacents-1)) {
          echo "<li class='page-item'><a class='page-link'>...</a></li>";
        }
        // last

        if($pagina<($TotalPaginas-$adjacents)) {
          echo "<li class='page-item'><a href='javascript:void(0);'class='page-link ' onclick=\"Buscar($TotalPaginas)\">$TotalPaginas</a></li>";
        }
        // next

        if($pagina<$TotalPaginas) {
          echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"Buscar($pagina+1)\">$siguiente</a></li>";
        }else {
          echo "<li class='page-item'><a class='page-link text-muted'>$siguiente</a></li>";
        }
        if ($pagina != $TotalPaginas) {
          echo "<li class='page-item'><a class='page-link' onclick=\"Buscar($TotalPaginas)\"><span aria-hidden='true'>&raquo;</span></a></li>";
        }

        echo "</ul>";
        echo "</div>";

  echo "</div>
      </div>";
      }
    }
  }



  public function EditarRegistrar($cod_conc,$consulta,$respuesta){
    $ch = new Chatbot();
		$consulta= strtolower($instancia->removeAccents($consulta));
		$respuesta= strtolower($instancia->removeAccents($respuesta));
    $resul = $ch->InsertarOactualizar($cod_conc,$consulta,$respuesta);
    if($resul != ''){
      echo "correcto";
    }else{
      echo "error";
    }
  }
	function removeAccents($text) {
		$acentos = [
        'á' => 'a', 'Á' => 'A',
        'é' => 'e', 'É' => 'E',
        'í' => 'i', 'Í' => 'I',
        'ó' => 'o', 'Ó' => 'O',
        'ú' => 'u', 'Ú' => 'U',
        'ü' => 'u', 'Ü' => 'U',
        'ñ' => 'ñ', 'Ñ' => 'ñ'
    ];
    // Reemplaza cada carácter acentuado con su versión sin tilde
    $text = strtr($text, $acentos);
    return $text;
}

	public function ReporteBuscarChat($buscar){
		$ch = new Chatbot();
		$resul = $ch->SeleccionarChat($buscar,false,false);
		require("../vista/chat/ReporteChat.php");
	}

  public function EliminarChat($cod_conc){
    $ch = new Chatbot();
		$resul = $ch->EliminarChatSql($cod_conc);
    if($resul != ''){
      echo "correcto";
    }else{
      echo "error";
    }
  }


  public static function MensajeUsuario($mensaje){
    $ch = new Chatbot();
    $instancia = new self();
    $resul = $ch->BuscarRespuesta();
		if($resul!=''){
      if(mysqli_num_rows($resul)>0){
				$vv = $instancia->GuardarEnArray($resul);
				$vecConsulta = $vv["consultas"];
				$vecRespuesta = $vv["respuestas"];
				//aplicando el coseno de similitud
				$totalConsulta = count($vecConsulta);
				$terminos = $instancia->SepararEnTerminos($vecConsulta);
				$terminoUsuario = $instancia->preprocess($mensaje);
				$df = $instancia->calcularELdf($terminos,$terminoUsuario);
				$tfidConsulta = $instancia->calcualarTFI($terminos,$df,$totalConsulta);
				$tfidUsuario = $instancia->calcularTFIusuario($terminoUsuario,$df,$totalConsulta);
				$resultadoCos = $instancia->CalcularCoseno($tfidConsulta,$tfidUsuario);
				$maxSimilar = max($resultadoCos);
				$posicion = array_search($maxSimilar, $resultadoCos);
				/*echo "La pregunta del usuario es más similar al documento: \n";
				echo $vecConsulta[$posicion] . "\n";
				echo "Con una similitud de coseno de: " . $vecRespuesta[$posicion] . "\n";
				*/
				echo $vecRespuesta[$posicion];
      }else{
        echo "Lo siento no tengo una respuesta para su consulta";
      }
    }else{
      echo "Lo siento no tengo una respuesta para su consulta";
    }
  }

	function GuardarEnArray($resul){
		$vec = array();
		$vecId = array();
		while($fi = mysqli_fetch_array($resul)){
			$vec[]=$fi["consulta"];
			$vecRes[]=$fi["respuesta_consulta"];
		}
		return array('consultas' => $vec, 'respuestas' => $vecRes);
	}

    // Preprocesar los documentos y la pregunta (convertir a minúsculas y dividir en palabras) y se hace un conteo de cada palabra cuantas veces aparece
    function preprocess($text) {
      $instancia = new self();
        return array_count_values(explode(" ", strtolower($instancia->removeAccents($text))));
    }

    function SepararEnTerminos($documents){
    	$terms = [];
      $instancia = new self();
    	foreach ($documents as $doc) {
    	    $terms[] = $instancia->preprocess($doc);
    	}
    	return $terms;
    }

    // Calcular el DF (Document Frequency)
    function calcularELdf($terms,$userTerms){
    	$df = [];
    	foreach ($terms as $termCount) {
    	    foreach ($termCount as $term => $count) {
    	        if (isset($df[$term])) {
    	            $df[$term] += 1;
    	        } else {
    	            $df[$term] = 1;
    	        }
    	    }
    	}
    	foreach ($userTerms as $term => $count) {
    	    if (!isset($df[$term])) {
    	        $df[$term] = 1;
    	    }
    	}
    	return $df;
    }

    // Calcular TF-IDF para cada documento y para la pregunta del usuario
    function calculateTfidf($termCount, $df, $totalDocuments) {
        $tfidf = [];
        foreach ($termCount as $term => $tf) {
            $idf = log($totalDocuments / $df[$term]);
            $tfidf[$term] = $tf * $idf;
        }
        return $tfidf;
    }

    function calcualarTFI($terms,$df,$totalDocuments){
    	$tfidfDocuments = [];
      $instancia = new self();
    	foreach ($terms as $termCount) {
    	    $tfidfDocuments[] = $instancia->calculateTfidf($termCount, $df, $totalDocuments);
    	}
    	return $tfidfDocuments;
    }
    function calcularTFIusuario($userTerms,$df,$totalDocuments){
      $instancia = new self();
    	$tfidfUser = $instancia->calculateTfidf($userTerms, $df, $totalDocuments);
    	return $tfidfUser;
    }
    function CalcularCoseno($tfidfDocuments,$tfidfUser){
    	$similarities = [];
      $instancia = new self();
    	foreach ($tfidfDocuments as $index => $tfidfDoc) {
    	    $similarities[$index] = $instancia->cosineSimilarity($tfidfUser, $tfidfDoc);
    	}
    	return $similarities;
    }
    // Función para calcular la similitud de coseno entre dos vectores
    function cosineSimilarity($vectorA, $vectorB) {
        $dotProduct = 0;
        $magnitudeA = 0;
        $magnitudeB = 0;

        foreach ($vectorA as $term => $weightA) {
            $weightB = isset($vectorB[$term]) ? $vectorB[$term] : 0;
            $dotProduct += $weightA * $weightB;
            $magnitudeA += $weightA * $weightA;
        }

        foreach ($vectorB as $weightB) {
            $magnitudeB += $weightB * $weightB;
        }

        if ($magnitudeA == 0 || $magnitudeB == 0) {
            return 0;
        }

        return $dotProduct / (sqrt($magnitudeA) * sqrt($magnitudeB));
    }

}
?>
