<?php   
    include "header.php";   
    $dados = $_GET['dados'];
    $dados = json_decode($dados);
            
    $sql = "update 
                jobexpert.usuarios
            set            
                nome_usuario = '".mysql_real_escape_string($dados->nome)."',
                email = '".mysql_real_escape_string($dados->email)."',
                senha = '".mysql_real_escape_string($dados->senha)."'
            where 
                id_usuario = ".mysql_real_escape_string($dados->id_usuario).";";
    $res = mysql_query(utf8_decode($sql));
    if($res == true){
        echo 1;
    }else{
        echo 0;
    }   
    mysql_close();
?>