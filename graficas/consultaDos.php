<?php
require_once (dirname(__FILE__)."/../../core/utils.php");
require_once('libGraficasMeses.php');

$fechaInicial = $_POST['fechaInicial'];
$fechaFinal = $_POST['fechaFinal'];

$fecha = date("Y-m", strtotime($fechaFinal));

//SE DESCOMPONE LA FECHA EN DIAS MES Y ANIO DE LA PRIMERA FECHA
$diaI = date("d", strtotime($fechaInicial));
$mesI = date("m", strtotime($fechaInicial));
$anioI = date("Y", strtotime($fechaInicial));

//SE DESCOMPONE LA FECHA EN DIAS MES Y ANIO DE LA SEGUNDA FECHA
$diaF = date("d", strtotime($fechaFinal));
$mesF = date("m", strtotime($fechaFinal));
$anioF = date("Y", strtotime($fechaFinal));

$fechaInicial=mktime(0,0,0,$mesI,$diaI,$anioI);
$fechaFinal=mktime(0,0,0,$mesF,$diaF,$anioF);

$diferencia = $fechaFinal - $fechaInicial;

$dias=$diferencia/(60*60*24);
$meses = round($dias/30);
$i = 1;

// CONVERTIR FECHA





while($i<=$meses)
{

  $nuevafecha = strtotime( '-1 month' , strtotime($fecha) ) ;
$nuevafecha = date("Y-m-j", strtotime($nuevafecha));
 echo "- -".$nuevafecha."- -";

    $anio= date("Y", strtotime($nuevafecha));
    $mes= date("m", strtotime($nuevafecha));

  //FUNCION QUE CUENTA LOS REGISTROS POR MES
  $total = rezagadosGeneral($anio, $mes);


  $resultado = array("mes" => $mes, "total" => $total);
  $json[] = $resultado;
  $fechaAuxiliar = $anio."-".$mes;
  $fechaAuxiliar = date("Y-m", strtotime($fechaAuxiliar));
  $i++;
  //if($fecha == $fechaAuxiliar)
  //  break;
}

echo json_encode($json);



/*//CONVERSION DE LA FECHA PROPORCIONADA
$fecha = date("Y-m", strtotime($fecha));

//OBTENER EL ANIO DE LA FECHA DADA
$anio= date("Y", strtotime($fecha));

//OBTENER EL PRIMER MES DEL ANIO
$primerMes = $anio."-"."01";

//CONVERCION DEL PRIMER MES DEL ANIO
$primerMes = date("Y-m", strtotime($primerMes));

$fechaAuxiliar = $primerMes;

//OBTENER EL ULTIMO DIA DEL mes
$month = $fecha;
$aux = date('Y-m-d', strtotime("{$month} + 1 month"));
$last_day = date('Y-m-d', strtotime("{$aux} - 1 day"));

if($fecha != $last_day){
  //SE QUITA UN MES A LA FECHA LIMITE
  $fecha = strtotime ( '-1 month' , strtotime ( $fecha ) ) ;
  $fecha  = date ( 'Y-m' , $fecha );

}
//SE QUITA UN MES A LA FECHA
$fechaAuxiliar = strtotime ( '-1 month' , strtotime ( $fechaAuxiliar ) ) ;
$fechaAuxiliar  = date ( 'Y-m' , $fechaAuxiliar );


//REALIZACION DE LA CONSULTA DE TOTALES POR MES

while(true)
{

  $nuevafecha = strtotime ( '+1 month' , strtotime ( $fechaAuxiliar ) ) ;
  $mes = date ( 'm' , $nuevafecha );


  //FUNCION QUE CUENTA LOS REGISTROS POR MES
  $total = rezagadosGeneral($anio, $mes);


  $resultado = array("mes" => $mes, "total" => $total);
  $json[] = $resultado;
  $fechaAuxiliar = $anio."-".$mes;
  $fechaAuxiliar = date("Y-m", strtotime($fechaAuxiliar));

  if($fecha == $fechaAuxiliar)
    break;
}

echo json_encode($json);

//FECHA ACTUAL
$fechaActual = date("Y-m-d");


//FECHA ACTUAL TRES MESES ATRAS
$fecha = date('Y-m-j');
$nuevafecha = strtotime ( '-3 month' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m' , $nuevafecha );

//echo " ".$nuevafecha;

//OBTENER EL ULTIMO DIA DEL mes
$month = $nuevafecha;
$aux = date('Y-m-d', strtotime("{$month} + 1 month"));
$last_day = date('Y-m-d', strtotime("{$aux} - 1 day"));

//echo " El último día del mes es: {$last_day}";

/*  $resultado = $db->query($consulta);
  $row = mysqli_fetch_row($resultado);
        $datos=$row[0];

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

  echo json_encode($json);*/



?>
