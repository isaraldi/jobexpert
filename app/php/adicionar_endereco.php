<?php
	include 'header.php';
	$rua = $_GET['rua'];
	$numero = $_GET['numero'];
	$complemento = $_GET['complemento'];
	$id_solicitacao = $_GET['id_solicitacao'];
	$sql = "update jobexpert.solicitacao set rua = '".$rua."', numero = '".$numero."', complemento = '".$complemento."' where id_solicitacao = ".$id_solicitacao.";";
	$res = mysql_query($sql);
	echo $sql;
	if($res == true){
		echo 1;
	}else{
		echo 0;
	}
?>