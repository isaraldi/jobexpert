<?php 
	include 'header.php';
	date_default_timezone_set('America/Sao_Paulo');
	$dados = $_GET['dados'];
	$dados = json_decode($dados);
	$sql = "insert into jobexpert.mensagens (mensagem, data, conversa_id, enviou_id) values ('".$dados->mensagem."', '".date("Y-m-d H:i:s")."', ".$dados->id_conversa.", ".$dados->id_usuario.");";
	//echo $sql;
	$res = mysql_query($sql);



	
	if($res == 1){
		echo 1;
	}else{
		echo $sql;
	}
?>