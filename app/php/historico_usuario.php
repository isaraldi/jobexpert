<?php
	setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
	include 'header.php';
	$usuario = $_GET['id_usuario'];
	$sql = "select concluido, prestador_id, date_format(data_solicitacao,'%Y-%m-%d'), id_solicitacao, servico_id_soli, cidade_id from jobexpert.solicitacao where usuario_id = ".$usuario." order by data_solicitacao desc;";
	$res = mysql_query($sql);
	for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
		$row = mysql_fetch_row($res);
		$data = strftime("Dia %d de %B de %Y",strtotime($row[2]));
		
		if($row[0] == 0){
			if($row[1] == 0 || $row[1] == null){
				$html .= "
					<!-- START ITEM LIST -->
			        <div style='
			            width: 90vw;
			            background-color: rgba(40, 63, 101,0);
			            height: 335px;
			            margin-top: 6vw;
			            text-decoration: none;
			            color: #000;
			            letter-spacing: 0px;
			            padding-top: 5px;
			            padding-bottom: 5px;
			            border: 1px solid rgba(255,255,255,.5);
                        border-radius: 8px;
			        '>			
			            <div style='
			                width: 90vw;
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
                                '>Solicitação #".$row[3]."
                                </span>
                            </div>
			                <div style='
                                margin-top: 0px;
                                width: 90vw;
                                height: 35px;
                                line-height: 35px;
                                display: block;
                                text-align: center;
                                '>
                                <span style='
                                    font-family: \"Open Sans\";
                                    font-size: 12px;
                                    color: rgba(255,255,255,.8);
                                    line-height: 35px;
                                    height: 35px;
                                    display: inline-block;
                                '>Aguardando prestador
                                </span>
                            </div>
			                <div style='
			                    margin-top: 0px;
			                    width: 90vw;
			                    height: 35px;
			                    line-height: 35px;
			                    display: block;
			                    text-align: center;
			                    '>
			                    <span style='
			                        font-family: \"Open Sans\";
			                        font-size: 12px;
			                        color: rgba(255,255,255,.8);
			                        line-height: 35px;
			                        height: 35px;
			                        display: inline-block;
			                    '>".$data."
			                    </span>
			                </div>
                            <div onclick=\"location.href='interessados.html?id_solicitacao=".$row[3]."';\" style='
                                background-color: rgba(40, 63, 101,0);
                                width: 90vw;
                                height: 50px;
                                float: left;
                                display: block;
                                text-align: center;
                                margin-top: 10px;
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
                                '>Ver interessados
                                </span>
                            </div>
			                <div onclick='popup5(".$row[3].", ".$row[4].", ".$row[5].", 1)' style='
			                    margin-top: 10px;
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
			                    '>Ver detalhes
			                    </span>
			                </div>
			                <div onclick='cancelarSolicitacao(".$row[3].")' style='
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
			                    '>Cancelar serviço
			                    </span>
			                </div>
			            </div>
			        </div>
			        <!-- END LIST ITEM -->
		   	 	";
		   	}else{
                $sql1 = "select nome_prestador from jobexpert.prestador where id_prestador = ".$row[1].";";
                $res1 = mysql_query($sql1);
                $row1 = mysql_fetch_row($res1);
		   		$html .= "
		   			<!-- START LIST ITEM -->
                    <div style='
                        width: 90vw;
                        background-color: rgba(40, 63, 101,0);
                        height: 355px;
                        margin-top: 6vw;
                        text-decoration: none;
                        color: #000;
                        letter-spacing: 0px;
                        padding-top: 5px;
                        padding-bottom: 5px;
                        border: 1px solid rgba(255,255,255,.5);
                        border-radius: 8px;
                    '>
                        <div style='
                            width: 90vw;
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
                                '>Solicitação #".$row[3]."
                                </span>
                            </div>
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
                                '>".utf8_encode($row1[0])."
                                </span>
                            </div>
                            <div style='
                                margin-top: 0px;
                                width: 90vw;
                                height: 35px;
                                line-height: 35px;
                                display: block;
                                text-align: center;
                                '>
                                <span style='
                                    font-family: \"Open Sans\";
                                    font-size: 12px;
                                    color: rgba(255,255,255,.8);
                                    line-height: 35px;
                                    height: 35px;
                                    display: inline-block;
                                '>".$data."
                                </span>
                            </div>
                            <div onclick='popup5(".$row[3].", ".$row[4].", ".$row[5].",1)' style='
                                margin-top: 10px;
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
                                '>Ver detalhes
                                </span>
                            </div>
                            <div onclick='solicitarOutroPrestador(".$row[3].")' style='
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
                                '>Solicitar outro prestador
                                </span>
                            </div>
                            <div onclick='cancelarSolicitacao(".$row[3].")' style='
                                background-color: rgba(40, 63, 101,0);
                                width: 90vw;
                                height: 50px;
                                float: left;
                                display: block;
                                text-align: center;
                                margin-top: 20px;
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
                                '>Cancelar serviço
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- END LIST ITEM -->
		   		";
		   	}
	   	}else{
            $sql1 = "select nome_prestador from jobexpert.prestador where id_prestador = ".$row[1].";";
            $res1 = mysql_query($sql1);
            $row1 = mysql_fetch_row($res1);
            
	   		$html .= "
	   			<!-- START LIST ITEM -->
                <div style='
                    width: 90vw;
                    background-color: rgba(40, 63, 101,0);
                    height: 285px;
                    margin-top: 6vw;
                    margin-bottom: 6vw;
                    color: #000;
                    letter-spacing: 0px;
                    padding-top: 5px;
                    padding-bottom: 5px;
                    border:1px solid rgba(255,255,255,.5);
                    border-radius: 8px;
                '>
                    <!-- START ITEM DETAILS -->
                    <div style='
                        width: 90vw;
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
                            '>Solicitação #".$row[3]."
                            </span>
                        </div>
                        <div style='
                            width: 90vw;
                            height: 20px;
                            margin-top: 10px;
                            text-align: center;
                            '>
                            <span style='
                                font-family: \"Open Sans\";
                                font-size: 16px;
                                color: rgba(255,255,255,.5);
                            '>".utf8_encode($row1[0])."
                            </span>
                        </div>
                        <div style='
                            margin-top: 0px;
                            width: 90vw;
                            height: 35px;
                            line-height: 35px;
                            display: block;
                            text-align: center;
                            '>
                            <span style='
                                font-family: \"Open Sans\";
                                font-size: 12px;
                                color: rgba(255,255,255,.5);
                                line-height: 35px;
                                height: 35px;
                                display: inline-block;
                            '>".$data."
                            </span>
                        </div>
                        <div style='
                            margin-top: 0px;
                            width: 90vw;
                            height: 15px;
                            line-height: 15px;
                            display: block;
                            text-align: center;
                            '>
                            <span style='
                                font-family: \"Open Sans\";
                                font-size: 14px;
                                color: rgba(255,255,255,.5);
                                line-height: 15px;
                                height: 15px;
                                display: inline-block;
                            '>Serviço finalizado
                            </span>
                        </div>
                        <div style='
                            background-color: rgba(40, 63, 101,0);
                            width: 90vw;
                            height: 50px;
                            float: left;
                            display: block;
                            text-align: center;
                            margin-top: 20px;
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
                            '>Solicitar prestador
                            </span>
                        </div>
                        <div onclick='apagarSolicitacao(".$row[3].")' style='
                            background-color: rgba(40, 63, 101,0);
                            width: 90vw;
                            height: 50px;
                            float: left;
                            display: block;
                            text-align: center;
                            margin-top: 20px;
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
                            '>Apagar
                            </span>
                        </div>
                    </div>
                </div>
                <!-- END LIST ITEM -->
	   		";
	   	}
	}
	echo $html;
?>