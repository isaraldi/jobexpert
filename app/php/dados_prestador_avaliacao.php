<?php
	include 'header.php';
	$id_solicitacao = $_GET['id_solicitacao'];
	$sql = "select nome_prestador, id_solicitacao from jobexpert.solicitacao inner join jobexpert.prestador on jobexpert.solicitacao.prestador_id = jobexpert.prestador.id_prestador where id_solicitacao = ".$id_solicitacao.";";
	$res = mysql_query($sql);
	$row = mysql_fetch_row($res);
	echo "#".$row[1]." - ".utf8_encode($row[0]);
?>