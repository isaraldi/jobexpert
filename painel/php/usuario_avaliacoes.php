<?php
	include "header.php";
	$id_usuario = $_GET['id_usuario'];

	$sql = "select id_avaliacao, comentario, solicitacao_id from jobexpert.avaliacoes where usuario_id = $id_usuario";
	$res = mysql_query($sql);
	if(mysql_num_rows($res) > 0){

		for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
			$row = mysql_fetch_row($res);

			$sql1 = "select prestador_id, servico_id_soli from jobexpert.solicitacao where id_solicitacao = $row[2]";
			$res1 = mysql_query($sql1);
			$row1 = mysql_fetch_row($res1);

			$sql2 = "select nome_prestador from jobexpert.prestador where id_prestador = $row1[0];";
			$res2 = mysql_query($sql2);
			$row2 = mysql_fetch_row($res2);

			$sql3 = "select nome_servico from jobexpert.servico where id_servico = $row1[1];";
			$res3 = mysql_query($sql3);
			$row3 = mysql_fetch_row($res3);

			$sql4 = "select round(avg(nota),2) from jobexpert.avaliacoes where usuario_id = $id_usuario;";
			$res4 = mysql_query($sql4);
			$row4 = mysql_fetch_row($res4);

			$html .= "
				<tr>
					<td class='v-align-middle semi-bold'>".utf8_encode($row3[0])."</td>
					<td class='v-align-middle'>".utf8_encode($row4[0])."</td>
					<td class='v-align-middle semi-bold'>".utf8_encode($row[1])."</td>
					<td class='v-align-middle semi-bold'>".utf8_encode($row2[0])."</td>
					<td class='v-align-middle'>
						<a href='javascript: excluirAvaliacao($row[0])' class='btn btn-tag'>Excluir</a>
					</td>
				</tr>
			";
		}
		echo $html;
	}else{
		exit;
	}

?>