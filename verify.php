<?php
$access_token = 'N/gJOEKBTBlgJ9VVXWakLrWgGGB31Rpn1FJ4gWqCzW4p5/ZCfCVl/7wx0IUlEu5mdza0AoHnL/sSjruIu9d6fyRXo008ty2kvqKGW60hvfa8oPtBXywlxLinfI/bGZWjQQ3GauItv80x93Pehic7hgdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
