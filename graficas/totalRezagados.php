<?php
    require_once (dirname(__FILE__)."/../../core/utils.php");
	require_once('libGraficas.php');

  $db = connectDB();
	$fechaInicial = $_REQUEST['fechaInicial'];
	$fechaFinal = $_REQUEST['fechaFinal'];
	//$tipo = $_REQUEST['tipo'];


	//PREPARAMOS LAS FECHAS PARA EL PROCESO
	$fechaFinal = date('Y-m-j', strtotime($fechaFinal));

	//QUITAMOS UN DIA A LA FECHA INICIAL
	$fechaInicial = date($fechaInicial);
	$fechaInicial = strtotime ( '-1 day' , strtotime ( $fechaInicial ) ) ;
	$fechaInicial = date ( 'Y-m-j' , $fechaInicial );

	//IGUALAMOS NUESTRA VARIABLE AUXILIAR
	$nuevafecha = $fechaInicial;
	$json = array();

	while(true)
	{
		$fecha = date($nuevafecha);
		$nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
		$nuevafecha = date ( 'Y-m-j' , $nuevafecha );


		//FUNCION QUE CUENTA LOS REGISTROS POR FECHA
		$total = rezagadosGeneral($nuevafecha);
    echo $total."         ";

		$resultado = array("fecha" => $nuevafecha, "total" => $total);
		$json[] = $resultado;

		if($nuevafecha == $fechaFinal)
			break;
	}

  echo json_encode($json);



?>
