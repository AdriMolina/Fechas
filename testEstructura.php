<?php

    $json = array();
    for($n = 2; $n < 5; $n++)
    {
        $mes = array();
        for($i = 0; $i < 20; $i++)
        {
            $valor = array("elemento" => $i, "total" => $i + 256);
            $mes[] = $valor;
        }

        $mesGeneral = array("numero" => $n, "dias" => $mes);
        $json[] = $mesGeneral;
    }

    //Regresa un arreglo con el resultado
    echo json_encode($json);
?>
