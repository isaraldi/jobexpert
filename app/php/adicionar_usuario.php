<?php
	include 'header.php';
	$usuario = $_GET['usuario'];
	$id_solicitacao = $_GET['id_solicitacao'];
	$sql = "update jobexpert.solicitacao set usuario_id = ".$usuario." where id_solicitacao = ".$id_solicitacao.";";
	$res = mysql_query($sql);
	if($res == true){
		echo 1;
	}else{
		echo 0;
	}
?>