<?php
	include "header.php";
	$id_servico = $_GET["id_servico"];
	$sql = "SELECT usuario_id, prestador_id, id_solicitacao, DATE_FORMAT(data_solicitacao, '%d/%m/%Y %H:%i') FROM jobexpert.solicitacao where servico_id_soli = $id_servico and usuario_id != 0;";
	$res = mysql_query($sql);

	

	for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
		$row = mysql_fetch_row($res);
		$sql1 = "SELECT nome_usuario FROM jobexpert.usuarios where id_usuario =".$row[0].";";
		$res1 = mysql_query($sql1);
		$row1 = mysql_fetch_row($res1);

		$sql2 = "SELECT nome_prestador FROM jobexpert.prestador where id_prestador =".$row[1].";";
		$res2 = mysql_query($sql2);
		$row2 = mysql_fetch_row($res2);

		$sql3 = "SELECT nome_servico FROM jobexpert.servico where id_servico =".$id_servico.";";
		$res3 = mysql_query($sql3);
		$row3 = mysql_fetch_row($res3);

		$vet['nomeServico'] = utf8_encode($row3[0]);


		$vet['html'] .= "
					<tr>
						<td class='v-align-middle semi-bold'>#$row[2]</td>					
						<td class='v-align-middle'>$row1[0]</td>
						<td class='v-align-middle'>$row2[0]</td>
						<td class='v-align-middle semi-bold'>$row[3]</td>
					</tr>
		";
	}
	echo json_encode($vet);
?>