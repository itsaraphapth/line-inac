<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = '82RJmA6R8Us7FXuVhejH4foQ9mEwGWdm07S4MUMB3Lf5mANVg01RzLnVIQbeLyGly6AF1Zm1LjUo1XAk1I4fJKT+qRgUwONfQtwN+KxohE+prow+FC7B/JDmctO55d2I7pn2o0lgcLidPVgZr8g0vgdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);

// Validate parsed JSON data
if (!is_null($events['events'])) {
  foreach ($events['events'] as $event) {
	// if ($event['type'] == 'message' && $event['message']['type'] == 'text') {

	//   switch ($message) {
	// 	case 'help':
	// 	  $text = "ฉันคือ ID Finder Bot ยินดีที่ได้รู้จัก";
	// 	  $text .= "\nฉันมีหน้าที่ช่วยคุณค้าหา UserID RoomID หรือ GroupID ให้กับคุณ";
	// 	  $text .= "\nลองพิมพ์ /id ดูซิ";
	// 	  break;
	// 	case 'id':
	// 	  $text = "ข้อมูล ID ของคุณ";
	// 	 // Get text sent
	// 		$text = $event['source']['userId'];
	// 		// Get replyToken
	// 		$replyToken = $event['replyToken'];

	// 		// Build message to reply back
	// 		$messages = [
	// 			'type' => 'text',
	// 			'text' => $text
	// 		];

	// 		// Make a POST Request to Messaging API to reply to sender
	// 		$url = 'https://api.line.me/v2/bot/message/reply';
	// 		$data = [
	// 			'replyToken' => $replyToken,
	// 			'messages' => [$messages],
	// 		];
	// 		$post = json_encode($data);
	// 		$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

	// 		$ch = curl_init($url);
	// 		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// 		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	// 		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	// 		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	// 		$result = curl_exec($ch);
	// 		curl_close($ch);

	// 		echo $result . "\r\n";
	// 	  break;
	// 	default:
	// 	  $text = NULL;
	// 	  break;
	//   }

	 

	// }
	 // message setup & send
	 if($text != NULL){
		$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("OMG");
		$response = $bot->replyMessage($to, $textMessageBuilder);
	  }
  }
}
