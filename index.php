<?php
// pdgt-esercitazione-heroku
//require 'functions.php';  //inclusione delle funzioni
require 'curl-lib.php';
$controllo = 0;

//per gestire corpo richiesta, si legge il contenuto della richiesta
$content = file_get_contents("php://input");

if(!$content) {
	error_log("No input");
	die("Nessun input");
}

//inizio else principale
else{
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

	if($text === '/start'){	
		$avviso = 'Benvenuto nel servizio di messaggistica sulla Gestione Calore';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
	}
	
	//se viene inserita la parola /impianti
	else if($text === '/7'){
		impianti();
	
	}
	
	
	//se viene inserita la scelta /8
	else if($text === '/8'){
		//impianti();
		$avviso = 'Elenco degli impianti in servizio attualmente:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		
    		//$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Tipo_Impianti.json');
    		$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Elenco_Impianti.json');
    		//richiesta della risposta HTTP come stringa
    		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    		//esecuzione della richiesta HTTP
    		$response = curl_exec($handle);
    		//estrazione del codice di risposta (HTTP status)
    		$http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));		
		
   		$data = json_decode($response, true);
     
    	 	foreach ($data as $info) { 
        		//stampa il codice dell'impianto
	     
        		//salva il codice dell'impianto        
        		$info1="/".$info['cod_impianto'];
	     
			//salva la descrizione dell'impianto
       			$info2=$info['Id_Descrizione'];
       
       			//salva la data contratto
      	      	        $info3=$info['Contratto'];
        
      	      	        $datos[$controllo][$controllo][$controllo] = "$info1"." ". "$info2"." "."$info3";
        
			$controllo = $controllo + 1;
			//$url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&text=" . urlencode("$mensaje");
		}
	  	$controllo = $controllo - 1;
		$indice = 1;
   		for($xx = 0; $xx <= $controllo; $xx = $xx + 1){
			http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$indice." - ".$datos[$xx][$xx][$xx]);
			$indice = $indice + 1;
		}
		
		}//fine if /impianti
		
	else if($text === '/menu'){
		
		$messaggio1 = "/1  stampa i dettagli delle caldaie esistenti.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);
  		$messaggio1 = "/2  stampa gli interventi effettuati negli impianti.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);
  		$messaggio1 = "/3  stampa la matricola dei contatori gas.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);
  		$messaggio1 = "/4  stampa le ore ordinarie di funzionamento.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);
  		$messaggio1 = "/5  stampa il tipo di impianto e la denominazione.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);
	  	$messaggio1 = "/6  stampa l'ultima lettura effettuata del contatore gas.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);
  		$messaggio1 = "/7  stampa i consumi degli impianti.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);
  		$messaggio1 = "/8  stampa l'elenco degli impianti in servizio.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);
  		$messaggio1 = "/9  stampa pronto intervento.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);
  		$messaggio1 = "/10  stampa dettagli di un determinato impianto.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);
  		$messaggio1 = "/11  stampa tutti gli impianti.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);
  		$messaggio1 = "/12  stampa impianto dettagliato.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);

	
	}	
	else{
	     	//aggiunto da controllare funzionamento
		$ora = date('H:i');
		$giorno = date('d/m/Y');

		$message = " Sono le: $ora del giorno: $giorno";  

		$ore = date('H:i');

		switch ($ore){
			//Tra le 12 e le 17
			case ($ore >= 12 && $ore <= 17):
   			 $message1 = "Buon Pomeriggio";
			break;

			case ($ore >= 17 && $ore <= 24):
			    $message1 = "Buona sera";
			break;

			case ($ore >= 0 && $ore <= 5):
 			   $message1 = "Buona notte";
			break;

			default:
 			   $message1 = "Buon mattino";
			break;

		}//fine switch

		$message2 = $message1." ".$name.".".$message;     

		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$message2);	
		$message2 = " ";

	}//fine else info ora
	
	
}//fine else principale



function impianti(){
		$avviso = 'Elenco degli impianti in servizio attualmente:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		

		
    		//$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Tipo_Impianti.json');
    		$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Elenco_Impianti.json');
    		//richiesta della risposta HTTP come stringa
    		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    		//esecuzione della richiesta HTTP
    		$response = curl_exec($handle);
    		//estrazione del codice di risposta (HTTP status)
    		$http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));		
		
   		$data = json_decode($response, true);
     
    	 	foreach ($data as $info) { 
        		//stampa il codice dell'impianto
	     
        		//salva il codice dell'impianto        
        		$info1="/".$info['cod_impianto'];
	     
			//salva la descrizione dell'impianto
       			$info2=$info['Id_Descrizione'];
       
       			//salva la data contratto
      	      	        $info3=$info['Contratto'];
        
      	      	        $datos[$controllo][$controllo][$controllo] = "$info1"." ". "$info2"." "."$info3";
        
			$controllo = $controllo + 1;
			//$url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&text=" . urlencode("$mensaje");
		}
	  	$controllo = $controllo - 1;
		$indice = 1;
   		for($xx = 0; $xx <= $controllo; $xx = $xx + 1){
			http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$indice." - ".$datos[$xx][$xx][$xx]);
			$indice = $indice + 1;
		}

}//fine funzione impianti

?>



