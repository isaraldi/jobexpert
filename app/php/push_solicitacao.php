<?php
    include "header.php";
    $title = $_GET['titulo'];
    $message = $_GET['mensagem'];
    $solicitacao = $_GET['solicitacao'];

    $sql = "select servico_id_soli from jobexpert.solicitacao where id_solicitacao = $solicitacao";
    $res = mysql_query($sql);
    $row = mysql_fetch_row($res);

    $sql1 = "select gcm_key from jobexpert.prestador inner join jobexpert.servico_prestador on jobexpert.prestador.id_prestador = jobexpert.servico_prestador.prestador_id where servico_id = $row[0]";
    echo $sql1;
    $res1 = mysql_query($sql1);
    
    for($i = 0 ; $i < mysql_num_rows($res1) ; $i++){
        $row1 = mysql_fetch_row($res1);
        $to = $row1[0];
        sendPush($to,$title,$message);
    }

    // $to="e_VKXsMyUIU:APA91bG0xERQ0kty3QqJTNC1yiLnzCnPH7nGr7j-zphZ9r0a9HU7ZfJqBEQuTxS0FSbXhKuqDJIn8zjig3RaNScAbzHpYLGbGtaTFM8p9zkK5d-lOYA2_rTtdA6dlQexAFVTUVFfvp70";
    // $title="Push Notification Title";
    // $message="Push Notification Message";
    //sendPush($to,$title,$message);

    function sendPush($to,$title,$message)
    {
    // API access key from Google API's Console
        // replace API
        define( 'API_ACCESS_KEY', 'AIzaSyCQcGLzDn8vFY4X-XlAlZGEzA67M8ztaRg');
        $registrationIds = array($to);
        $msg = array
        (
            'message' => $message,
            'title' => $title,
            'vibrate' => 1,
            'sound' => 1

        // you can also add images, additionalData
        );

        $fields = array
        (
            'registration_ids' => $registrationIds,
            'data' => $msg
        );

        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );
        
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        echo $result;
    }
?>