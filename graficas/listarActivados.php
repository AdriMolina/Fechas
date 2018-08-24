<?php
    require_once (dirname(__FILE__)."/../../core/utils.php");

    $db = connectDB();
	$fechaInicial = $_REQUEST['fechaInicial'];
	$fechaFinal = $_REQUEST['fechaFinal'];
	$tipo = $_REQUEST['tipo'];
	
	
	//TIPO DE REPORTE 
	if($tipo == 'General'){
		
		$consulta = "SELECT n.id AS id, n.digitos AS digitos, a.fecha AS fecha, ca.nombre AS carrier, n.monto AS monto, c.nombre AS nombre
				FROM  activado a 
				LEFT JOIN numero n ON a.numero_id = n.id
				LEFT JOIN cliente c ON n.cliente_id = c.id
				LEFT JOIN carrier ca ON n.carrier_id = ca.id
				WHERE a.estado = 1
				AND DATE(a.fecha) >='".$fechaInicial."'
				AND DATE(a.fecha) <= '".$fechaFinal."';";
				
	}else if ($tipo == 'Cliente'){
		$id = $_REQUEST['id'];
		$consulta ="SELECT n.id AS id, n.digitos AS digitos, a.fecha AS fecha, ca.nombre AS carrier, n.monto AS monto, c.nombre AS nombre
					FROM  activado a 
					LEFT JOIN numero n ON a.numero_id = n.id
					LEFT JOIN cliente c ON n.cliente_id = c.id
					LEFT JOIN carrier ca ON n.carrier_id = ca.id
					WHERE a.estado = 1
					AND DATE(a.fecha) >='".$fechaInicial."'
					AND DATE(a.fecha) <= '".$fechaFinal."'
					AND c.id = ".$id.";";
		
	}else{
		$id = $_REQUEST['id'];
		$consulta = "SELECT n.id AS id, n.digitos AS digitos, a.fecha AS fecha, ca.nombre AS carrier, n.monto AS monto, c.nombre AS nombre
			FROM  activado a 
			LEFT JOIN numero n ON a.numero_id = n.id
			LEFT JOIN cliente c ON n.cliente_id = c.id
			LEFT JOIN carrier ca ON n.carrier_id = ca.id
			LEFT JOIN clave_cliente cc ON cc.cliente_id = c.id
			LEFT JOIN punto_venta pv ON cc.puntoVenta_id = pv.id
			WHERE a.estado = 1
			AND DATE(a.fecha) >='".$fechaInicial."'
			AND DATE(a.fecha) <= '".$fechaFinal."'
			AND pv.id = ".$id."";
		
	}

    

    $resultado = $db->query($consulta);

    //Lo convierte en JSON
	$datos = array();
	foreach($resultado as $row){
		  $datos[] = $row;
	}
	
	echo json_encode($datos);
      


?>