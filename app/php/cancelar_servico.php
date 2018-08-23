<?php
	include 'header.php';
	$id_solicitacao = $_GET['id_solicitacao'];
	$sql = "update jobexpert.solicitacao set prestador_id = 0 where id_solicitacao = ".$id_solicitacao.";";
	$res = mysql_query($sql);
	if($res == true){
		echo 1;	
	}else{
		echo 0;
	}
?>
