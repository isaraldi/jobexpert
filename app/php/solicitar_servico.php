<?php
	date_default_timezone_set('America/Sao_Paulo');
	include 'header.php';
	$servico = $_GET['id_servico'];
	$sql = "insert into jobexpert.solicitacao (servico_id_soli, data_solicitacao) values (".$servico.", '".date("Y-m-d H:i:s")."');";
	//echo $sql;
	$res = mysql_query($sql);
	if($res == true){
		echo mysql_insert_id();
	}else{
		echo 0;
	}
?>