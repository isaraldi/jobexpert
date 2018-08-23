<?php
	include "header.php";
	$id_solicitacao = $_GET["id_chamada"];
	$sql = "SELECT usuario_id, prestador_id,servico_id_soli,id_solicitacao, DATE_FORMAT(data_solicitacao, '%d/%m/%Y %H:%i') FROM jobexpert.solicitacao where id_solicitacao = $id_solicitacao;";
	$res = mysql_query($sql);

	$row = mysql_fetch_row($res);
	$sql1 = "SELECT nome_usuario FROM jobexpert.usuarios where id_usuario =".$row[0].";";
	$res1 = mysql_query($sql1);
	$row1 = mysql_fetch_row($res1);

	$sql3 = "SELECT nome_servico FROM jobexpert.servico where id_servico =".$row[2].";";
	$res3 = mysql_query($sql3);
	$row3 = mysql_fetch_row($res3);


	$html = "
				<tr>
					<td class='v-align-middle semi-bold'>$row[4]</td>
					<td class='v-align-middle semi-bold'>".utf8_encode($row1[0])."</td>
					<td class='v-align-middle'>Solicitou serviço de ".utf8_encode($row3[0])."</td>
					<td class='v-align-middle'></td>
				</tr>
	";

	if($row[1] != 0){
		$sql2 = "SELECT nome_prestador FROM jobexpert.prestador where id_prestador = $row[1];";
		$res2 = mysql_query($sql2);
		$row2 = mysql_fetch_row($res2);

		$html .= "
				<tr>
					<td class='v-align-middle semi-bold'>$row[4]</td>
					<td class='v-align-middle semi-bold'>".utf8_encode($row2[0])."</td>
					<td class='v-align-middle'>Foi escolhido para realizar o serviço</td>
					<td class='v-align-middle'></td>
				</tr>
		";

		$sql4 = "SELECT DATE_FORMAT(data, '%d/%m/%Y %H:%i'), mensagem, usuario_id, prestador_id, enviou_id FROM jobexpert.conversas inner join jobexpert.mensagens on jobexpert.conversas.id_conversa = jobexpert.mensagens.conversa_id where solicitacao_id = $id_solicitacao;";
		$res4 = mysql_query($sql4);

		for($i = 0 ; $i < mysql_num_rows($res4) ; $i++){
			$row4 = mysql_fetch_row($res4);

			if($row4[2] == $row4[4]){
				$sql5 = "SELECT nome_usuario FROM jobexpert.usuarios where id_usuario = $row4[2];";
				$res5 = mysql_query($sql5);
				$row5 = mysql_fetch_row($res5);
			}else{
				$sql5 = "SELECT nome_prestador FROM jobexpert.prestador where id_prestador =".$row4[4].";";
				$res5 = mysql_query($sql5);
				$row5 = mysql_fetch_row($res5);

			}
			$html .= "
				<tr>
					<td class='v-align-middle semi-bold'>$row4[0]</td>
					<td class='v-align-middle semi-bold'>".utf8_encode($row5[0])."</td>
					<td class='v-align-middle'>Enviou uma mensagem</td>
					<td class='v-align-middle'>".utf8_encode($row4[1])."</td>
				</tr>
			";
		}


	}

	echo $html;
?>