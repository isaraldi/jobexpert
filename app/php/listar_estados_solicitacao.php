<?php
	include 'header.php';
	$servico = $_GET['id_servico'];
	$sql = "SELECT 
				id, nome
			FROM 
				jobexpert.estados 
			inner join 
				jobexpert.estado_prestador
			on
				jobexpert.estados.id = jobexpert.estado_prestador.estado_id
			inner join
				jobexpert.servico_prestador
			on
				jobexpert.estado_prestador.prestador_id = jobexpert.servico_prestador.prestador_id
			where 
				servico_id = $servico
			group by nome
			order by nome asc;";
	$res = mysql_query($sql);
    $html = "<option value=''>Estado</option>";
	for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
		$row = mysql_fetch_row($res);
		$html .= "
                <option value=".$row[0].">".utf8_encode($row[1])."</option>
		";
	}
	echo $html;
?>
