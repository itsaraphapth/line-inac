<?php
    require_once __DIR__ . '/vendor/autoload.php';
  
    // debug
    error_reporting(-1);
    ini_set('display_errors', 'On');
  
    // Channel secret - (from https://developers.line.me/console/)
    $token = '82RJmA6R8Us7FXuVhejH4foQ9mEwGWdm07S4MUMB3Lf5mANVg01RzLnVIQbeLyGly6AF1Zm1LjUo1XAk1I4fJKT+qRgUwONfQtwN+KxohE+prow+FC7B/JDmctO55d2I7pn2o0lgcLidPVgZr8g0vgdB04t89/1O/w1cDnyilFU=';
    // $token = $_POST['token'];
    
    // Channel access token - (from https://developers.line.me/console/)
    $secret = '9193f48668ad20ca0b650bd892822ae7';
    // $secret = $_POST['secret'];
//    $pushID = array(
//        "U11fae07ce7afb4aac7875be082b2b3ee",
//        "U0e6b5794496cbcee1bb4850c8f888c8c",
//        "U8f70ff048d6c81f89cc0f280be0acef2"
//    );
  
    // connect key setup
    $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($token);
    $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $secret]);
  
$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array
// var_dump($request_array);
echo $request_array['id'];
die();
    // if(isset($_POST['to']) && trim($_POST['to']) != '' && isset($_POST['text']) && trim($_POST['text']) != ''){
      if(trim($request_array['id']) != ''){
      // check for send message only
      $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($_POST['text']);
      $response = $bot->pushMessage($_POST['to'], $textMessageBuilder);
     
      // check status sending line api
      if($response->isSucceeded()){
        echo "true";
      }else{
        echo "false";
      }
  
    }else{
  
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
              $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("OMG");
              $response = $bot->replyMessage($to, $textMessageBuilder);
            }
  
          }
        }
      }
    }
  
    // debug
    // echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
  ?>