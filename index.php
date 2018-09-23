<?php
// pdgt-esercitazione-heroku


//per gestire corpo richiesta, si legge il contenuto della richiesta
$content = file_get_contents("php://input");

if(!$content) {
	error_log("No input");
	die("Nessun input");
}

$update = json_decode($content, false);//si ottiene oggetto php

error_log("Input: " . print_r($update, true));

$message = $update->message; //update è tutto il blocco, message il pezzo

$message_id = $message->message_id;
$text = $message->text;
$chat_id = $message->chat->id;
$name = $message->from->first_name;

			//graffe, dollaro e variabile, variabili php dentro stringa
error_log("Message ID {$message_id} from {$chat_id}: {$text}\n");  //usa php per logare errori di sistema
//il bot invia mess, viene decodificato e scompattato

//$token = "qui si metterebbe il token telegram ma non è sicuro";$tastiera
//il runtime ci da il codice token, lo otteniamo da fuori, getenv sono variabili che eseguono il nostro codice
$token = getenv("BOTTOKEN");


////////////////////////

//aggiunto da controllare funzionamento
	$ora = date('H:i');
	$giorno = date('d/m/Y');	
$message = "\nCiao,".$name." sono le: $ora, del giorno: $giorno";  

$inline_keyboard = ['inline_keyboard' => [['text' => 'Tasto1', 'callback_data' => 'pressed_btn1']]];

///////////////////////////////

//$url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&text=" . urlencode("$message \nMi hai scritto questo: {$text}");
//stringa convertita per inserire nell'url per essere compattibile

$url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&text=" . urlencode("$message\n$inline_keyboard");
//stringa convertita per inserire nell'url per essere compattibile



 //$tastiera = '&reply_markup={"keyboard":[["Tastiera%20inline"],["Nascondi%20Tastiera","Rimuovi%20Tastiera"]]"one_time_keyboard":true}';
 //$url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&text=" .urlencode($text.$tastiera);
 
 //$url = $GLOBALS[website]."sendMessage?chat_id="{$chat_id}"&text=".urlencode($text).$tastiera;
 //file_get_contents($url);



error_log("URL: " . $url);

$handle = curl_init($url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_POST, true);
$response = curl_exec($handle);

error_log("sendMessage: " . $response);
