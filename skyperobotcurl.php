<!DOCTYPE html>
       <head><meta http-equiv="Content-Type" content="text/html;charset=utf8">

       <html lang="en">

<?php

function curl0($url){
// $data = "{'con' : $b}";

$data =  "ymd = 2017-05-01";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL,$url);
// curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);


curl_setopt($curl, CURLOPT_TIMEOUT, 20);
// curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

$output = curl_exec($curl);

curl_close($curl);

if($output != ''){
       return "傳送已成功";
}else{
       return "傳送已失敗";
}



}



function sendMessage($content){
// $dbc = array(
// '　' , ' ' ,'；',
// '．' , '，' , '／' , '％' , '＃' ,
// '！' , '＠' , '＆' , 
// '＜' , '＞' , '＂' , '＇' , '？' ,
// '［' , '］' , '｛' , '｝' , '＼' ,
// '｜' , '＋' , '＝' , '＾' ,
// '￥' ,'｀'
// );
// $sbc = array( //半形
// ' ', ':',';',
// '.', ',', '/', '%', ' #',
// '!', '@', '&', 
// '<', '>', '"', '\'','?',
// '[', ']', '{', '}', '\\',
// '|', ' ', '=', '^',
// '￥', '`'
// );


// $a=str_replace( $sbc, $dbc, $content);

$b = urlencode($content);

$url = "https://testweb2-9a03.azurewebsites.net/api/notify?year=".$b;

//echo $b;

echo curl0($url);

}

?>
