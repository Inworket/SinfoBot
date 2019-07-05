<?php
$content = file_get_contents("php://input");
$update = json_decode($content, true);

if(!$update)
{
  exit;
}

$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";

$text = trim($text);
$text = strtolower($text);

$response = "";
if(strpos($text, "/start") === 0 ) {
	$response = "Ciao $firstname! \nMi presento, sono SinfoBot, digita il comando /help per sapere cosa posso dirti!";
	sendMsg($chatId, $response);
	if(strpos($text, "/help") === 0 ) {
	$response = "I miei comandi li devi scrivere mettendo il / di fianco sennò non funziono e sono i seguenti: discord, social, patreon";
	sendMsg($chatId, $response);
}

function sendMsg($id, $msg) {
	$token = "896573323:AAFOIK79Fixmi4ECOlmeAgjOiIgMj93TxY8";

	$data = [
		'text' => $msg,
		'chat_id' => $id
	];

	file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );
}