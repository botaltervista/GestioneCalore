<?php
// pdgt-esercitazione-heroku
require 'functions.php';  //inclusione delle funzioni
require 'curl-lib.php';
$controllo = 0;
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


//aggiunto da controllare funzionamento
	$ora = date('H:i');
	$giorno = date('d/m/Y');

$message = "".$name." sono le: $ora, del giorno: $giorno";  

$ore = date('H:i');

switch ($ore)
{
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

}

$message2 = $message1." ".$name."!".$message;     

	http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$message2."!");	


			$message4 =		
			"Selezionare la richiesta da eseguire al database:
			1 stampa i dettagli delle caldaie esistenti.
			2 stampa gli interventi effettuati negli impianti.
			4 stampa le ore ordinarie di funzionamento.
			5 stampa il tipo di impianto e la denominazione.
			6 stampa ultima lettura effettuata del contatore gas.
			7 stampa i consumi degli impianti.
			8 stampa elenco degli impianti in servizio.
			9 stampa pronto intervento.
			10 stampa dettagli di un determinato impianto.
			11 stampa tutti gli impianti.
			12 stampa impianto dettagliato.";

    http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$message4);

  $first_ch = readline();    //acquisizione scelta dell'utente
  $first_ch = intval($first_ch);

  if ($first_ch === 1) {		
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
	  
    for($xx = 0; $xx <= $controllo;){
	    $indice = $xx + 1;
	   http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$indice."-".$datos[$xx][$xx][$xx]);
	    $xx = $xx + 1;
	}	  
	  
	  
  }//fine if

  else{
  	http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text="."cosa vuoi???"."!");
  
      }
	  

    	
  //$first_ch = readline();    //acquisizione scelta dell'utente
//////////////////////////////////////////////////////////

//commento $url 
//$url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&text=" . urlencode("$message1 $message\nOggi mi hai scritto questo: {$text}");

//
//stringa convertita per inserire nell'url per essere compattibile

error_log("URL: " . $url);

$handle = curl_init($url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_POST, true);
$response = curl_exec($handle);

error_log("sendMessage: " . $response);


//-------------------------------------------------------------
?>


