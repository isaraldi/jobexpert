<?php
	include 'header.php';
	$prestador = $_GET['id_prestador'];
	$solicitacao = $_GET['id_solicitacao'];
	$usuario = $_GET['id_usuario'];
	
	$sql = "update jobexpert.solicitacao set prestador_id = ".$prestador." where id_solicitacao = ".$solicitacao.";";
	$res = mysql_query($sql);
	//echo $sql;

	$sql2 = "delete from jobexpert.interessados_solicitacao where solicitacao_id = ".$solicitacao.";";
	$res2 = mysql_query($sql2);
	//echo $sql2;

	$sql3 = "insert into jobexpert.conversas (usuario_id, prestador_id, solicitacao_id) values (".$usuario.",".$prestador.", ".$solicitacao.");";
	$res3 = mysql_query($sql3);
	//echo $sql3;

	if($res2 == 1 && $res == 1 && $res3 == 1){
		echo 1;
	}else{
		echo 0;
	}
?>