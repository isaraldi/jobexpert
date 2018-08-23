<?php
	include 'header.php';
	$prestador = $_GET['id_prestador'];
	$solicitacao = $_GET['id_solicitacao'];
	$prestador = $_GET['id_prestador'];

	$sql2 = "delete from jobexpert.interessados_solicitacao where solicitacao_id = ".$solicitacao." and prestador_id = ".$prestador.";";
	$res2 = mysql_query($sql2);
	if($res2 == true){
		echo 1;
	}else{
		echo 2;
	}
?>