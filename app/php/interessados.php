<?php
    include 'header.php';
    $solicitacao = $_GET['id_solicitacao'];
    $sql = "select 
                rua, numero, complemento, descricao, jobexpert.cidades.nome, nome_servico, sigla, usuario_id
            from 
                jobexpert.solicitacao
            inner join
                jobexpert.estados
            on
                jobexpert.solicitacao.estado_id = jobexpert.estados.id
            inner join
                jobexpert.cidades
            on
                jobexpert.solicitacao.cidade_id = jobexpert.cidades.id
            inner join
                jobexpert.servico
            on
                jobexpert.solicitacao.servico_id_soli = jobexpert.servico.id_servico
            where 
                id_solicitacao = ".$solicitacao.";";
    $res = mysql_query($sql);
    $row = mysql_fetch_row($res);

    $html .= "
            <div class='fundo' style='
                position: absolute;
                top: 60px;
                overflow: auto;
                -webkit-overflow-scrolling: touch;
                width: 100vw;
                height: calc(100% - 60px);
                height: -o-calc(100% - 60px); /* opera */
                height: -webkit-calc(100% - 60px); /* google, safari */
                height: -moz-calc(100% - 60px); /* firefox */
                padding-top: -4px;
            '>
                <p style='
                    font-family: \"Open Sans\";
                    font-size: 16px;
                    /*text-align: left;*/
                    width: 70vw;
                    '>Serviço<br><span style='font-size: 13px;'>".utf8_encode($row[5])."</span>
                </p>
                <p style='
                    font-family: \"Open Sans\";
                    font-size: 16px;
                    width: 70vw;
                    /*text-align: left;*/
                    '>Endereço<br><span style='font-size: 13px;'>Rua ".utf8_encode($row[0]).", N<sup>o</sup> ".$row[1].", ".utf8_encode($row[4]).", ".utf8_encode($row[6]).".</span>
                </p>
                <p style='
                    font-family: \"Open Sans\";
                    font-size: 16px;
                    width: 70vw;
                    /*text-align: left;*/
                    '>Descrição<br><span style='font-size: 13px;'>".utf8_encode($row[3]).".</span>
                </p>";

        $sql1 = "select prestador_id from jobexpert.interessados_solicitacao where solicitacao_id = ".$solicitacao." and recusado = 0;";
        $res1 = mysql_query($sql1);
        if(mysql_num_rows($res1) > 0){
            for($i = 0 ; $i < mysql_num_rows($res1) ; $i++){
                $row1 = mysql_fetch_row($res1);
                $sql2 = "select nome_prestador from jobexpert.prestador where id_prestador = ".$row1[0].";";
                $res2 = mysql_query($sql2);
                $row2 = mysql_fetch_row($res2);

                $sql4 = "select avg(nota) from jobexpert.avaliacoes where prestador_id = ".$row1[0].";";
                $res4 = mysql_query($sql4);
                $row4 = mysql_fetch_row($res4);

                 if($row4[0] >= 3 && $row4[0] < 3.3){
                        $avaliacao = " 
                                        <img src='.\img\star_left.png' style='height: 13px;'>
                                        <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                                        <img src='.\img\star_left.png' style='height: 13px;'>
                                        <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                                        <img src='.\img\star_left.png' style='height: 13px;'>
                                        <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                                    ";
                    }else if($row4[0] >= 3.3 && $row4[0] < 3.8){
                        $avaliacao = " 
                                        <img src='.\img\star_left.png' style='height: 13px;'>
                                        <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                                        <img src='.\img\star_left.png' style='height: 13px;'>
                                        <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                                        <img src='.\img\star_left.png' style='height: 13px;'>
                                        <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                                        <img src='.\img\star_left.png' style='height: 13px;'>
                                    ";
                    }else if($row4[0] >= 3.8 && $row4[0] < 4.3){
                        $avaliacao = " 
                                        <img src='.\img\star_left.png' style='height: 13px;'>
                                        <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                                        <img src='.\img\star_left.png' style='height: 13px;'>
                                        <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                                        <img src='.\img\star_left.png' style='height: 13px;'>
                                        <img src='.\img\star_right.png' style='height: 13px; margin-left: -5px;'>
                                        <img src='.\img\star_left.png' style='height: 13px;'>
                                        <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                                    ";
                    }else if($row4[0] >= 4.3 && $row4[0] < 4.8){
                        $avaliacao = " 
                                        <img src='.\img\star_left.png' style='height: 13px;'>
                                        <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                                        <img src='.\img\star_left.png' style='height: 13px;'>
                                        <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                                        <img src='.\img\star_left.png' style='height: 13px;'>
                                        <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                                        <img src='.\img\star_left.png' style='height: 13px;'>
                                        <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                                        <img src='.\img\star_left.png' style='height: 13px;'>
                                    ";
                    }else if($row4[0] >= 4.8 && $row4[0] <= 5){
                        $avaliacao = " 
                                        <img src='.\img\star_left.png' style='height: 13px;'>
                                        <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                                        <img src='.\img\star_left.png' style='height: 13px;'>
                                        <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                                        <img src='.\img\star_left.png' style='height: 13px;'>
                                        <img src='.\img\star_right.png' style='height: 13px; margin-left: -4.3px;'>
                                        <img src='.\img\star_left.png' style='height: 13px;'>
                                        <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                                        <img src='.\img\star_left.png' style='height: 13px;'>
                                        <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                                    ";
                }
                 
                $html .= "
                    <!-- START ITEM LIST -->
                    <div style='
                        width: 90vw;
                        background-color: rgba(40, 63, 101,0);
                        height: 305px;
                        margin-top: 20px;
                        margin-bottom: 20px;
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
                                '>".utf8_encode($row2[0])."
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
                                    font-size: 13px;
                                    color: rgba(255,255,255,.8);
                                    line-height: 35px;
                                    height: 35px;
                                    display: inline-block;
                                '>".$avaliacao." 
                                </span>
                            </div>
                            <div onclick=\"window.open('detalhes_prestador.html?id_prestador=".$row1[0]."','_self')\" style='
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
                                '>Ver perfil
                                </span>
                            </div>
                            <div onclick='aceitarPrestador(".$row1[0].",".$solicitacao.", ".$row[7].")' style='
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
                                '>Aceitar prestador
                                </span>
                            </div>
                            <div onclick='recusarPrestador(".$row1[0].", ".$solicitacao.")' style='
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
                                '>Recusar prestador
                                </span>
                            </div>
                        </div>
                    </div>
                    ";

            }
        }
    $html .= "</div>";
    echo $html;

?>