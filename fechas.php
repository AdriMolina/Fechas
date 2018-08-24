<?php
  /*  require_once (dirname(__FILE__)."/../../core/utils.php");
	require_once('libGraficas.php');

    $db = connectDB();*/
	$fechaInicial = $_REQUEST['fechaInicial'];
	$fechaFinal = $_REQUEST['fechaFinal'];
  $armado ="";
	//PREPARAMOS LAS FECHAS PARA EL PROCESO
	$fechaFinal = date('Y-m-j', strtotime($fechaFinal));
  $fechaInicial = date('Y-m-j', strtotime($fechaInicial));

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

    echo $nuevafecha."<br>";
		if($nuevafecha == $fechaFinal)
			break;
	   }

$rest = substr($armado, 0, -1);  // devuelve "abcde"

print_r( $rest);
	//print_r($json);

?>
