<?php
	include 'header.php';
	$cidade = $_GET['cidade'];
	$estado = $_GET['estado'];
	$id_solicitacao = $_GET['id_solicitacao'];
	$sql = "update jobexpert.solicitacao set cidade_id = ".$cidade.", estado_id = ".$estado." where id_solicitacao = ".$id_solicitacao.";";
	$res = mysql_query($sql);
	echo $sql;
	if($res == true){
		echo 1;
	}else{
		echo 0;
	}
?>