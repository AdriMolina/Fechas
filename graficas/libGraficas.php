<?php
//-------------------------------------------------- REZAGADOS ------------------------------------------------------

	//FUNCION QUE LISTA GENERAL
	function rezagadosGeneral($fechaInicial){
		$db = connectDB();

    $consulta = "SELECT COUNT(n.id) AS id
					FROM numero n
					LEFT JOIN carrier c ON n.carrier_id = c.id
					LEFT JOIN cliente cl ON n.cliente_id = cl.id
					WHERE DATE(n.fecha) ='".$fechaInicial."'
					AND n.id not in(Select numero_id from activado);";

    $resultado = $db->query($consulta);
		$row = mysqli_fetch_row($resultado);
					$datos=$row[0];
    //Lo convierte en JSON

	return $datos;

	}
	//-------------------------------------------------- ACTIVADOS ------------------------------------------------------

	function activadosGeneral($fechaInicial, $fechaFinal, $rest){
		$db = connectDB();

		$inicioConsulta = "SELECT ";
		$finConsulta = " FROM activado a WHERE DATE(fecha) BETWEEN '".$fechaInicial."' AND '".$fechaFinal."';";
		$consulta = $inicioConsulta.$rest.$finConsulta;

    $resultado = mysqli_query($db, $consulta);
		//Lo convierte en JSON
		$datos = mysqli_fetch_row($resultado);

	return $datos;

	}

	function activadosCliente($fechaInicial, $fechaFinal, $rest, $cliente_id){
		$db = connectDB();

		$inicioConsulta = "SELECT ";
		$finConsulta = "FROM  activado a
				LEFT JOIN numero n ON a.numero_id = n.id
				LEFT JOIN cliente c ON n.cliente_id = c.id
				LEFT JOIN carrier ca ON n.carrier_id = ca.id
				WHERE a.estado = 1
				AND DATE(a.fecha) >='".$fechaInicial."'
        AND DATE(a.fecha) <='".$fechaFinal."'
				AND c.id = ".$cliente_id.";";
		$consulta = $inicioConsulta.$rest.$finConsulta;

		$resultado = mysqli_query($db, $consulta);
		//Lo convierte en JSON
		$datos = mysqli_fetch_row($resultado);

	return $datos;

	}

	function activadosPVenta($fechaInicial, $fechaFinal, $rest, $puntoVenta_id){
		$db = connectDB();

		$inicioConsulta = "SELECT ";
		$finConsulta = "FROM  activado a
			LEFT JOIN numero n ON a.numero_id = n.id
			LEFT JOIN cliente c ON n.cliente_id = c.id
			LEFT JOIN carrier ca ON n.carrier_id = ca.id
			LEFT JOIN clave_cliente cc ON cc.cliente_id = c.id
			LEFT JOIN punto_venta pv ON cc.puntoVenta_id = pv.id
			WHERE a.estado = 1
			AND DATE(a.fecha) >='".$fechaInicial."'
			AND DATE(a.fecha) <='".$fechaFinal."'
			AND pv.id = ".$puntoVenta_id.";";
		$consulta = $inicioConsulta.$rest.$finConsulta;

		$resultado = mysqli_query($db, $consulta);
		//Lo convierte en JSON
		$datos = mysqli_fetch_row($resultado);

	return $datos;

	}




?>
