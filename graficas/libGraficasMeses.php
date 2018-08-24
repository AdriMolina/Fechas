<?php
//-------------------------------------------------- REZAGADOS ------------------------------------------------------

	//FUNCION QUE LISTA GENERAL
	function rezagadosGeneral($anio, $mes){
		$db = connectDB();

    $consulta = "SELECT COUNT(n.id) AS id
					FROM numero n
					LEFT JOIN carrier c ON n.carrier_id = c.id
					LEFT JOIN cliente cl ON n.cliente_id = cl.id
					WHERE MONTH(n.fecha) =".$mes."
          AND YEAR(n.fecha) = ".$anio."
					AND n.id not in(Select numero_id from activado);";

    $resultado = $db->query($consulta);

		$row = mysqli_fetch_row($resultado);
					$datos=$row[0];
		//Lo convierte en JSON

	return $datos;

	}

/*
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

}*/


?>
