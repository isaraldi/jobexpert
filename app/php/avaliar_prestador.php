<?php
	include 'header.php';
	$id_usuario = $_GET['id_usuario'];
	$sql = "select concluido, avaliado, id_solicitacao from jobexpert.solicitacao where usuario_id = ".$id_usuario.";";
	$res = mysql_query($sql);
	for($i = 0 ; $i < mysql_num_rows($res) ; $i ++){
		$row = mysql_fetch_row($res);
		if($row[0] == 1 and $row[1] == 0){
			echo $row[2];
			return;
		}
	}
?>