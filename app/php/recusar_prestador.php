<?php
	include 'header.php';
	$prestador = $_GET['id_prestador'];
	$solicitacao = $_GET['id_solicitacao'];

	$sql = "update jobexpert.interessados_solicitacao set recusado = 1 where solicitacao_id = ".$solicitacao." and prestador_id = $prestador;";
	$res = mysql_query($sql);

	if($res == 1){
		echo 1;
	}else{
		echo 0;
	}
?>