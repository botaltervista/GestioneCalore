<?php

// pdgt-esercitazione-heroku

echo "hola, estoy aquì hoy..\n";

//per gestire corpo richiesta, si legge il contenuto della richiesta
$content = file_get_contents("php://input");

	if(!$content)
		exit();
	
	$update = json_decode($content, false);//si ottiene oggetto php
	
	$message = $update->message;//update è tutto il blocco, message il pezzo
	
	$message_id = $message->message_id;
	$text = $message->text;
	
	                        //graffe, dollaro e variabile, variabili php dentro stringa
	error_log("Message ID {$message_id}: {$text}\n");  //usa php per logare errori di sistema
//il bot invia mess, viene decodificato e scompattato

//meglio non chiudere perche php stampa tutto
	$chat_id = $message->chat->id;
	//$token = "qui si metterebbe il token telegram ma non è sicuro";
	//il runtime ci da il codice token, lo otteniamo da fuori, getenv sono variabili che eseguono il nostro codice
	$token = getenv("BOTTOKEN");



	
	$url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&text=" . urlencode("\nMi hai scritto questo: {$text}");
//stringa convertita per inserire nell'url per essere compattibile

error_log("URL: " . $url);

$handle = curl_init($url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_POST, true);
$response = curl_exec($handle);

error_log("sendMessage: " . $response);
