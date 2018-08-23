<?php
	include 'header.php';
	$id_conversa = $_GET['id_conversa'];
	$id_usuario = $_GET['id_usuario'];
	
	$sql = "SELECT mensagem, enviou_id FROM jobexpert.mensagens where conversa_id = ".$id_conversa.";";
	$res = mysql_query($sql);
	for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
		$row = mysql_fetch_row($res);
		if($id_usuario == $row[1]){
			$html .= "
				<div style='width: 100vw;min-height: 44px;margin-top: 3px;'>
					<div style='
		                max-width: 60vw;
	                    min-width: 20vw;
	                    border: 1px solid rgba(255,255,255,.4);
	                    border-radius: 8px;
	                    padding: 10px;
	                    float: right;
	                    margin-right: 10px;
	                    text-align: left;
		            '>".$row[0]."
		            </div>
		        </div>
		        
			";
		}else{
			$html .= "
				<div style='width: 100vw;min-height: 44px;margin-top: 3px;'>
					<div style='
	                    max-width: 60vw;
                        min-width: 20vw;
                        border: 1px solid rgba(0,0,0,.4);
                        border-radius: 8px;
                        padding: 10px;
                        float: left;
                        margin-left: 10px;
                        text-align: right;
	                '>".$row[0]."
	                </div>
	            </div>
	            
			";
		}
	}
	echo $html;
?>