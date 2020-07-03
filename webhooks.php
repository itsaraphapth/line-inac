<?php


$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = '82RJmA6R8Us7FXuVhejH4foQ9mEwGWdm07S4MUMB3Lf5mANVg01RzLnVIQbeLyGly6AF1Zm1LjUo1XAk1I4fJKT+qRgUwONfQtwN+KxohE+prow+FC7B/JDmctO55d2I7pn2o0lgcLidPVgZr8g0vgdB04t89/1O/w1cDnyilFU='; 
$channelSecret = '9193f48668ad20ca0b650bd892822ae7';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array
$message = $request_array['events'][0]['message']['text'];
if($message == "ขอราคา"){
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
					"text" => "Purchase",
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
					"text" => "Payment complete.",
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
}elseif($message == "อยากกินซูชิ"){
	$json = [
		"type"=> "text", 
		"text"=> "Select your favorite food category or send me your location!",
		"quickReply"=> [ 
		  "items"=> [
			[
			  "type"=> "action", 
			  "imageUrl"=> "https://img2.thaipng.com/20171127/6dd/sushi-png-clipart-image-5a1ca4f5456d13.2744073815118266772844.jpg",
			  "action"=> [
				"type"=> "message",
				"label"=> "Sushi",
				"text"=> "Sushi"
			  ]
			],
			[
			  "type"=> "action",
			  "imageUrl"=> "https://png.pngtree.com/element_our/20190604/ourmid/pngtree-fried-shrimp-tempura-food-delicious-golden-yellow-image_1482390.jpg",
			  "action"=> [
				"type"=> "message",
				"label"=> "Tempura",
				"text"=> "Tempura"
			  ]
			],
			[
			  "type"=> "action", // ④
			  "action"=> [
				"type"=> "location",
				"label"=> "Send location"
			  ]
			]
		  ]
		]
	];
}elseif($message == "บอลไม่สวย"){
	$json = [
		"type"=> "image",
		"originalContentUrl"=> "https://i.pinimg.com/originals/cc/22/d1/cc22d10d9096e70fe3dbe3be2630182b.jpg",
		"previewImageUrl"=> "https://i.pinimg.com/originals/cc/22/d1/cc22d10d9096e70fe3dbe3be2630182b.jpg"
	];
}else{

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

?>