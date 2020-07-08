<?php
    require_once __DIR__ . '/vendor/autoload.php';
  
    // debug
    error_reporting(-1);
    ini_set('display_errors', 'On');
  
    // Channel secret - (from https://developers.line.me/console/)
    $token = '82RJmA6R8Us7FXuVhejH4foQ9mEwGWdm07S4MUMB3Lf5mANVg01RzLnVIQbeLyGly6AF1Zm1LjUo1XAk1I4fJKT+qRgUwONfQtwN+KxohE+prow+FC7B/JDmctO55d2I7pn2o0lgcLidPVgZr8g0vgdB04t89/1O/w1cDnyilFU=';
    // $token = $_POST['token'];
    
    // Channel access token - (from https://developers.line.me/console/)
    $secret = '9193f4<?php


    $API_URL = 'https://api.line.me/v2/bot/message';
    $ACCESS_TOKEN = '82RJmA6R8Us7FXuVhejH4foQ9mEwGWdm07S4MUMB3Lf5mANVg01RzLnVIQbeLyGly6AF1Zm1LjUo1XAk1I4fJKT+qRgUwONfQtwN+KxohE+prow+FC7B/JDmctO55d2I7pn2o0lgcLidPVgZr8g0vgdB04t89/1O/w1cDnyilFU='; 
    $channelSecret = '9193f48668ad20ca0b650bd892822ae7';
    
    
    $POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);
    
    $request = file_get_contents('php://input');   // Get request content
    $request_array = json_decode($request, true);   // Decode JSON to Array
 
    // var_dump($request_array);
    // echo "<p>".$request_array[0]['events']['type']."</p>";
    // die();
    $input = $request_arrayy[0]['events']['type'];
    
    if (trim($input = "message")) {
      $json = [
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
    }
      if ( sizeof($request_array['events']) > 0 ) {
        foreach ($request_array['events'] as $event) {
            error_log(json_encode($event));
            $reply_message = '';
            $reply_token = $event['replyToken'];
    
    
            $data = [
                'replyToken' => $reply_token,
                'messages' => [$json]
            ];
    
            print_r($data);
    
            $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
    
            $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
    
            echo "Result: ".$send_result."\r\n";
            
        }
    }
    
    echo "OK";
    
    
    
    
    function send_reply_message($url, $post_header, $post_body)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($ch);
        curl_close($ch);
    
        return $result;
    }
    
    ?>8668ad20ca0b650bd892822ae7';
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
    // if(isset($_POST['to']) && trim($_POST['to']) != '' && isset($_POST['text']) && trim($_POST['text']) != ''){
      if(trim($request_array['id']) != ''){
      // check for send message only
      $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($request_array['text']);
      $response = $bot->pushMessage($request_array['id'], $textMessageBuilder);
     
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