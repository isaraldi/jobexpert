<?php
	date_default_timezone_set('America/Sao_Paulo');
	include "header.php";	
	$nome = $_GET['dados'];
	$dados = json_decode($nome);
			
	$sql = "insert into jobexpert.prestador
				(nome_prestador, cpf , email_prestador, senha_prestador, data_cadastro, data_acesso, gcm_key)
			values(
				'".$dados->nome."',
			  	'".$dados->doc."',
			  	'".$dados->email."',
			  	'".$dados->senha."',
			  	'".date("Y-m-d H:i:s")."',
			  	'".date("Y-m-d H:i:s")."',
			  	'".$dados->gcm."'
			);";	
			//echo $sql;
	$res = mysql_query(utf8_decode($sql));
	if(mysql_errno()==1062){
		$sql1 = "select cpf, email_prestador from jobexpert.prestador";
		$res1 = mysql_query($sql1);
		for($i = 0 ; $i < mysql_num_rows($res1) ; $i++){
			$row1 = mysql_fetch_row($res1);
			if($dados->doc == $row1[0]){
				echo -1;
				exit(0);
			}else if($dados->email == $row1[1]){
				echo -2;
				exit(0);
			}
		}
		
	}
	if($res == true){
		echo mysql_insert_id();

		$prestador = mysql_insert_id();
		$servicos = $_GET['servicos'];
		$servicos = explode(",", $servicos);

		if($servicos[0] == ""){
			for($i = 1 ; $i < count($servicos) ; $i++){
				$sql1 = "insert into jobexpert.servico_prestador (prestador_id, servico_id) values (".$prestador.", ".$servicos[$i].");";
				$res1 = mysql_query($sql1);
				
			}
		}else{
			for($i = 0 ; $i < count($servicos) ; $i++){
				$sql1 = "insert into jobexpert.servico_prestador (prestador_id, servico_id) values (".$prestador.", ".$servicos[$i].");";
				$res1 = mysql_query($sql1);
				
			}
		}
	}else{
		echo 0;
	}	
	mysql_close();
?>