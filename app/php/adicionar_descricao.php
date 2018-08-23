<?php
	include 'header.php';
	$descricao = $_GET['descricao'];
	$id_solicitacao = $_GET['id_solicitacao'];
	$sql = "update jobexpert.solicitacao set descricao = '".utf8_decode($descricao)."' where id_solicitacao = ".$id_solicitacao.";";
	$res = mysql_query($sql);
	echo $sql;
	if($res == true){
		echo 1;
	}else{
		echo 0;
	}
?>