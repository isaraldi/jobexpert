<?php
	date_default_timezone_set('America/Sao_Paulo');
	include "header.php";	
	$nome = $_GET['dados'];
	$dados = json_decode($nome);

	$sql3 = "select id_usuario from jobexpert.usuarios where email='".$dados->email."';";	
	$res3 = mysql_query($sql3);
	$sql4 = "select id_prestador from jobexpert.prestador where email_prestador='".$dados->email."';";	
	$res4 = mysql_query($sql4);
	if(mysql_num_rows($res3) > 0 || mysql_num_rows($res4) > 0){
		echo -2;
		
	}else{
		$sql = "insert into jobexpert.usuarios
				(nome_usuario, email, cpf, senha, data_cadastro, data_acesso, gcm_key)
			values(
				'".mysql_real_escape_string($dados->nome)."',
			  	'".mysql_real_escape_string($dados->email)."',
			  	'".mysql_real_escape_string($dados->cpf)."',
			  	'".mysql_real_escape_string($dados->senha)."',			  	
			  	'".date("Y-m-d H:i:s")."',
			  	'".date("Y-m-d H:i:s")."',
			  	'".mysql_real_escape_string($dados->gcm)."'
			);";
		$res = mysql_query(utf8_decode($sql));
		//echo $sql;
		if(mysql_errno()==1062){
			echo -1;
			exit(0);
		}
		if($res == true){
			echo mysql_insert_id();
		}else{
			echo 0;
		}	
		mysql_close();
	}
?>