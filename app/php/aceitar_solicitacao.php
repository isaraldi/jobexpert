<?php
	include 'header.php';
	$usuario = $_GET['id_usuario'];
	$solicitacao = $_GET['id_solicitacao'];
	$sql = "insert into jobexpert.interessados_solicitacao (prestador_id, solicitacao_id) values (".$usuario.", ".$solicitacao.");";
	$res = mysql_query($sql);
	if($res == 1){
		echo 1;
	}else{
		echo 0;
	}
?>