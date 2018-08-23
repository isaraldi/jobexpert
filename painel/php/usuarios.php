<?php
	include "header.php";	
	$filtro = $_GET['filtro'];
	$busca = $_GET['busca'];
	$sql = "select id_usuario, nome_usuario, email, DATE_FORMAT(data_cadastro, '%d/%m/%Y %H:%i'), verificado from jobexpert.usuarios where id_usuario != 1 and nome_usuario like '%$busca%' order by $filtro";
	$res = mysql_query($sql);
	$html = "";

	for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
		$row = mysql_fetch_row($res);

		$sql2 = "select round(avg(nota),2) from jobexpert.avaliacoes where usuario_id = $row[0];";
		$res2 = mysql_query($sql2);
		$row2 = mysql_fetch_row($res2);
		if($row2[0] == null){
			$row2[0] = "Não avaliado";
		}

		$sql3 = "select * from jobexpert.solicitacao where usuario_id = $row[0]";
		$res3 = mysql_query($sql3);

		if($row[4] == 0){
			$verificado = "<a href='javascript: verificarUsuario($row[0])' class='btn btn-tag'><i class='fs-14 fa fa-check'></i></a>";
		}else{
			$verificado = "<a class='btn-tag btn-tag-light' style='background-color=green;'><i class='fs-14 fa fa-check'></i></a>";
		}

		$html .= "

			<tr role='row' class='odd'>		

				<td class='v-align-middle'>
					<p>$row[3]</p>
				</td>		

				<td class='v-align-middle'>
					<input id='nome' value='".utf8_encode($row[1])."'></input>
				</td>

				<td class='v-align-middle'>
					<input id='email' value='".utf8_encode($row[2])."'></input>
				</td>

				<td class='v-align-middle'>
					<a href='usuario_avaliacoes.html?usuario=$row[0]&nome=".utf8_encode($row[1])."'>$row2[0]</a>
				</td>				

				<td class='v-align-middle semi-bold sorting_1'>
					<a href='usuario_chamadas.html?usuario=$row[0]&nome=".utf8_encode($row[1])."'>".mysql_num_rows($res3)."</a>
				</td>				

				<td class='v-align-middle'>
					$verificado

					<a href='javascript: editarUsuario($row[0])' class='btn btn-tag'><i class='fa fa-save'></i></a>
			
					<a href='javascript: excluirUsuario($row[0])' class='btn btn-tag'><i class='pg-trash'></i></a>
				</td>

				


			</tr>
		";
	}
	echo $html;
?>