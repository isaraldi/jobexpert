<?php
	include "header.php";
	$id_prestador = $_GET['id_prestador'];
	$sql = "select id_servico, nome_servico from jobexpert.prestador inner join jobexpert.servico_prestador on jobexpert.prestador.id_prestador = jobexpert.servico_prestador.prestador_id inner join jobexpert.servico on jobexpert.servico.id_servico = jobexpert.servico_prestador.servico_id where id_prestador = $id_prestador";	
	echo $sql;
	$res = mysql_query($sql);

	for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
		$row = mysql_fetch_row($res);

		$sql1 = "select * from jobexpert.solicitacao where prestador_id = $id_prestador and servico_id_soli = $row[0]";		
		$res1 = mysql_query($sql1);

		$html .= "
			<tr>
				<td class='v-align-middle semi-bold'>".utf8_encode($row[1])."</td>
				<td class='v-align-middle'>".mysql_num_rows($res1)."</td>
			</tr>
		";
	}
	echo $html;

?>