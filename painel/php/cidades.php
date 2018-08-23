<?php
	include "header.php";
	$id_estado = $_GET['id_estado'];
	$sql10 = "select * from jobexpert.cidades where estado_id = $id_estado";
	$res10 = mysql_query($sql10);
	for($i = 0 ; $i < mysql_num_rows($res10) ; $i++){
		$row10 = mysql_fetch_row($res10);

		$sql11 = "select * from jobexpert.cidade_prestador where cidade_id = $row10[0]";
		$res11 = mysql_query($sql11);
		//echo $sql11;

		$sql12 = "select * from jobexpert.solicitacao where cidade_id = $row10[0]";
		$res12 = mysql_query($sql12);

		$sql13 = "select * from jobexpert.cidade_prestador inner join jobexpert.prestador on jobexpert.cidade_prestador.prestador_id = jobexpert.prestador.id_prestador inner join jobexpert.servico_prestador on jobexpert.servico_prestador.prestador_id = jobexpert.prestador.id_prestador where cidade_id = $row10[0] group by servico_id";
		$res13 = mysql_query($sql13);

		$html .= "
			<tr>
				<td class='v-align-middle semi-bold'>".utf8_encode($row10[1])."</td>
				<td class='v-align-middle'>
					<a href='prestadores_cidades.html?cidade=$row10[0]&nome=".utf8_encode($row10[1])."'>".mysql_num_rows($res11)."</td>
				<td class='v-align-middle semi-bold'>".mysql_num_rows($res12)."</td>
				<td class='v-align-middle semi-bold'>".mysql_num_rows($res13)."</td>
			</tr>
		";
	}	

	echo $html;
?>