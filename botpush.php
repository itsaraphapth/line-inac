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
$arrayHeader = array();
$arrayHeader[] = "Content-Type: application/json";
$arrayHeader[] = "Authorization: Bearer {$token}";
// // if(isset($_POST['to']) && trim($_POST['to']) != '' && isset($_POST['text']) && trim($_POST['text']) != ''){
  //   if(trim($request_array['id']) != ''){
    //   // check for send message only
    //   $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($request_array['text']);
    //   $response = $bot->pushMessage($request_array['id'], $textMessageBuilder);
    
    //   // check status sending line api
    //   if($response->isSucceeded()){
      //     echo "true";
      //     return;
      //   }else{
        //     echo "false";
        //   }
        
      $message = $request_array['type'];
        if($message == "message"){
          $arrayPostData['to'] = $request_array['id'];
          $arrayPostData['messages'][0]['type'] = "text";
          $arrayPostData['messages'][0]['text'] = "เอกสาร ".$request_array['moduletype']." ใหม่ รออนุมัติ";
          $arrayPostData['messages'][1]['type'] = "sticker";
          $arrayPostData['messages'][1]['packageId'] = "2";
          $arrayPostData['messages'][1]['stickerId'] = "34";
          $arrayPostData['messages'][2]['type'] = "flex";
          $arrayPostData['messages'][2]['altText'] = "เอกสาร ".$request_array['moduletype']." ใหม่ รออนุมัติ";
          $arrayPostData['messages'][2]['contents']['type'] =  "bubble";
          $arrayPostData['messages'][2]['contents']['direction'] =  "ltr";
          $arrayPostData['messages'][2]['contents']['header']['type'] =  "box";
          $arrayPostData['messages'][2]['contents']['header']['layout'] =  "vertical";
          $arrayPostData['messages'][2]['contents']['header']['contents'][0]['type'] =  "text";
          $arrayPostData['messages'][2]['contents']['header']['contents'][0]['text'] =  $request_array['text'];
          $arrayPostData['messages'][2]['contents']['header']['contents'][0]['size'] =  "lg";
          $arrayPostData['messages'][2]['contents']['header']['contents'][0]['align'] =  "start";
          $arrayPostData['messages'][2]['contents']['header']['contents'][0]['weight'] =  "bold";
          $arrayPostData['messages'][2]['contents']['header']['contents'][0]['color'] =  "#009813";
          $arrayPostData['messages'][2]['contents']['header']['contents'][1]['type'] =  "text";
          $arrayPostData['messages'][2]['contents']['header']['contents'][1]['text'] =  "100,000 บาท";
          $arrayPostData['messages'][2]['contents']['header']['contents'][1]['size'] =  "3xl";
          $arrayPostData['messages'][2]['contents']['header']['contents'][1]['weight'] =  "bold";
          $arrayPostData['messages'][2]['contents']['header']['contents'][1]['color'] =  "#000000";
          $arrayPostData['messages'][2]['contents']['header']['contents'][2]['type'] =  "text";
          $arrayPostData['messages'][2]['contents']['header']['contents'][2]['text'] =  "Rabbit Line Pay";
          $arrayPostData['messages'][2]['contents']['header']['contents'][2]['size'] =  "lg";
          $arrayPostData['messages'][2]['contents']['header']['contents'][2]['weight'] =  "bold";
          $arrayPostData['messages'][2]['contents']['header']['contents'][2]['color'] =  "#000000";

          $arrayPostData['messages'][2]['contents']['body']['type'] =  "box";
          $arrayPostData['messages'][2]['contents']['body']['layout'] =  "vertical";
          $arrayPostData['messages'][2]['contents']['body']['contents'][0]['type'] =  "separator";
          $arrayPostData['messages'][2]['contents']['body']['contents'][0]['color'] =  "#C3C3C3";

          $arrayPostData['messages'][2]['contents']['body']['contents'][1]['type'] =  "box";
          $arrayPostData['messages'][2]['contents']['body']['contents'][1]['layout'] =  "baseline";
          $arrayPostData['messages'][2]['contents']['body']['contents'][1]['margin'] =  "lg";
          $arrayPostData['messages'][2]['contents']['body']['contents'][1]['contents'][0]['type'] =  "text";
          $arrayPostData['messages'][2]['contents']['body']['contents'][1]['contents'][0]['text'] =  "เสาเข็ม";
          $arrayPostData['messages'][2]['contents']['body']['contents'][1]['contents'][0]['align'] =  "start";
          $arrayPostData['messages'][2]['contents']['body']['contents'][1]['contents'][0]['color'] =  "#000000";
          
          $arrayPostData['messages'][2]['contents']['body']['contents'][1]['contents'][1]['type'] =  "text";
          $arrayPostData['messages'][2]['contents']['body']['contents'][1]['contents'][1]['text'] =  "100 ชิ้น";
          $arrayPostData['messages'][2]['contents']['body']['contents'][1]['contents'][1]['align'] =  "end";
          $arrayPostData['messages'][2]['contents']['body']['contents'][1]['contents'][1]['color'] =  "#000000";

          $arrayPostData['messages'][2]['contents']['body']['contents'][2]['type'] =  "separator";
          $arrayPostData['messages'][2]['contents']['body']['contents'][2]['margin'] =  "lg";
          $arrayPostData['messages'][2]['contents']['body']['contents'][2]['color'] =  "#C3C3C3";

          $arrayPostData['messages'][2]['contents']['footer']['type'] =  "box";
          $arrayPostData['messages'][2]['contents']['footer']['layout'] =  "horizontal";
          $arrayPostData['messages'][2]['contents']['footer']['contents'][0]['type'] =  "text";
          $arrayPostData['messages'][2]['contents']['footer']['contents'][0]['text'] =  "View Details";
          $arrayPostData['messages'][2]['contents']['footer']['contents'][0]['size'] =  "lg";
          $arrayPostData['messages'][2]['contents']['footer']['contents'][0]['align'] =  "start";
          $arrayPostData['messages'][2]['contents']['footer']['contents'][0]['color'] =  "#0084B6";
          $arrayPostData['messages'][2]['contents']['footer']['contents'][0]['action']['type'] =  "uri";
          $arrayPostData['messages'][2]['contents']['footer']['contents'][0]['action']['label'] =  "View Detail";
          $arrayPostData['messages'][2]['contents']['footer']['contents'][0]['action']['uri'] =  "http://cm.thecreatorshq.com/cm_uat/";
          // var_dump($arrayPostData);
          // die();
      pushMsg($arrayHeader,$arrayPostData);
      echo true;
   }elseif ($message == "flex") {
    
      $arrayPostData = [
        "type" => "flex",
        "altText" => "Hello Flex Message",
        "contents" => [
          "type" => "bubble",
          "direction" => "ltr",
          "header" => [
            "type" => "box",
            "layout" => "vertical",
            "contents" => [
            [
              "type" => "text",
              "text" => "บอลติดหนี้",
              "size" => "lg",
              "align" => "start",
              "weight" => "bold",
              "color" => "#009813"
            ],
            [
              "type" => "text",
              "text" => "฿ 100.00",
              "size" => "3xl",
              "weight" => "bold",
              "color" => "#000000"
            ],
            [
              "type" => "text",
              "text" => "Rabbit Line Pay",
              "size" => "lg",
              "weight" => "bold",
              "color" => "#000000"
            ],
            [
              "type" => "text",
              "text" => "2019.02.14 21:47 (GMT+0700)",
              "size" => "xs",
              "color" => "#B2B2B2"
            ],
            [
              "type" => "text",
              "text" => "กรุณาจ่าย.",
              "margin" => "lg",
              "size" => "lg",
              "color" => "#000000"
            ]
            ]
          ],
          "body" => [
            "type" => "box",
            "layout" => "vertical",
            "contents" => [
            [
              "type" => "separator",
              "color" => "#C3C3C3"
            ],
            [
              "type" => "box",
              "layout" => "baseline",
              "margin" => "lg",
              "contents" => [
              [
                "type" => "text",
                "text" => "Merchant",
                "align" => "start",
                "color" => "#C3C3C3"
              ],
              [
                "type" => "text",
                "text" => "BTS 01",
                "align" => "end",
                "color" => "#000000"
              ]
              ]
            ],
            [
              "type" => "box",
              "layout" => "baseline",
              "margin" => "lg",
              "contents" => [
              [
                "type" => "text",
                "text" => "New balance",
                "color" => "#C3C3C3"
              ],
              [
                "type" => "text",
                "text" => "฿ 45.57",
                "align" => "end"
              ]
              ]
            ],
            [
              "type" => "separator",
              "margin" => "lg",
              "color" => "#C3C3C3"
            ]
            ]
          ],
          "footer" => [
            "type" => "box",
            "layout" => "horizontal",
            "contents" => [
            [
              "type" => "text",
              "text" => "View Details",
              "size" => "lg",
              "align" => "start",
              "color" => "#0084B6",
              "action" => [
              "type" => "uri",
              "label" => "View Details",
              "uri" => "https://google.co.th/"
              ]
            ]
            ]
          ]
        ]
      ];
      
      pushMsgjson($arrayHeader,$arrayPostData);
   }
   function pushMsg($arrayHeader,$arrayPostData){
      $strUrl = "https://api.line.me/v2/bot/message/push";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$strUrl);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($ch);
      curl_close ($ch);
   }
   function pushMsgjson($arrayHeader,$arrayPostData){
    

    $data = [
      'messages' => [$arrayPostData]
    ];
    $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $post_body;
      $strUrl = "https://api.line.me/v2/bot/message/push";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$strUrl);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($ch);
      curl_close ($ch);
   }
   exit;
  
    // }else{
  
    //   // Get POST body content
    //   $content = file_get_contents('php://input');
    //   // Parse JSON
    //   $events = json_decode($content, true);
  
    //   // Validate parsed JSON data
    //   if (!is_null($events['events'])) {
    //     foreach ($events['events'] as $event) {
    //       if($event['type'] == "message" && isset($event['message']['text'])){
  
    //         $type = $event['source']['type']; // user , room , group
    //         $to = $event['source'][$type.'Id']; // userId , roomId , groupId
    //         $message = trim($event['message']['text']);
  
    //         switch ($message) {
    //           case '/help':
    //             $text = "ฉันคือ ID Finder Bot ยินดีที่ได้รู้จัก";
    //             $text .= "\nฉันมีหน้าที่ช่วยคุณค้าหา UserID RoomID หรือ GroupID ให้กับคุณ";
    //             $text .= "\nลองพิมพ์ /id ดูซิ";
    //             break;
    //           case '/id':
    //             $text = "ข้อมูล ID ของคุณ";
    //             if(isset($event['source']['userId'])){ $text .= "\nUser ID : ".$event['source']['userId']; }
    //             if(isset($event['source']['roomId'])){ $text .= "\nRoom ID : ".$event['source']['roomId']; }
    //             if(isset($event['source']['groupId'])){ $text .= "\nGroup ID : ".$event['source']['groupId']; }
    //             break;
    //           default:
    //             $text = NULL;
    //             break;
    //         }
  
    //         // message setup & send
    //         if($text != NULL){
    //           $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("OMG");
    //           $response = $bot->replyMessage($to, $textMessageBuilder);
    //         }
  
    //       }
    //     }
    //   }
    // }
  
    // debug
    // echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
  ?>