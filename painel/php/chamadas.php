<?php
	include "header.php";
	$filtro = $_GET['filtro'];
	$busca = $_GET['busca'];
	$sql = "SELECT 
				id_solicitacao, nome_servico, jobexpert.estados.nome, jobexpert.cidades.nome, DATE_FORMAT(data_solicitacao, '%d/%m/%Y %H:%i') 
			FROM 
				jobexpert.solicitacao 
			inner join
				jobexpert.servico
			on
				jobexpert.solicitacao.servico_id_soli = jobexpert.servico.id_servico
			inner join
				jobexpert.estados
			on
				jobexpert.solicitacao.estado_id = jobexpert.estados.id
			inner join
				jobexpert.cidades
			on
				jobexpert.solicitacao.cidade_id = jobexpert.cidades.id
			where 
				id_solicitacao like '%$busca%'
			and
				usuario_id != 0 
			order by 
				$filtro asc;";
	$res = mysql_query($sql);

	$html = "";

	for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
		$row = mysql_fetch_row($res);

		$html .= "
					<tr role='row' class='odd'>
						<td class='v-align-middle semi-bold sorting_1'>
							<p>#$row[0]</p>
						</td>

						<td class='v-align-middle'>
							<p>".utf8_encode($row[1])."</p>
						</td>

						<td class='v-align-middle'>
							<p>".utf8_encode($row[2])."</p>
						</td>

						<td class='v-align-middle'>
							<p>".utf8_encode($row[3])."</p>
						</td>

						<td class='v-align-middle'>
							<p>$row[4]</p>
						</td>

						<td class='v-align-middle'>
							<a href='chamadas-detalhes.html?id_chamada=$row[0]' class='btn btn-tag'>Detalhes</a>
						</td>
					</tr>
		";
	}
	echo $html;
?>