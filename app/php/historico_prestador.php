<?php
	setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
	include 'header.php';
	$usuario = $_GET['id_usuario'];

    $sql2 = "select solicitacao_id from interessados_solicitacao where prestador_id = ".$usuario." order by solicitacao_id desc;";
    $res2 = mysql_query($sql2);        

    if(mysql_num_rows($res2) > 0){
        for($i1 = 0 ; $i2 < mysql_num_rows($res2) ; $i2++){
            $row2 = mysql_fetch_row($res2);

            $sql3 = "select usuario_id, date_format(data_solicitacao,'%Y-%m-%d'), servico_id_soli, cidade_id from jobexpert.solicitacao where id_solicitacao = ".$row2[0]." order by data_solicitacao desc;";
            $res3 = mysql_query($sql3);
            $row3 = mysql_fetch_row($res3);

            $data = strftime("Dia %d de %B de %Y",strtotime($row3[1]));
            $sql1 = "select nome_usuario from jobexpert.usuarios where id_usuario = ".$row3[0].";";
            $res1 = mysql_query($sql1);
            $row1 = mysql_fetch_row($res1);

            $html .= "
                <div style='
                    width: 90vw;
                    background-color: rgba(40, 63, 101,0);
                    height: 325px;
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
                            '>Solicitação #".$row2[0]."
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
                            '>Esperando resposta
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
                        <div onclick='popup5(".$row2[0].", ".$row3[2].", ".$row3[3].", 2)' style='
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
                        <div onclick='cancelarServicoInteressado(".$row2[0].", ".$usuario.")' style='
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
        }
    }


	$sql = "select concluido, usuario_id, date_format(data_solicitacao,'%Y-%m-%d'), id_solicitacao, servico_id_soli, cidade_id from jobexpert.solicitacao where prestador_id = ".$usuario." order by id_solicitacao desc;";
	$res = mysql_query($sql);

    	for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
    		$row = mysql_fetch_row($res);
    		$data = strftime("Dia %d de %B de %Y",strtotime($row[2]));

    		$sql1 = "select nome_usuario from jobexpert.usuarios where id_usuario = ".$row[1].";";
    		$res1 = mysql_query($sql1);
    		$row1 = mysql_fetch_row($res1);
    		if($row[0] == 0){    
    	   		$html .= "
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
                            <div onclick='popup5(".$row[3].", ".$row[4].", ".$row[5].", 2)' style='
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
                            <div onclick='finalizarServico(".$row[3].")' style='
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
                                '>Finalizar serviço
                                </span>
                            </div>
                            <div onclick='cancelarServicoAceito(".$row[3].")' style='
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
    	   	}else{
    	   		$html .= "
    	   			<!-- START LIST ITEM -->
                    <div style='
                        width: 90vw;
                        background-color: rgba(40, 63, 101,0);
                        height: 225px;
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
                            <div onclick='apagarSolicitacao(".$row[3].")' style='
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