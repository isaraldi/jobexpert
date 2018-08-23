<?php
	include "header.php";
	$sql = "SELECT * FROM jobexpert.servico";
	$res = mysql_query($sql);
	$html = "";



	for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
		$row = mysql_fetch_row($res);
		$sql2 = "select count(id_solicitacao) from jobexpert.solicitacao where servico_id_soli = $row[0];";
		$res2 = mysql_query($sql2);
		$row2 = mysql_fetch_row($res2);

		$sql3 = "select count(servico_id) from jobexpert.servico_prestador where servico_id = $row[0];";
		$res3 = mysql_query($sql3);
		$row3 = mysql_fetch_row($res3);

		$html .= "

			<tr role='row' class='odd'>

				<td class='v-align-middle semi-bold sorting_1'>
					<p>#$row[0]</p>
				</td>

				<td class='v-align-middle'>
						<p>".utf8_encode($row[1])."</p>
				</td>

				<td class='v-align-middle'>
					<a href='servicos_chamadas.html?id_servico=$row[0]'>
						<p>$row2[0]</p>
					</a>
				</td>

				<td class='v-align-middle'>
					<a href='servicos_prestadores.html?id_servico=$row[0]'>
						<p>$row3[0]</p>
					</a>
				</td>

				<td class='v-align-middle'>
					<a href='javascript: excluirServico($row[0])' class='btn btn-tag'>Excluir</a>
				</td>

			</tr>
		";
	}
	echo $html;
?>