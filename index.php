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
		$avviso = 'scelta del numero sette:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);		
	
	}
	
	
	//se viene inserita la scelta /8
	else if($text === '/8'){
		
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
?>


//---------------------------------------------------------------------
/* 
//funzione per la stampa delle caldaie di un determinato impianto
function Caldaie($http_code, $response, $impianto) {
  if ($http_code == 200) {




	   
	   
		$avviso = 'inserisci il codice dell'impiando da interrogare:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
	   
	   
	   
       //Anno installazione della caldaia
       $info1="/".$info['Anno_Installazione'];
       
       
       //Anno di costruzione della caldaia
       $info2="/".$info['Anno_Targa'];
       
       
       //Marca della caldaia
       $info3="/".$info['Marca_Caldaia'];
       
       
       //Matricola nella targhetta
       $info4="/".$info['Matricola_Bruciatore'];
       
       
       //Matricola della caldaia
       $info5="/".$info['Matricola_Caldaia'];
       
       
       //Modello della caldaia
       $info6="/".$info['Modello'];
       
       
       //Numero della chiamata
       $info7="/".$info['Pot_Focolare'];
       
       
       //Potenza utile presente nella targhetta
       $info8="/".$info['Pot_Utile'];
       
       
       //Numero della caldaia in questione
       $info9="/".$info['caldaia_numero'];
       
       
       //codice dell'impianto
       $info10="/".$info['cod_impianto'];
       
       $datos[$controllo][$controllo][$controllo][$controllo][$controllo][$controllo][$controllo][$controllo][$controllo][$controllo] = "$info1"." ". "$info2"." "."$info3"." ". "$info4"." "."$info5"." ". "$info6"." "."$info7"." "."$info8"." "."$info9"." "."$info10";
       
       
       
       echo "\n-------------------------------------------------------------------------------------------\n";
     }    //end foreach
  } else {
      //se ritorna un codice di errore dalla richiesta HTTP
      echo "\nATTENZIONE ---> La richiesta HTTP ha restituito il codice d'errore #{$http_code}." . PHP_EOL;
  }    //end if-else
}    //end function caldaie

*/


//---------------------------------------------------------------------

/* 
//funzione per la stampa denominazione impianto
function Impianti($http_code, $response, $impianto) {
  if ($http_code == 200) {
     //risposta HTTP ok
     $data = json_decode($response, true);
     
     if ($impianto != NULL){foreach ($data as $info) {
       
        //stampa il codice dell'impianto
        printf("Codice Impianto:%s\n", $info['cod_impianto']);
       
        //stampa il nome dell'impianto
        printf("Nome Impianto:%s\n", $info['Id_Descrizione']);
       
        // stampa data contratto
        printf("Data Contratto:%s\n", $info['Contratto']);
       
        echo "\n-----------------------------------------------------\n";
       
        }
       }
       
		 
     
     else{foreach ($data as $info) {
       
       //stampa il codice dell'impianto
       printf("Codice Impianto:%s\n", $info['cod_impianto']);
       
       //stampa il nome dell'impianto
       printf("Nome Impianto:%s\n", $info['Id_Descrizione']);
       
       // stampa data contratto
       printf("Data Contratto:%s\n", $info['Contratto']);
       
       echo "\n-----------------------------------------------------\n";
       }
     
     }    //end foreach
  } else {
      //se ritorna un codice di errore dalla richiesta HTTP
      echo "\nATTENZIONE ---> La richiesta HTTP ha restituito il codice d'errore #{$http_code}." . PHP_EOL;
  }    //end if-else
}    //end function

*/


//---------------------------------------------------------------------
//---------------------------------------------------------------------

/* 
//funzione per la stampa del pronto intervento
function Pronto_Intervento($http_code, $response, $impianto) {
  if ($http_code == 200) {
     //risposta HTTP ok
     $data = json_decode($response, true);
     foreach ($data as $info) {
	   echo "\n\n-------------------------------------------------------------------------------------------\n"; 
       // Nome Chiamante
       printf("Chiamante:  %s\n", $info['Chiamante']);
       
       //Data assegnazione
       printf("Data assegnazione:  %s\n", $info['Data_Assegnazione']);
       
       //Data intervento
       printf("Data dell'intervento:  %s\n", $info['Data_Intervento']);
       
       //Descrizione chiamata
       printf("Descrizione della chiamata:  %s\n", $info['Descrizione_Chiamata']);
       
       //Id Chiamata
       printf("Id della chiamata:  %s\n", $info['ID_Chiamata']);
       
       //Numero della chiamata
       printf("Numero progressivo della chiamata:  %s\n", $info['Id']);
       
       //Tempo della risposta
       printf("Tempo di risposta della chiamata:  %s\n", $info['Tempo_Risposta']);
       
       //codice dell'impianto
       printf("Codice dell'impianto:  %s\n", $info['cod_impianto']);
       
       echo "\n-------------------------------------------------------------------------------------------\n";
     }    //end foreach
  } else {
      //se ritorna un codice di errore dalla richiesta HTTP
      echo "\nATTENZIONE ---> La richiesta HTTP ha restituito il codice d'errore #{$http_code}." . PHP_EOL;
  }    //end if-else
}    //end function

*/


//---------------------------------------------------------------------

/* 
//funzione per la stampa del pronto intervento
function Interventi($http_code, $response, $impianto) {
  if ($http_code == 200) {
     //risposta HTTP ok
     $data = json_decode($response, true);
     foreach ($data as $info) {
	   echo "\n\n-------------------------------------------------------------------------------------------\n"; 
       // Nome Chiamante
       printf("Cognome Manutentore:  %s\n", $info['Cognome_Manutentore']);
       
       //Data intervento
       printf("Data dell'intervento:  %s\n", $info['Data_Intervento']);
       
       //Descrizione chiamata
       printf("Descrizione del'intervento:  %s\n", $info['Descrizione_Intervento']);
       
       //Id Chiamata
       printf("Nome Manutentore:  %s\n", $info['Nome_Manutentore']);
       
       //codice dell'impianto
       printf("Codice dell'impianto:  %s\n", $info['cod_impianto']);
       
       echo "\n-------------------------------------------------------------------------------------------\n";
     }    //end foreach
  } else {
      //se ritorna un codice di errore dalla richiesta HTTP
      echo "\nATTENZIONE ---> La richiesta HTTP ha restituito il codice d'errore #{$http_code}." . PHP_EOL;
  }    //end if-else
}    //end function
*/


//---------------------------------------------------------------------
//---------------------------------------------------------------------

/* 
//funzione per la stampa del pronto intervento
function Matricola_Contatore($http_code, $response, $impianto) {
  if ($http_code == 200) {
     //risposta HTTP ok
     $data = json_decode($response, true);
     foreach ($data as $info) {
	   echo "\n\n-------------------------------------------------------------------------------------------\n"; 
       // Nome Chiamante
       printf("Codice di servizio:  %s\n", $info['Cod_Servizio']);
       
       //stampa il nome dell'impianto
       printf("Identificativo dell'impianto:  %s\n", $info['Id_Descrizione']);
       
       //Data intervento
       printf("Matricola del contatore gas:  %s\n", $info['Matr_Contatore']);
       
       echo "\n-------------------------------------------------------------------------------------------\n";
     }    //end foreach
  } else {
      //se ritorna un codice di errore dalla richiesta HTTP
      echo "\nATTENZIONE ---> La richiesta HTTP ha restituito il codice d'errore #{$http_code}." . PHP_EOL;
  }    //end if-else
}    //end function
*/


//---------------------------------------------------------------------
//---------------------------------------------------------------------

/* 
//funzione per stampa delle ore ordinarie di funzionamento
function Ore_Funzionamento($http_code, $response, $impianto) {
  if ($http_code == 200) {
     //risposta HTTP ok
     $data = json_decode($response, true);
     foreach ($data as $info) {
	   echo "\n\n-------------------------------------------------------------------------------------------\n"; 
       // Nome Chiamante
       printf("Ore di servizio in orario lavorativo:  %s\n", $info['Ordinarie']);
       
       //codice dell'impianto
       printf("Codice dell'impianto:  %s\n", $info['cod_impianto']);
       
       echo "\n-------------------------------------------------------------------------------------------\n";
     }    //end foreach
  } else {
      //se ritorna un codice di errore dalla richiesta HTTP
      echo "\nATTENZIONE ---> La richiesta HTTP ha restituito il codice d'errore #{$http_code}." . PHP_EOL;
  }    //end if-else
}    //end function

*/

//---------------------------------------------------------------------

/* 


//funzione per la stampa dei tipi di impianti
function Tipo_Impianti($http_code, $response, $impianto) {
  if ($http_code == 200) {
     //risposta HTTP ok
     $data = json_decode($response, true);
     foreach ($data as $info) {
	   echo "\n\n-------------------------------------------------------------------------------------------\n";
       
       //stampa il nome dell'impianto
       printf("Identificativo impianto:  %s\n", $info['Id_Descrizione']);
       
       //stampa il nome dell'impianto
       printf("Tipo di impianto:  %s\n", $info['Tipo']);
       
       //codice dell'impianto
       printf("Codice dell'impianto:  %s\n", $info['cod_impianto']);
       
       echo "\n-------------------------------------------------------------------------------------------\n";
     }    //end foreach
  } else {
      //se ritorna un codice di errore dalla richiesta HTTP
      echo "\nATTENZIONE ---> La richiesta HTTP ha restituito il codice d'errore #{$http_code}." . PHP_EOL;
  }    //end if-else
}    //end function
*/

//---------------------------------------------------------------------

/*

//---------------------------------------------------------------------
//funzione per la stampa delle ultime letture dei cointatori
function Ultima_Lettura($http_code, $response, $impianto) {
  if ($http_code == 200) {
     //risposta HTTP ok
     $data = json_decode($response, true);
     foreach ($data as $info) {
	   echo "\n\n-------------------------------------------------------------------------------------------\n";
       
       // Nome Chiamante
       printf("Codice di servizio:  %s\n", $info['Cod_Servizio']);
       
       //stampa il nome dell'impianto
       printf("Lettura instantanea del consumo:  %s\n", $info['Lettura_Consumo']);
       
       //codice dell'impianto
       printf("Matricola del contatore gas:  %s\n", $info['Matr_Contatore']);
       
       echo "\n-------------------------------------------------------------------------------------------\n";
     }    //end foreach
  } else {
      //se ritorna un codice di errore dalla richiesta HTTP
      echo "\nATTENZIONE ---> La richiesta HTTP ha restituito il codice d'errore #{$http_code}." . PHP_EOL;
  }    //end if-else
}    //end function

*/

//---------------------------------------------------------------------
/*
//funzione per la stampa del consumo degli impianti
function Consumi($http_code, $response, $impianto) {
  if ($http_code == 200) {
     //risposta HTTP ok
     $data = json_decode($response, true);
     foreach ($data as $info) {
	   echo "\n\n-------------------------------------------------------------------------------------------\n";
       
       // Nome Chiamante
       printf("Codice di servizio:  %s\n", $info['Cod_Servizio']);
       
       //stampa il nome dell'impianto
       printf("Data della lettura instantanea:  %s\n", $info['data_lettura']);
       
       //codice dell'impianto
       printf("Lettura instantanea del contatore gas:  %s\n", $info['lettura']);
       
       echo "\n-------------------------------------------------------------------------------------------\n";
     }    //end foreach
  } else {
      //se ritorna un codice di errore dalla richiesta HTTP
      echo "\nATTENZIONE ---> La richiesta HTTP ha restituito il codice d'errore #{$http_code}." . PHP_EOL;
  }    //end if-else
}    //end function
*/

//----
/*

// funzione per la stampa dell'impianto scelto
function Impianto_Scelto($http_code,$response,$impianto) {
  if ($http_code == 200) {
	  //--------------------------------------
	  
		
    echo "\t[10] seleziona l'impianto dall'elenco.\n";
    
      $impianto = readline();    //caratteristica scelta dall'utente per il filtraggio
      //$impianto = string($impianto);
      
	  printf("L'impianto scelto e': %s\n",$impianto);
	  
	 //richiama la funzione passando l'impiando desiderato
     Impianti($http_code,$response,$impianto);
     
     
	 //****************************************** 
     //risposta HTTP ok
     $data = json_decode($response, true);
     foreach ($data as $info) {
	   echo "\n\n-------------------------------------------------------------------------------------------\n";
       
       // Nome Chiamante
       printf("Codice di servizio:  %s\n", $info['Cod_Servizio']);
       
       //stampa il nome dell'impianto
       printf("Data della lettura instantanea:  %s\n", $info['data_lettura']);
       
       //codice dell'impianto
       printf("Lettura instantanea del contatore gas:  %s\n", $info['lettura']);
       
       echo "\n-------------------------------------------------------------------------------------------\n";
     }    //end foreach
     
     //*******************************************
     
    
     
  } else {
      //se ritorna un codice di errore dalla richiesta HTTP
      echo "\nATTENZIONE ---> La richiesta HTTP ha restituito il codice d'errore #{$http_code}." . PHP_EOL;
  }    //end if-else
}    //end function
//----

 */





