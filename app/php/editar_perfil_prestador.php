<?php   
    include "header.php";   
    $dados = $_GET['dados'];
    $dados = json_decode($dados);
    
    if($dados->senhaNova == ""){    
        $sql = "update 
                    jobexpert.prestador
                set            
                    nome_prestador = '".mysql_real_escape_string($dados->nome)."',
                    email_prestador = '".mysql_real_escape_string($dados->email)."'
                where 
                    id_prestador = ".mysql_real_escape_string($dados->id_usuario).";";
    }else{
        $sql = "update 
                jobexpert.prestador
            set            
                nome_prestador = '".mysql_real_escape_string($dados->nome)."',
                email_prestador = '".mysql_real_escape_string($dados->email)."',
                senha_prestador = '".mysql_real_escape_string($dados->senhaNova)."'
            where 
                id_prestador = ".mysql_real_escape_string($dados->id_usuario).";";
    }
    $res = mysql_query(utf8_decode($sql));
    if($res == true){
        $sql2 = "delete from jobexpert.servico_prestador where prestador_id = $dados->id_usuario";
        $res2 = mysql_query($sql2);
        if($res2 == true){
            $servicos = $_GET['servicos'];
            $servicos = explode(",", $servicos);
            if($servicos[0] == ""){
                for($i = 1 ; $i < count($servicos) ; $i++){
                    $sql1 = "insert into jobexpert.servico_prestador (prestador_id, servico_id) values (".$dados->id_usuario.", ".$servicos[$i].");";
                    $res1 = mysql_query($sql1);
                }
            }else{

                for($i = 0 ; $i < count($servicos) ; $i++){
                    $sql1 = "insert into jobexpert.servico_prestador (prestador_id, servico_id) values (".$dados->id_usuario.", ".$servicos[$i].");";
                    $res1 = mysql_query($sql1);
                }
            }
            if($res1 == true){
                echo 1;
            }
        }
        
    }else{
        echo 0;
    }   
    mysql_close();
?>