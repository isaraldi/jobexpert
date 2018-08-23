<?php
	include "header.php";
	$filtro = $_GET['filtro'];
	$busca = $_GET['busca'];
	$sql = "SELECT 
				id_prestador, nome_prestador	
			FROM 
				jobexpert.prestador
			where 
				nome_prestador like '%$busca%'
			group by
				id_prestador
			order by
				nome_prestador";
	$res = mysql_query($sql);

	$html = "";

	for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
		$row = mysql_fetch_row($res);


		$sql2 = "select round(avg(nota),2) from jobexpert.avaliacoes where prestador_id = $row[0];";
		$res2 = mysql_query($sql2);
		$row2 = mysql_fetch_row($res2);
		if($row2[0] == null){
			$row2[0] = "Não avaliado";
		}

		$sql3 = "select * from jobexpert.servico_prestador where prestador_id = $row[0]";
		$res3 = mysql_query($sql3);

		$sql4 = "select * from jobexpert.cidade_prestador where prestador_id = $row[0]";
		$res4 = mysql_query($sql4);

		$sql5 = "select * from jobexpert.estado_prestador where prestador_id = $row[0]";
		$res5 = mysql_query($sql5);		

		$html .= "

			<tr role='row' class='odd'>				

				<td class='v-align-middle'>
					<a href='prestador_detalhes.html?prestador=$row[0]&nome=".utf8_encode($row[1])."'>
						<p>".utf8_encode($row[1])."</p>
					</a>
				</td>

				<td class='v-align-middle'>
					<a href='prestador_estado.html?prestador=$row[0]&nome=".utf8_encode($row[1])."'>
						<p>".mysql_num_rows($res5)."</p>
					</a>
				</td>

				<td class='v-align-middle'>
					<a href='prestador_cidade.html?prestador=$row[0]&nome=".utf8_encode($row[1])."'>
						<p>".mysql_num_rows($res4)."</p>
					</a>
				</td>

				<td class='v-align-middle semi-bold sorting_1'>
					<a href='prestador_servicos.html?prestador=$row[0]&nome=".utf8_encode($row[1])."'>
						<p>".mysql_num_rows($res3)."</p>
					</a>
				</td>

				<td class='v-align-middle'>
					<a href='prestador_avaliacoes.html?prestador=$row[0]&nome=".utf8_encode($row[1])."'>
						<p>$row2[0]</p>
					</a>
				</td>

				<td class='v-align-middle'>
					<a href='javascript: excluirPrestador($row[0])' class='btn btn-tag'><i class='pg-trash'></i></a>
				</td>

			</tr>
		";
	}
	echo $html;
?>