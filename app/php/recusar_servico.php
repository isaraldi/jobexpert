<?php
	include 'header.php';
	$solicitacao = $_GET['id_solicitacao'];

	$sql = "update jobexpert.solicitacao set recusado = 1 where id_solicitacao = ".$solicitacao.";";
	$res = mysql_query($sql);
	if($res == 1){
		echo 1;
	}else{
		echo 0;
	}
?>