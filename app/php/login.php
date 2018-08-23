<?php
	date_default_timezone_set('America/Sao_Paulo');
	include "header.php";
	$email = $_GET['email'];
	$senha = $_GET['senha'];
	$gcm = $_GET['gcm'];
	
	$vet = array();	
	$sql = "select id_usuario, verificado from jobexpert.usuarios where email='".$email."' and senha='".$senha."';";	
	$res = mysql_query($sql);
	if(mysql_num_rows($res) > 0){
		for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
			if($row[1] == 0){
				$vet['id'] = -1;
				$vet['status'] = 0;
				echo json_encode($vet);
				exit(0);
			}
			$row = mysql_fetch_row($res);
			$sql1 = "update jobexpert.usuarios set data_acesso='".date("Y-m-d H:i:s")."', gcm_key = '$gcm'  where id_usuario=".$row[0];
			$res1 = mysql_query($sql1);			
			$vet['id'] = $row[0];
			$vet['status'] = 1;
			echo json_encode($vet);
		}
	}else{
		$sql2 = "select id_prestador, verificado from jobexpert.prestador where email_prestador='".$email."' and senha_prestador='".$senha."';";	
		$res2 = mysql_query($sql2);
		if(mysql_num_rows($res2) > 0){
			if($row[1] == 0){
				$vet['id'] = -1;
				$vet['status'] = 0;
				echo json_encode($vet);
				exit(0);
			}
			for($i1 = 0 ; $i1 < mysql_num_rows($res2) ; $i1++){
				$row1 = mysql_fetch_row($res2);
				$sql3 = "update jobexpert.prestador set data_acesso='".date("Y-m-d H:i:s")."', gcm_key = '$gcm' where id_prestador=".$row1[0]; 
				$res3 = mysql_query($sql13);			
				$vet['id'] = $row1[0];
				$vet['status'] = 2;
				echo json_encode($vet);
			}
		}else{
			$vet['id'] = 0;
			$vet['status'] = 0;
			echo json_encode($vet);
		}
	}
	mysql_close();
?>