/*


$close_client = 1;    //variabile di controllo ciclo do-while del menù
$impianto = null;     

do {
  echo "\n\nSelezionare la richiesta da eseguire al database: \n";
  echo "\t[1] stampa i dettagli delle caldaie esistenti.\n";
  echo "\t[2] stampa gli interventi effettuati negli impianti.\n";
  echo "\t[3] stampa la matricola dei contatori gas.\n";
  echo "\t[4] stampa le ore ordinarie di funzionamento.\n";
  echo "\t[5] stampa il tipo di impianto e la denominazione.\n";
  echo "\t[6] stampa l'ultima lettura effettuata del contatore gas.\n";
  echo "\t[7] stampa i consumi degli impianti.\n";
  echo "\t[8] stampa l'elenco degli impianti in servizio.\n";
  echo "\t[9] stampa pronto intervento.\n";
  echo "\t[10] stampa dettagli di un determinato impianto.\n";
  echo "\t[11] stampa tutti gli impianti.\n";
  echo "\t[12] stampa impianto dettagliato.\n";
  $first_ch = readline();    //acquisizione scelta dell'utente
  $first_ch = intval($first_ch);
  if ($first_ch === 1) {
    
    $handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Caldaie_Bruciatori.json');
    
    //richiesta della risposta HTTP come stringa
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    //esecuzione della richiesta HTTP
    $response = curl_exec($handle);
    //estrazione del codice di risposta (HTTP status)
    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
    //funzione per la stampa degli impianti
    Caldaie($http_code,$response,$impianto);
    //fine scelta 1
  //----------------------------------------------
  } 
    elseif ($first_ch === 2) {
    
    $handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Interventi.json');
    
    //richiesta della risposta HTTP come stringa
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    //esecuzione della richiesta HTTP
    $response = curl_exec($handle);
    //estrazione del codice di risposta (HTTP status)
    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
    //funzione per la stampa degli impianti
    Interventi($http_code,$response,$impianto);
    //fine scelta 2
  //----------------------------------------------
  } 
    elseif ($first_ch === 3) {
    
    $handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Matr_Cont_Cod_Serv.json');
    
    //richiesta della risposta HTTP come stringa
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    //esecuzione della richiesta HTTP
    $response = curl_exec($handle);
    //estrazione del codice di risposta (HTTP status)
    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
    //funzione per la stampa degli impianti
    Matricola_Contatore($http_code,$response,$impianto);
    //fine scelta 3
  //----------------------------------------------
  } 
    elseif ($first_ch === 4) {
    
    $handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Ore_Funzionamento.json');
    
    //richiesta della risposta HTTP come stringa
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    //esecuzione della richiesta HTTP
    $response = curl_exec($handle);
    //estrazione del codice di risposta (HTTP status)
    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
    //funzione per la stampa degli impianti
    Ore_Funzionamento($http_code,$response,$impianto);
    //fine scelta 4
  //----------------------------------------------
  } 
    elseif ($first_ch === 5) {
    
    $handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Tipo_Impianti.json');
    
    //richiesta della risposta HTTP come stringa
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    //esecuzione della richiesta HTTP
    $response = curl_exec($handle);
    //estrazione del codice di risposta (HTTP status)
    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
    //funzione per la stampa degli impianti
    Tipo_Impianti($http_code,$response,$impianto);
    //fine scelta 5
  //----------------------------------------------
  } 
    elseif ($first_ch === 6) {
    
    $handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Ultima_Lettura.json');
    
    //richiesta della risposta HTTP come stringa
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    //esecuzione della richiesta HTTP
    $response = curl_exec($handle);
    //estrazione del codice di risposta (HTTP status)
    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
    //funzione per la stampa degli impianti
    Ultima_Lettura($http_code,$response,$impianto);
    //fine scelta 6
  //----------------------------------------------
  } 
    elseif ($first_ch === 7) {
    
    $handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/consumi_2000_2012.json');
    
    //richiesta della risposta HTTP come stringa
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    //esecuzione della richiesta HTTP
    $response = curl_exec($handle);
    //estrazione del codice di risposta (HTTP status)
    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
    //funzione per la stampa degli impianti
    Consumi($http_code,$response,$impianto);
    //fine scelta 7
  //----------------------------------------------
  }
    elseif ($first_ch === 8) {
    
    $handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Elenco_Impianti.json');
    
    //richiesta della risposta HTTP come stringa
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    //esecuzione della richiesta HTTP
    $response = curl_exec($handle);
    //estrazione del codice di risposta (HTTP status)
    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
    //funzione per la stampa degli impianti
    Impianti($http_code,$response,$impianto);
    //fine scelta 8
  //----------------------------------------------
  } 
  //----------------------------------------------
  
    elseif ($first_ch === 9) {
    
    $handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Pronto_Intervento.json');
    
    //richiesta della risposta HTTP come stringa
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    //esecuzione della richiesta HTTP
    $response = curl_exec($handle);
    //estrazione del codice di risposta (HTTP status)
    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
    //funzione per stampare la descrizione dei pronti intervento
    Pronto_Intervento($http_code,$response,$impianto);
    //fine scelta 9
  //----------------------------------------------
  } 
    elseif ($first_ch === 10) {      
    
    $handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Matr_Cont_Cod_Serv.json');
    
    //richiesta della risposta HTTP come stringa
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    //esecuzione della richiesta HTTP
    $response = curl_exec($handle);
    //estrazione del codice di risposta (HTTP status)
    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
    //funzione per la stampa degli impianti
    Impianto_Scelto($http_code,$response,$impianto);    
    
    
    //fine scelta 10
  //----------------------------------------------
  } 
    elseif ($first_ch === 11) {      
    
    $handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Matr_Cont_Cod_Serv.json');
    
    //richiesta della risposta HTTP come stringa
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    //esecuzione della richiesta HTTP
    $response = curl_exec($handle);
    //estrazione del codice di risposta (HTTP status)
    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
    //funzione per la stampa degli impianti
    Info_Impianti($http_code,$response,$impianto);    
    
    
    //fine scelta 10
  //----------------------------------------------
  } 
 
  
    elseif ($first_ch === 12) {
    $close_client = 0;    //chiusura delclient
    echo "\n\nTerminazione corretta del client, arrivederci !\n\n";
    exit;    //terminazione del programma
  } 
  else {
    //se viene inserito un carattere del menù differente da quelli richiesti
    echo "\n\nATTENZIONE --> È stato inserito un valore diverso da quelli previsti." . PHP_EOL;
  }
  
} while ($close_client !== 0);    //end do-while
//chiusura della sessione CURL
curl_close($handle);
*/

//---------------------------------------------------------------
