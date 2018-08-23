<?php
	include 'header.php';
	$solicitacao = $_GET['id_solicitacao'];
	$servico = $_GET['id_servico'];
	$cidade = $_GET['id_cidade'];
	$sql = "select rua, numero, complemento, descricao from jobexpert.solicitacao where id_solicitacao = ".$solicitacao.";";
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_row($res);

	$sql1 = "select nome_servico from jobexpert.servico where id_servico = ".$servico.";";
	$res1 = mysql_query($sql1);
	$row1 = mysql_fetch_row($res1);

	$sql2 = "select nome from jobexpert.cidades where id = '".$cidade."';";
	$res2 = mysql_query($sql2);
	$row2 = mysql_fetch_row($res2);

	$vet = array();
	$vet['servico'] = utf8_encode($row1[0]);
	$vet['cidade'] = utf8_encode($row2[0]);
	$vet['rua'] = utf8_encode($row[0]);
	$vet['numero'] = $row[1];
	$vet['complemento'] = utf8_encode($row[2]);
	$vet['descricao'] = utf8_encode($row[3]);

	echo json_encode($vet);
?>