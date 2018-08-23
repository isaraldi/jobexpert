<?php
	include 'header.php';
	$id_solicitacao = $_GET['id_solicitacao'];
	$sql = "delete from jobexpert.solicitacao where id_solicitacao = ".$id_solicitacao.";";
	//echo $sql;
	$res = mysql_query($sql);
	if($res == true){
		echo 1;	
	}else{
		echo 0;
	}
?>
