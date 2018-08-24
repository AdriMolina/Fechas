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

  //obtenemos el numero de meses entre el rango de FECHAS
  $mesInicial = date('m', strtotime($fechaInicial));
  $mesFinal = date('m', strtotime($fechaFinal));


  $nuevafecha = $fechaInicial;
  //COMENZAMOS EL CICLO DE meses


      while ($a <= $last_day ) {
      //  $armado .= "COUNT(CASE WHEN DATE(fecha) = '".$nuevafecha."' THEN id ELSE null END) AS '".$nuevafecha."', ";

      if($fechaFinal == $nuevafecha )
        echo "entro al if de fechas<br>";
      break;

        echo $nuevafecha."<br>";
        $fecha = date($nuevafecha);
        $nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
        $nuevafecha = date ( 'Y-m-j' , $nuevafecha );

        //obtenemos el dia de la nueva fecha
        $dianuevo = date ( 'd' , strtotime ( $nuevafecha ) );

        //saco el dia de la nuevafecha


        if($last_day = $dianuevo){
          $nuevafecha = strtotime ( '+1 day' , strtotime ( $nuevafecha ) ) ;
          $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
          echo "entro al if de dias<br>";
              break;
        }
          echo $nuevafecha."<br>";


          $a++;
      }
  



?>
