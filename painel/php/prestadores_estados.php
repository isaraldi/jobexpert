<?php
	include "header.php";
	$id_estado = $_GET['id_estado'];
	$sql = "select * from jobexpert.prestador inner join jobexpert.estado_prestador on jobexpert.prestador.id_prestador = jobexpert.estado_prestador.prestador_id where estado_id = $id_estado";
	echo $sql;
	$res = mysql_query($sql);
	for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
		$row = mysql_fetch_row($res);

		$sql1 = "select * from jobexpert.solicitacao where prestador_id = $row[0]";
		$res1 = mysql_query($sql1);

		$sql2 = "select * from jobexpert.servico_prestador where prestador_id = $row[0]";
		$res2 = mysql_query($sql2);

		$html .= "
			<tr>
				<td class='v-align-middle semi-bold'>".utf8_encode($row[1])."</td>
				<td class='v-align-middle semi-bold'>".mysql_num_rows($res2)."</td>
				<td class='v-align-middle semi-bold'>".mysql_num_rows($res1)."</td>				
			</tr>
		";
	}
	echo $html;

?>