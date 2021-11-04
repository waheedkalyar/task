<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "worker";

$conn = new mysqli($servername, $username, $password, $database);

function worker($conn){
    $id = 1;
    $ended = false;
    while(!$ended){
        $query = mysqli_query($conn, "SELECT * FROM jobs WHERE ID = '$id'");
        $row = mysqli_fetch_assoc($query);
        if($row){
            if($row['status'] == 'NEW'){
                $status = getStatusCode($row['url']);
                mysqli_query($conn, "UPDATE jobs SET http_code='$status', status='DONE' WHERE id='$id'");
            }
        }else{
            $ended = true;
        }
        $id++;
    }
}

function getStatusCode($url){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_TIMEOUT,10);
    $output = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $httpCode;
}

worker($conn);


