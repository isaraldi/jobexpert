<?php
	include 'header.php';
	$id_usuario = $_GET['id_usuario'];
	$id_prestador = $_GET['id_prestador'];
	if($id_usuario != ''){
		$sql = "SELECT nome_prestador, id_conversa, solicitacao_id FROM jobexpert.conversas inner join jobexpert.prestador on jobexpert.conversas.prestador_id = jobexpert.prestador.id_prestador where usuario_id = ".$id_usuario.";";
		//echo $sql;
	}else if($id_prestador != ''){
		$sql = "SELECT nome_usuario, id_conversa, solicitacao_id  FROM jobexpert.conversas inner join jobexpert.usuarios on jobexpert.conversas.usuario_id = jobexpert.usuarios.id_usuario where prestador_id = ".$id_prestador.";";
		//echo $sql;
	}
	
	$res = mysql_query($sql);
	for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
		$row = mysql_fetch_row($res);
		$html .= "
			<div onclick='window.open(\"batepapo.html?id_conversa=".$row[1]."&nome=".utf8_encode($row[0])."\")' style='
                width: 100vw;
                height: 50px;
                line-height: 50px;
                background-color: rgba(255,255,255,0);
                color: #fff;
                border-bottom: 1px solid rgba(255,255,255,.1);
                text-align: left;
            '>
                <span style='
                    margin-left: 15px;
                '>".utf8_encode($row[0])." - #".$row[2]."
                </span>
            </div>
		";
	}
	echo $html;
?>