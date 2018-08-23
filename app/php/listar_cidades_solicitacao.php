<?php
	include 'header.php';
	$estado = $_GET['estado'];
	$servico = $_GET['id_servico'];
	$sql = "SELECT 
				id, nome
			FROM 
				jobexpert.cidades 
			inner join 
				jobexpert.cidade_prestador
			on
				jobexpert.cidades.id = jobexpert.cidade_prestador.cidade_id
			inner join
				jobexpert.servico_prestador
			on
				jobexpert.cidade_prestador.prestador_id = jobexpert.servico_prestador.prestador_id
			where 
				cidades.estado_id = $estado
			and  
				servico_id = $servico
			group by nome
			order by nome asc;";
	$res = mysql_query($sql);
    $html = "<option value=''>Cidade</option>";
	for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
		$row = mysql_fetch_row($res);
		$html .= "
                <option value=".$row[0].">".utf8_encode($row[1])."</option>
		";
	}
	echo $html;
?>
