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
	if($event['type'] == "message" && isset($event['message']['text'])){

	  $type = $event['source']['type']; // user , room , group
	  $to = $event['source'][$type.'Id']; // userId , roomId , groupId
	  $message = trim($event['message']['text']);

	  switch ($message) {
		case '/help':
		  $text = "ฉันคือ ID Finder Bot ยินดีที่ได้รู้จัก";
		  $text .= "\nฉันมีหน้าที่ช่วยคุณค้าหา UserID RoomID หรือ GroupID ให้กับคุณ";
		  $text .= "\nลองพิมพ์ /id ดูซิ";
		  break;
		case '/id':
		  $text = "ข้อมูล ID ของคุณ";
		  if(isset($event['source']['userId'])){ $text .= "\nUser ID : ".$event['source']['userId']; }
		  if(isset($event['source']['roomId'])){ $text .= "\nRoom ID : ".$event['source']['roomId']; }
		  if(isset($event['source']['groupId'])){ $text .= "\nGroup ID : ".$event['source']['groupId']; }
		  break;
		default:
		  $text = NULL;
		  break;
	  }

	  // message setup & send
	  if($text != NULL){
		$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($text);
		$response = $bot->replyMessage($to, $textMessageBuilder);
	  }

	}
  }
}
