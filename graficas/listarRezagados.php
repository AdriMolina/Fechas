<?php
    require_once (dirname(__FILE__)."/../../core/utils.php");
    require_once('libGraficas.php');

    $db = connectDB();
	$fechaInicial = $_REQUEST['fechaInicial'];
	$fechaFinal = $_REQUEST['fechaFinal'];
	$tipo = $_REQUEST['tipo'];


	//TIPO DE REPORTE
	if($tipo == 'General'){

		$consulta = "SELECT n.digitos AS digitos, n.fecha AS fecha, c.nombre AS carrier, cl.nombre AS nombre, n.monto AS monto
					FROM numero n
					LEFT JOIN carrier c ON n.carrier_id = c.id
					LEFT JOIN cliente cl ON n.cliente_id = cl.id
					WHERE DATE(n.fecha) >='".$fechaInicial."'
					AND DATE(n.fecha) <= '".$fechaFinal."'
					AND n.id not in(Select numero_id from activado);";

	}else if ($tipo == 'Cliente'){
		$id = $_REQUEST['id'];
		$consulta ="SELECT n.digitos AS digitos, n.fecha AS fecha, c.nombre AS carrier, cl.nombre AS nombre, n.monto AS monto
					FROM numero n
					LEFT JOIN carrier c ON n.carrier_id = c.id
					LEFT JOIN cliente cl ON n.cliente_id = cl.id
					WHERE DATE(n.fecha) >='".$fechaInicial."'
					AND DATE(n.fecha) <= '".$fechaFinal."'
					AND n.id not in(Select numero_id from activado)
					AND cl.id = ".$id.";";

	}else{
		$id = $_REQUEST['id'];
		$consulta = "SELECT c.id, n.digitos AS digitos, n.fecha AS fecha, c.nombre AS carrier, cl.nombre AS nombre, n.monto AS monto
					FROM numero n
					LEFT JOIN carrier c ON n.carrier_id = c.id
					LEFT JOIN cliente cl ON n.cliente_id = cl.id
					LEFT JOIN clave_cliente cc ON cc.cliente_id = cl.id
					LEFT JOIN punto_venta pv ON cc.puntoVenta_id = pv.id
					WHERE  n.id not in(Select numero_id from activado)
					AND DATE(n.fecha) >='".$fechaInicial."'
					AND DATE(n.fecha) <= '".$fechaFinal."'
					AND pv.id = ".$id.";";

	}



    $resultado = $db->query($consulta);

    //Lo convierte en JSON
	$datos = array();
	foreach($resultado as $row){
		  $datos[] = $row;
	}

	echo json_encode($datos);



?>
