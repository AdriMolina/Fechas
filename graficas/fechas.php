<?php
    require_once (dirname(__FILE__)."/../../core/utils.php");
	require_once('libGraficas.php');

    $db = connectDB();

    $fechaInicial = $_REQUEST['fechaInicial'];
  	$fechaFinal = $_REQUEST['fechaFinal'];
    $armado ="";
  	//PREPARAMOS LAS FECHAS PARA EL PROCESO
  	$fechaFinal = date('Y-m-j', strtotime($fechaFinal));
    $fechaInicial = date('Y-m-j', strtotime($fechaInicial));
    $fInicial = date('Y-m-j', strtotime($fechaInicial));

    $mesFinal = date('m', strtotime($fechaFinal));
    $mesInicial = date('m', strtotime($fechaInicial));

    	//QUITAMOS UN DIA A LA FECHA INICIAL
  	$fechaInicial = date($fechaInicial);
  	$fechaInicial = strtotime ( '-1 day' , strtotime ( $fechaInicial ) ) ;
  	$fechaInicial = date ( 'Y-m-j' , $fechaInicial );

  	//IGUALAMOS NUESTRA VARIABLE AUXILIAR
  	$nuevafecha = $fechaInicial;
  	$json = array();
    if(($mesFinal - $mesInicial) == 1){

    }

  		while(true)
  	   {
  		$fecha = date($nuevafecha);
  		$nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
  		$nuevafecha = date ( 'Y-m-j' , $nuevafecha );

  	//	echo $nuevafecha." ";

  		//FUNCION QUE CUENTA LOS REGISTROS POR FECHA
  		$armado .= "COUNT(CASE WHEN DATE(fecha) = '".$nuevafecha."' THEN id ELSE null END) AS '".$nuevafecha."',";

  		//$resultado = array("fecha" => $nuevafecha);
  		//$json[] = $resultado;
  		if($nuevafecha == $fechaFinal)
  			break;
  	   }

      $rest = substr($armado, 0, -1);  // devuelve "abcde"
      $datos = activadosGeneral($fechaInicial, $fechaFinal, $rest);


    //  print_r($datos); exit;

    //  echo count($datos); exit;
      $nuevafecha = $fInicial;
      $i = 0;
      $rest = array();
      while($i < count($datos))
  	   {




      $rest[] = array('dia' =>$nuevafecha ,'Total' => $datos[$i] );
      $i++;

      $fecha = date($nuevafecha);
      $nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
      $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
      print_r($rest);
}
      /*
        foreach ($datos as list($a, $b)) {
            $rest[] = array('Dia: ' =>$a , 'Total: ' =>$b );
  	   }

       //saco el numero de elementos
 $longitud = count($array);

 //Recorro todos los elementos
 for($i=0; $i<$longitud; $i++)
       {
       //saco el valor de cada elemento
 	  echo $array[$i];
 	  echo "<br>";
       }




    /*  $res = array();
      for($i = 0; $i < count($datos); $i++)
      {

      }*/

//echo json_encode ($rest);
  //$final  = array('final' => $resultado );


  	//print_r($json);*/



/*  //while por dias
		while($i<=$last_day)
	{
		$fecha = date($nuevafecha);
		$nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
		$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
	//	echo $nuevafecha." ";

		//FUNCION QUE CUENTA LOS REGISTROS POR FECHA
		$armado .= "COUNT(CASE WHEN DATE(fecha) = '".$nuevafecha."' THEN id ELSE null END) AS '".$nuevafecha."',";
    $i++;
		//$resultado = array("fecha" => $nuevafecha);
		//$json[] = $resultado;

		//if($nuevafecha == $fechaFinal)
			//break;
	}


$nuevafecha = date ( 'm' , strtotime($nuevafecha) );

$rest = substr($armado, 0, -1);  // devuelve "abcde"
$datos = activadosGeneral($fechaInicial, $fechaFinal, $rest);
//$resultado = array( $nuevafecha => $datos);
print_r ( $resultado);
	//print_r($json);*/

?>
