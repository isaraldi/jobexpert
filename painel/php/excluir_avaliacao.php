<?php
	include "header.php";
	$id = $_GET['id_avaliacao'];
	$sql = "delete from jobexpert.avaliacoes where id_avaliacao = ".$id.";";
	$res = mysql_query($sql);
	if($res == true){
		echo 1;
	}else{
		echo 0;
	}
?>