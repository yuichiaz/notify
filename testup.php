<?php
define('LINE_API_URL'  ,"https://notify-api.line.me/api/notify");
define('LINE_API_TOKEN','wshV2INzMCHb2nrCe58O5dNgtmiOLNsrOhR0yvIlH4S');    // 「ACCESS_TOKEN」を取得したアクセストークンに置き換える
function post_message($message){
    $data = array("message" => $message);
    $data = http_build_query($data, "", "&");
    
    
    $options = array('http'=> array(
                                'method'=>'POST',
                                'header'=>"Authorization: Bearer " .
                                LINE_API_TOKEN . 
                                "\r\n".
                                "Content-Type: application/x-www-form-urlencoded\r\n". 
                                "Content-Length: ".
                                strlen($data) .
                                "\r\n" ,'content' => $data
                              )
        
                );
    $context = stream_context_create($options);
    $resultJson = file_get_contents(LINE_API_URL,FALSE,$context );
    $resutlArray = json_decode($resultJson,TRUE);
    if( $resutlArray['status'] != 200)  {
        return false;
    }
    return true;
}
post_message("こんにちわんこ");  // 送信されるメッセージ本文
