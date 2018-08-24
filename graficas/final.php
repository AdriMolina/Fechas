<?php
  require_once (dirname(__FILE__)."/../../core/utils.php");
	require_once('libGraficas.php');

    $db = connectDB();

    $fechaInicial = $_POST['fechaInicial'];
  	$fechaFinal = $_POST['fechaFinal'];
    $tipo = $_POST['tipo'];
    $armado ="";
  	//PREPARAMOS LAS FECHAS PARA EL PROCESO
  	$fechaFinal = date('Y-m-j', strtotime($fechaFinal));
    $fechaInicial = date('Y-m-j', strtotime($fechaInicial));
    $fInicial = date('Y-m-j', strtotime($fechaInicial));

    //SOLO EL MES DE LAS DOS FECHAS PROPORCIONADAS
    $mesFinal = date('m', strtotime($fechaFinal));
    $mesInicial = date('m', strtotime($fechaInicial));

    //QUITAMOS UN DIA A LA FECHA INICIAL
  	$fechaInicial = date($fechaInicial);
  	$fechaInicial = strtotime ( '-1 day' , strtotime ( $fechaInicial ) ) ;
  	$fechaInicial = date ( 'Y-m-j' , $fechaInicial );

  	//IGUALAMOS NUESTRA VARIABLE AUXILIAR
  	$nuevafecha = $fechaInicial;
  	$json = array();

    //CICLO PARA CREAR LA CONSULTA
  		while(true)
  	  {
          //SE INCREMENTA UN DIA A LA NUEVA FECHA
      		$fecha = date($nuevafecha);
      		$nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
      		$nuevafecha = date ( 'Y-m-j' , $nuevafecha );

      		//FUNCION QUE CUENTA LOS REGISTROS POR FECHA
      		$armado .= "COUNT(CASE WHEN DATE(a.fecha) = '".$nuevafecha."' THEN a.id ELSE null END) AS '".$nuevafecha."',";

      		if($nuevafecha == $fechaFinal)
      			break;
  	   }

       //AL RESULTADO DE LA CADENA SE LE QUITA LA COMA FINAL
      $rest = substr($armado, 0, -1);
      switch ($tipo) {
        case 'General':
          //EL RESULTADO DE LA CONSULTA SE GUARDA EN LA VARIABLE $DATOS TIPO ARRAY
          $datos = activadosGeneral($fechaInicial, $fechaFinal, $rest);
        break;
        case 'Cliente':
          $id = $_POST['id'];
          $datos = activadosCliente($fechaInicial, $fechaFinal, $rest, $id);
        break;
        case 'Punto Venta':
          $id = $_POST['id'];
          $datos = activadosPVenta($fechaInicial, $fechaFinal, $rest, $id);
        break;

      }


      //SE IGUALA NUESTRA VARIBLE AUXILIAR
      $nuevafecha = $fInicial;
      $i = 0;
      $rest = array();

      //CICLO PARA ENVIAR EL RESULTADO
      while($i < count($datos))
  	  {

          $rest[] = array('dia' =>$nuevafecha ,'Total' => $datos[$i] );
          $i++;

          $fecha = date($nuevafecha);
          $nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
          $nuevafecha = date ( 'Y-m-j' , $nuevafecha );

      }

 echo json_encode($rest);

?>
