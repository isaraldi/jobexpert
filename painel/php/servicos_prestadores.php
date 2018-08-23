<?php
	include "header.php";
	$id_servico = $_GET["id_servico"];
	$sql = "select id_prestador, nome_prestador, email_prestador from jobexpert.prestador inner join jobexpert.servico_prestador on jobexpert.prestador.id_prestador = jobexpert.servico_prestador.prestador_id where servico_id = $id_servico;";
	$res = mysql_query($sql);

	

	for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
		$row = mysql_fetch_row($res);
		$sql1 = "SELECT * FROM jobexpert.solicitacao where prestador_id =".$row[0]." and servico_id_soli = $id_servico;";
		$res1 = mysql_query($sql1);

		$sql2 = "SELECT * FROM jobexpert.solicitacao where servico_id_soli = $id_servico;";
		$res2 = mysql_query($sql2);

		$sql3 = "SELECT nome_servico FROM jobexpert.servico where id_servico =".$id_servico.";";
		$res3 = mysql_query($sql3);
		$row3 = mysql_fetch_row($res3);

		$vet['nomeServico'] = utf8_encode($row3[0]);


		$vet['html'] .= "
					<tr>
						<td class='v-align-middle semi-bold'>".utf8_encode($row[1])."</td>					
						<td class='v-align-middle'>".utf8_encode($row[2])."</td>
						<td class='v-align-middle'>".mysql_num_rows($res2)."</td>
						<td class='v-align-middle semi-bold'>".mysql_num_rows($res1)."</td>
					</tr>
		";
	}
	echo json_encode($vet);
?>