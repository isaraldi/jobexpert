<?php
	include 'header.php';
	$solicitacao = $_GET['id_solicitacao'];
	$sql = "update jobexpert.solicitacao set prestador_id = 0 where id_solicitacao = ".$solicitacao.";";
	$res = mysql_query($sql);
	$sql2 = "delete from jobexpert.conversas where solicitacao_id = ".$solicitacao.";";
	$res2 = mysql_query($sql2);
	if($res == 1 && $res2 == 1){
		echo 1;
	}else{
		echo 0;
	}
?>