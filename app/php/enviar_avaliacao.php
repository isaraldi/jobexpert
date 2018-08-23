<?php
	include 'header.php';
	$id_solicitacao = $_GET['id_solicitacao'];
	$avaliacao = $_GET['avaliacao'];
	$comentario = $_GET['comentario'];
	$status = $_GET['status'];

	//echo $status;

	if($status == 2){
		$sql = "select usuario_id from jobexpert.solicitacao where id_solicitacao = ".$id_solicitacao.";";
		$tabela = "usuario_id";
	}else{
		$sql = "select prestador_id from jobexpert.solicitacao where id_solicitacao = ".$id_solicitacao.";";
		$tabela = "prestador_id";
	}

	$res = mysql_query($sql);
	$row = mysql_fetch_row($res);

	$sql1 = "insert into jobexpert.avaliacoes (nota, comentario, ".$tabela.", solicitacao_id) values (".$avaliacao.", '".$comentario."', ".$row[0].", ".$id_solicitacao.");";
	$res1 = mysql_query($sql1);
	if($res1 == true){
		if($status == 1){
			$sql2 = "update jobexpert.solicitacao set avaliado = 1 where id_solicitacao = ".$id_solicitacao.";";
			$res2 = mysql_query($sql2);
			if($res2 == true){
				echo 1;
			}
		}else{
			echo 1;
		}
		
	}else{
		echo 0;
	}
?>