<?php
	include "header.php";
	$vet = array();
	
	$sql = "select * from jobexpert.prestador where DATE_FORMAT(data_cadastro,'%Y-%c') = DATE_FORMAT(NOW(),'%Y-%c');";
	$res = mysql_query($sql);
	$vet['prestadoresMes'] = mysql_num_rows($res);

	$sql1 = "select * from jobexpert.prestador;";
	$res1 = mysql_query($sql1);
	$vet['prestadoresTotal'] = mysql_num_rows($res1);

	$sql2 = "select * from jobexpert.usuarios where DATE_FORMAT(data_cadastro,'%Y-%c') = DATE_FORMAT(NOW(),'%Y-%c');";
	$res2 = mysql_query($sql2);
	$vet['usuariosMes'] = mysql_num_rows($res2);

	$sql3 = "select * from jobexpert.usuarios;";
	$res3 = mysql_query($sql3);
	$vet['usuariosTotal'] = mysql_num_rows($res3);

	$sql4 = "select * from jobexpert.solicitacao where DATE_FORMAT(data_solicitacao,'%Y-%c') = DATE_FORMAT(NOW(),'%Y-%c');";
	$res4 = mysql_query($sql4);
	$vet['servicosMes'] = mysql_num_rows($res4);

	$sql5 = "select * from jobexpert.servico;";
	$res5 = mysql_query($sql5);
	$vet['servicosTotal'] = mysql_num_rows($res5);

	$sql6 = "select concluido,data_solicitacao from jobexpert.solicitacao where concluido > 0 AND DATE_FORMAT(data_solicitacao,'%Y-%c') = DATE_FORMAT(NOW(),'%Y-%c');";
	$res6 = mysql_query($sql6);
	$vet['concluidosMes'] = mysql_num_rows($res6);

	$sql7 = "select concluido from jobexpert.solicitacao where concluido <> 0;";
	$res7 = mysql_query($sql7);
	$vet['concluidosTotal'] = mysql_num_rows($res7);

	$sql8 = "select id_servico from jobexpert.servico;";
	$res8 = mysql_query($sql8);
	$vet['tipoServicoTotal'] = mysql_num_rows($res8);

	$sql9 = "select * from jobexpert.servico_prestador group by servico_id;";
	$res9 = mysql_query($sql9);
	$vet['tipoServicoAtendido'] = mysql_num_rows($res9);

	$sql10 = "select * from jobexpert.estados";
	$res10 = mysql_query($sql10);
	for($i = 0 ; $i < mysql_num_rows($res10) ; $i++){
		$row10 = mysql_fetch_row($res10);

		$sql11 = "select * from jobexpert.estado_prestador where estado_id = $row10[0]";
		$res11 = mysql_query($sql11);
		//echo $sql11;

		$sql12 = "select * from jobexpert.solicitacao where estado_id = $row10[0]";
		$res12 = mysql_query($sql12);

		$sql13 = "select * from jobexpert.estado_prestador inner join jobexpert.prestador on jobexpert.estado_prestador.prestador_id = jobexpert.prestador.id_prestador inner join jobexpert.servico_prestador on jobexpert.servico_prestador.prestador_id = jobexpert.prestador.id_prestador where estado_id = $row10[0] group by servico_id";
		$res13 = mysql_query($sql13);

		$vet['listaEstados'] .= "
			<tr>
				<td class='v-align-middle semi-bold'>
					<a href='cidades.html?estado=$row10[0]&nome=".utf8_encode($row10[1])."'>".utf8_encode($row10[1])."</a>
				</td>
				<td class='v-align-middle'>
					<a href='prestadores_estados.html?estado=$row10[0]&nome=".utf8_encode($row10[1])."'>".mysql_num_rows($res11)."</a>
				</td>
				<td class='v-align-middle semi-bold'>".mysql_num_rows($res12)."</td>
				<td class='v-align-middle semi-bold'>".mysql_num_rows($res13)."</td>
			</tr>
		";
	}

	$sql14 = "select * from jobexpert.estado_prestador group by estado_id;";
	$res14 = mysql_query($sql14);
	$vet['estadosAtendidos'] = mysql_num_rows($res14);

	$sql15 = "select * from jobexpert.cidade_prestador group by cidade_id;";
	$res15 = mysql_query($sql15);
	$vet['cidadesAtendidas'] = mysql_num_rows($res15);

	$json = json_encode($vet);
	echo $json;
?>