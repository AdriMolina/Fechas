<?php
//-------------------------------------------------- REZAGADOS ------------------------------------------------------

	//FUNCION QUE LISTA GENERAL
	function rezagadosGeneral($fechaInicial){
		$db = connectDB();

    $consulta = "SELECT COUNT(n.id)
					FROM numero n
					LEFT JOIN carrier c ON n.carrier_id = c.id
					LEFT JOIN cliente cl ON n.cliente_id = cl.id
					WHERE DATE(n.fecha) ='".$fechaInicial."'
					AND n.id not in(Select numero_id from activado);";

    $resultado = $db->query($consulta);

    //Lo convierte en JSON
	$datos = array();
	foreach($resultado as $row){
		  $datos[] = $row;
	}

	return $datos;

	}


?>
