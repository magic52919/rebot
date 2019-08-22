<?php

$time = date('Y-m-d H:i:s',time()+21600);
$times = date('Y-m-d H:i:s',time()+3300);
$url = 'http://13.115.125.95:1993/api/users/total_amount';
$ch = curl_init($url);
$headers = [
'Content-Type:application/json',
'ekey:mobile',
];

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_setopt($ch,CURLOPT_POSTFIELDS,'{"start_date":"'.$times.'","end_date" : "'.$time.'"}');

$result = curl_exec($ch);
echo $result;


