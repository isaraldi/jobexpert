<?php
	date_default_timezone_set('America/Sao_Paulo');
	include "header.php";
	$nome = $_GET['dados'];
	$foto = $_GET['imagem'];
	$gcm = $_GET['gcm'];
	$dados = json_decode(utf8_encode($nome));
			
	$sql = "insert into jobexpert.usuarios
				(nome_usuario,email,senha,data_cadastro,data_acesso,foto_usuario,gcm_key)
			values(
				'".mysql_real_escape_string($dados->name)."',
				'".mysql_real_escape_string($dados->email)."',
				'',
				'".date("Y-m-d H:i:s")."',
				'".date("Y-m-d H:i:s")."',
				'".$foto."',
				'".$gcm."'
			);";		
	$res = mysql_query(utf8_decode($sql));
	if(mysql_errno()==1062){
		$sql1 = "select id_usuario from jobexpert.usuarios where email = '".$dados->email."'";
		$res1 = mysql_query(utf8_decode($sql1));
		if($res1 == true){
			if(mysql_num_rows($res1)>0){
				$row = mysql_fetch_row($res1);
				$sql2 = "update jobexpert.usuarios set data_acesso='".date("Y-m-d H:i:s")."', gcm_key ='$gcm' where id_usuario = ".$row[0];
				$res2 = mysql_query(utf8_decode($sql2));
				if($res2 == true){				
					echo $row[0];
				}
			}
		}
		exit(0);
	}
	if($res == true){
		echo mysql_insert_id();
	}else{
		echo 0;
	}	
	mysql_close();
?>