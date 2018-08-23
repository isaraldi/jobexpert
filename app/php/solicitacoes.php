<?php
	include 'header.php';
	$usuario = $_GET['id_usuario'];
	$sql2 = "select servico_id, cidade_prestador.cidade_id from jobexpert.servico_prestador inner join jobexpert.prestador on jobexpert.servico_prestador.prestador_id = jobexpert.prestador.id_prestador inner join jobexpert.cidade_prestador on jobexpert.cidade_prestador.prestador_id = jobexpert.prestador.id_prestador where cidade_prestador.prestador_id = $usuario;";
	$res2 = mysql_query($sql2);

	for($i = 0 ; $i < mysql_num_rows($res2) ; $i++){
		$row2 = mysql_fetch_row($res2);
		$sql = "select cidade_id, id_solicitacao, descricao from jobexpert.solicitacao where prestador_id = 0 and servico_id_soli = ".$row2[0]." and cidade_id = ".$row2[1]." and recusado = 0;";
		//echo $sql;
		$res = mysql_query($sql);
		for($i1 = 0 ; $i1 < mysql_num_rows($res) ; $i1++){
			$row = mysql_fetch_row($res);

			$sql4 = "select * from jobexpert.interessados_solicitacao where solicitacao_id = ".$row[1]." and prestador_id = ".$usuario.";";
			$res4 = mysql_query($sql4);

			if(mysql_num_rows($res4) == 0){
				
				$sql1 = "select nome from jobexpert.cidades where id = ".$row[0].";";
				$res1 = mysql_query($sql1);
				$row1 = mysql_fetch_row($res1);

				$sql3 = "select nome_servico from jobexpert.servico where id_servico = ".$row2[0].";";
				$res3 = mysql_query($sql3);
				$row3 = mysql_fetch_row($res3);
				$html .= "
					<!-- START LIST ITEM -->
			        <div style='
			            width: 90vw;
			            background-color: rgba(40, 63, 101,0);
			            min-height: 255px;
			            margin-top: 6vw;
			            text-decoration: none;
			            color: #000;
			            letter-spacing: 0px;
			            padding-top: 5px;
			            padding-bottom: 25px;
			            border: 1px solid rgba(255,255,255,.5);
			            border-radius: 8px;
			        '>
			            <div style='
			                width: 90vw;
			                /*margin-left: 3vw;*/
			                float: left;
			            '>
			                <div style='
			                    width: 90vw;
			                    height: 20px;
			                    margin-top: 25px;
			                    display: block;
			                    text-align: center;
			                    '>
			                    <span style='
			                        font-family: \"Open Sans\";
			                        font-size: 16px;
			                        color: #fff;
			                        display: inline-block;
			                    '>Solicitação #".$row[1]."
			                    </span>
			                </div>
			                <div style='
			                    margin-top: 0px;
			                    width: 90vw;
			                    height: 35px;
			                    line-height: 35px;
			                    display: block;
			                    text-align: center;
			                    /*border-bottom: 1px dashed rgba(255,255,255,0.4);*/
			                    '>
			                    <span style='
			                        font-family: \"Open Sans\";
			                        font-size: 12px;
			                        color: rgba(255,255,255,.8);
			                        line-height: 35px;
			                        height: 35px;
			                        display: inline-block;
			                    '>".utf8_encode($row3[0])." em ".utf8_encode($row1[0])."
			                    </span>
			                </div>
			                <div style='
			                    margin-top: 0px;
			                    width: 90vw;
			                    display: block;
			                    text-align: center;
			                    /*border-bottom: 1px dashed rgba(255,255,255,0.4);*/
			                    '>
			                    <span style='
			                        font-family: \"Open Sans\";
			                        font-size: 12px;
			                        color: rgba(255,255,255,.8);
			                        display: inline-block;
			                    '>".utf8_encode($row[2])."
			                    </span>
			                </div>

			                <div onclick='aceitarSolicitacao(".$row[1].")' style='
			                	margin-top: 15px;
			                    background-color: rgba(40, 63, 101,0);
			                    width: 90vw;
			                    height: 50px;
			                    float: left;
			                    display: block;
			                    text-align: center;
			                    '>
			                    <span style='
			                        font-family: \"Open Sans\";
			                        background-color: #d5dadc;
			                        font-size: 15px;
			                        margin-top: 10px;
			                        color: #121b21;
			                        line-height: 50px;
			                        height: 50px;
			                        display: inline-block;
			                        letter-spacing: 0px;
			                        border-radius: 8px;
	                                /*border: 1px solid rgba(255,255,255,.5);*/
			                        width: 60vw;
			                    '>Aceitar serviço
			                    </span>
			                </div>
			                <div onclick='recusarServico($row[1])' style='
			                    background-color: rgba(40, 63, 101,0);
			                    width: 90vw;
			                    height: 50px;
			                    float: left;
			                    display: block;
			                    text-align: center;
			                    margin-top: 30px;
			                    '>
			                    <span style='
			                        font-family: \"Open Sans\";
			                        background-color: #d5dadc;
			                        font-size: 15px;
			                        color: #121b21;
			                        line-height: 50px;
			                        height: 50px;
			                        display: inline-block;
			                        letter-spacing: 0px;
			                        border-radius: 8px;
	                                /*border: 1px solid rgba(255,255,255,.5);*/
			                        width: 60vw;
			                    '>Recusar serviço
			                    </span>
			                </div>
			            </div>
			        </div>
			        <!-- END LIST ITEM -->
				";
			}
		}
	}
	echo $html;
?>