<?php
/* File contenente le varie funzioni usate dal client */

//---------------------------------------------------------------------


/* funzione per la stampa di tutti gli impianti*/
function Stampa_Impianti($impianto){
	
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
		}  //fine foreach
	
	  	$controllo = $controllo - 1;
		$indice = 1;
   		for($xx = 0; $xx <= $controllo; $xx = $xx + 1){
			http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$indice." - ".$datos[$xx][$xx][$xx]);
			$indice = $indice + 1;
		}  //fine  funzione Stampa_Impianti
		
				//$first_ch = readline();    //acquisizione scelta dell'utente
		//commento $url 
		//$url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&text=" . urlencode("$message1 $message\nOggi mi hai scritto questo: {$text}");
		//stringa convertita per inserire nell'url per essere compattibile
		/*
		error_log("URL: " . $url);
		$handle = curl_init($url);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handle, CURLOPT_POST, true);
		$response = curl_exec($handle);
		error_log("sendMessage: " . $response);
		*/
//---------------------------------------------------------------------

/* funzione per la stampa del pronto intervento*/
function Caldaie($http_code, $response, $impianto) {
  if ($http_code == 200) {
     //risposta HTTP ok
     $data = json_decode($response, true);

     foreach ($data as $info) {
	   echo "\n\n-------------------------------------------------------------------------------------------\n"; 
       //Anno d'installazione della caldaia
       printf("Anno Installazione:  %s\n", $info['Anno_Installazione']);
       
       //Anno di costruzione della caldaia
       printf("Anno Targa:  %s\n", $info['Anno_Targa']);
       
       //Marca della caldaia
       printf("Marca della Caldaia:  %s\n", $info['Marca_Caldaia']);
       
       //Matricola nella targhetta
       printf("Matricola del Bruciatore:  %s\n", $info['Matricola_Bruciatore']);
       
       //Matricola della caldaia
       printf("Matricola della Caldaia:  %s\n", $info['Matricola_Caldaia']);
       
       //Modello della caldaia
       printf("Modello della Caldaia:  %s\n", $info['Modello']);
       
       //Numero della chiamata
       printf("Potenza del Focolare:  %s\n", $info['Pot_Focolare']);
       
       //Potenza utile presente nella targhetta
       printf("Potenza Utile della Caldaia:  %s\n", $info['Pot_Utile']);
       
       //Numero della caldaia in questione
       printf("Numero della Caldaia:  %s\n", $info['caldaia_numero']);
       
       //codice dell'impianto
       printf("Codice dell'impianto:  %s\n", $info['cod_impianto']);
       
       echo "\n-------------------------------------------------------------------------------------------\n";
     }    //end foreach
  } else {
      //se ritorna un codice di errore dalla richiesta HTTP
      echo "\nATTENZIONE ---> La richiesta HTTP ha restituito il codice d'errore #{$http_code}." . PHP_EOL;
  }    //end if-else
}    //end function



//---------------------------------------------------------------------

/* funzione per la stampa denominazione impianto*/
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

//---------------------------------------------------------------------

//---------------------------------------------------------------------

/* funzione per la stampa del pronto intervento*/
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

//---------------------------------------------------------------------

/* funzione per la stampa del pronto intervento*/
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

//---------------------------------------------------------------------


//---------------------------------------------------------------------

/* funzione per la stampa del pronto intervento*/
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

//---------------------------------------------------------------------


//---------------------------------------------------------------------

/* funzione per stampa delle ore ordinarie di funzionamento*/
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

//---------------------------------------------------------------------


//---------------------------------------------------------------------

/* funzione per la stampa dei tipi di impianti*/
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

//---------------------------------------------------------------------

//---------------------------------------------------------------------

/* funzione per la stampa delle ultime letture dei cointatori*/
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

//---------------------------------------------------------------------

/* funzione per la stampa del consumo degli impianti*/
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

//----

/* funzione per la stampa dell'impianto scelto*/
function Impianto_Scelto($http_code,$response,$impianto) {
  if ($http_code == 200) {
	  //--------------------------------------
	  
		
    echo "\t[10] seleziona l'impianto dall'elenco.\n";
    
      $impianto = readline();    //caratteristica scelta dall'utente per il filtraggio
      //$impianto = string($impianto);
      
	  printf("L'impianto scelto e': %s\n",$impianto);
	  
	 //richiama la funzione passando l'impiando desiderato
     Impianti($http_code,$response,$impianto);
     
     /*
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
     
     */
     
  } else {
      //se ritorna un codice di errore dalla richiesta HTTP
      echo "\nATTENZIONE ---> La richiesta HTTP ha restituito il codice d'errore #{$http_code}." . PHP_EOL;
  }    //end if-else
}    //end function

//----



?>
