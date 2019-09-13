<?php
    $data = array(
        'username' => 'tecadmin',
        'password' => '012345678'
    );
    $payload = json_encode($data);

    //prepare a new cURL resource
    $ch = curl_init('hhtp://127.0.0.1:81/hlms/rest/authApi2.php');
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true );
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POST, true );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    //set HTTP header for  POST request
     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
         "content-Type: application/json",
         //'content-Length : .strlen($payload)'
     ));

     //Submit the post request 
     $result = curl_exec($ch);

     //close curl session handle
     curl_close($ch);
?>

