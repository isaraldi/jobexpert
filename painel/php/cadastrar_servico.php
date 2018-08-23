<?php
	include "header.php";
	$servico = $_GET["servico"];

	$sql = "insert into jobexpert.servico (nome_servico) values ('".utf8_decode($servico)."');";
	$res = mysql_query($sql);
	if($res == true){
		echo 1;
	}else{
		echo $sql;
	}
?>