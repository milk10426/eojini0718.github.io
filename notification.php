<?php
    $headers = array(
        "content-type: application/json",
        "Authorization: key=AAAAsf6n8Lo:APA91bGNyCYJCHiSIQj8KL9aiZUm7aaCqzhovlITiEhXgmBWbbM7tD966Qy7NqRsj6pGxdA_nEhDcsA5PMi95OizRvNy3xMtAvnsJsQRXI0tvE70zwarsTSX-XaGBzsa84gFG_JEVZFV"
    );
    $url = "https://fcm.googleapis.com/fcm/send";
    $arr = array();
    $arr["data"]["notification"]["title"] = $_POST['data'];
    $arr["data"]["notification"]["body"] = "";
    $arr["to"] = $_POST['device_code'];
    $data = json_encode($arr);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); //POST방식 
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($ch);
    echo $response;

?>