<?php
$access_token = 'N/gJOEKBTBlgJ9VVXWakLrWgGGB31Rpn1FJ4gWqCzW4p5/ZCfCVl/7wx0IUlEu5mdza0AoHnL/sSjruIu9d6fyRXo008ty2kvqKGW60hvfa8oPtBXywlxLinfI/bGZWjQQ3GauItv80x93Pehic7hgdB04t89/1O/w1cDnyilFU=';

$proxy = 'http://fixie:7L2IiwTyTAtekGS@velodrome.usefixie.com:80';
$proxyauth = 'panya.spcom@gmail.com:Panya@97';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			
			
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			
			curl_setopt($ch, CURLOPT_PROXY, $proxy);
			curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
			
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
			
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '00d355b7517eead664dd766943265264']);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
$response = $bot->replyMessage($replyToken, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();			
			echo "======" . "\r\n";
			
		}
	}
}
echo "OK";
