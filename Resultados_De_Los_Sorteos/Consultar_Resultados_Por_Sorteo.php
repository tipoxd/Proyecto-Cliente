<?php

consultar();
function consultar()
{
    include('../php/conexion.php');

    if (isset($_POST['id_sorteo'])) {
        $id_sorteo = $_POST['id_sorteo'];
    } else {
        echo 'Codigo de sorteo Invalido';
        return;
    }
    if (isset($_POST['fecha'])) {
        $fecha = $_POST['fecha'];
    } else {
        echo 'Fecha Invalida';
        return;
    }





    $consulta = '

    SELECT
	*,
	premios.ganador,
	premios.descripcion,
	premios.fecha 
FROM
	sorteos
	INNER JOIN premios ON sorteos.cod_sorteo = premios.cod_sorteo 
WHERE
	sorteos.id_sorteo = ' . $id_sorteo . '
     AND
	premios.fecha = "' . $fecha . '"
    ORDER BY
	sorteos.hora ASC

		
';
    $resultados = mysqli_query($conexion, $consulta);
    $json = [];
    while ($row = mysqli_fetch_assoc($resultados)) {
        array_push($json, $row);
    };
    echo json_encode($json);
}
