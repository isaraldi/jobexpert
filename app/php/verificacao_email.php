<?php 
	date_default_timezone_set('America/Sao_Paulo');
	include "header.php";

	//Variáveis
	$id_prestador = $_GET['id_prestador'];
	$id_usuario = $_GET['id_usuario'];
	$data_envio = date('d/m/Y');
	$hora_envio = date('H:i:s');

	if($id_usuario != ""){
		$sql = "select email from jobexpert.usuarios where id_usuario = $id_usuario";
		$url = "https://www.jobexpert.com.br/app/php/email_verificado.php?id_usuario=$id_usuario";
	}else if($id_prestador != ""){
		$sql = "select email_prestador from jobexpert.prestador where id_prestador = $id_prestador";
		$url = "https://www.jobexpert.com.br/app/php/email_verificado.php?id_prestador=$id_prestador";
	}
	
	$res = mysql_query($sql);
	$row = mysql_fetch_row($res);

	// Compo E-mail
	$arquivo = "
		
				Clique <a href='$url'>aqui</a> para verificar
			
	";
	//enviar
	
	 // emails para quem será enviado o formulário
	$destino = "isaraldi_15@hotmail.com";
	$assunto = "Verificação Job Expert";

	// É necessário indicar que o formato do e-mail é html
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= 'From: Job Expert <jobexpert@jobexpert.com.br>';
	//$headers .= "Bcc: $EmailPadrao\r\n";

	$enviaremail = mail($destino, $assunto, $arquivo, $headers);
	if($enviaremail){
		echo 1;
	} else {
		echo 0;
	}

?>