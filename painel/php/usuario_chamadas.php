<?php
	include "header.php";
	$id_usuario = $_GET["id_usuario"];
	$sql = "SELECT id_solicitacao, nome_servico, DATE_FORMAT(data_solicitacao, '%d/%m/%Y %H:%i'), prestador_id FROM jobexpert.solicitacao inner join jobexpert.servico on jobexpert.servico.id_servico = jobexpert.solicitacao.servico_id_soli where usuario_id = $id_usuario;";
	$res = mysql_query($sql);	

	for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
		$row = mysql_fetch_row($res);

		$sql2 = "SELECT nome_prestador FROM jobexpert.prestador where id_prestador = ".$row[3].";";
		$res2 = mysql_query($sql2);
		$row2 = mysql_fetch_row($res2);

		$html .= "
					<tr>
						<td class='v-align-middle semi-bold'>#$row[0]</td>					
						<td class='v-align-middle'>".utf8_encode($row[1])."</td>
						<td class='v-align-middle'>$row[2]</td>
						<td class='v-align-middle semi-bold'>$row2[0]</td>
						<td class='v-align-middle'>
							<a href='chamadas-detalhes.html?id_chamada=$row[0]' class='btn btn-tag'>Detalhes</a>
						</td>
					</tr>
		";
	}
	echo $html;
?>