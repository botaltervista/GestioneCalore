<?php
// pdgt-esercitazione-heroku
//require 'functions.php';  //inclusione delle funzioni
require 'curl-lib.php';
$cn = 0;
$controllo7 = 0;


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

	if($text === '/menu'){
		
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
	
	//se viene inserita la scelta /7
	else if($text === '/7'){
	   	$avviso = 'Selezionare impianto da consultare';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		$avviso1 = '/7K001    /7K002    /7K003    /7K004    /7K005    /7K006    /7K007    /7K008    /7K009    /7K010    /7K011    /7K012    /7K014    /7K015    /7K016    /7K017    /7K018    /7K019    /7K020    /7K021    /7K022    /7K023    /7K024    /7K025    /7K026'; 

		$avviso2 = '/7K027    /7K028    /7K029    /7K036    /7K037    /7K038    /7K039    /7K040    /7K041    /7K043    /7K046    /7K047    /7K049    /7K050    /7K051    /7K052    /7K053    /7K054    /7K055    /7K057    /7K058    /7K059    /7K060    /7K061    /7K062';	   

		$avviso3 = '/7K063    /7K065    /7K066    /7K067    /7K068    /7K069    /7K070    /7K071    /7K072    /7K073    /7K074    /7K076    /7K078    /7K079    /K7081    /7K082    /7K083    /7K084    /7K085    /7K086    /7K087    /7K088    /7K089    /7K090    /7K091';   	   

		$avviso4 = '/7K092    /7K093    /7K094    /K7095    /7K096    /7K097    /7K098    /7K099    /7K100    /7K101    /7K102    /7K105    /7K274    /7K280    /7K284    /7K285    /7K287    /7K293    /7K301    /7K310    /7K311    /7K312    /7K313    /7K314    /7K315';	      

		$avviso5 = '/7K316    /7K317    /7K318    /7K324';
		
		$avviso6 = $avviso1."   ".$avviso2."   ".$avviso3."   ".$avviso4."   ".$avviso5;     

		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso6);
			  
		}//fine if text === /7	      		
	
	//$testo = substr($text, 0, 3); // otteniamo dal primo fino al 3°)  
	else if(($testo = substr($text, 0, 3)) === '/7K'){
		$avviso = 'scelta /7K';
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		//$sub3 = substr($stringa, 1, 0); // otteniamo 'niscrip' (parte dal 2° ed arriva fino al ultimo) 
		$scelta = substr($text, 2, 4);
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$scelta);
		
		//$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Caldaie_Bruciatori.json');
    		$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Caldaie_Bruciatori.json');
    		//richiesta della risposta HTTP come stringa
    		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    		//esecuzione della richiesta HTTP
    		$response = curl_exec($handle);
    		//estrazione del codice di risposta (HTTP status)
    		$http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));		
	
   		$data = json_decode($response, true);
		   
		//salva i dati delle caldaie nelle variabili
    	 	foreach ($data as $info) { 
        			
			//Anno installazione della caldaia
      			 $info1="-Anno installazione: ".$info['Anno_Installazione'];
			
      			 //Anno di costruzione della caldaia
      			 $info2=" -Anno costruzione caldaia: ".$info['Anno_Targa'];
       
      			 //Marca della caldaia
      		 	 $info3="  -Marca Caldaia: ".$info['Marca_Caldaia'];
       
      			 //Matricola nella targhetta
      			 $info4="  -Matricola Bruciatore: ".$info['Matricola_Bruciatore'];
       	
     		 	 //Matricola della caldaia
      			 $info5="  -Matricola Caldaia: ".$info['Matricola_Caldaia'];
       	
      		 	//Modello della caldaia
      			 $info6="  -Modello Caldaia ".$info['Modello'];
       
      		 	//potenza al focolare
      			 $info7="  -Potenza al Focolare: ".$info['Pot_Focolare'];
       	
      			 //Potenza utile presente nella targhetta
      			 $info8="  -Potenza Utile: ".$info['Pot_Utile'];
		
      			 //Numero della caldaia in questione
      			 $info9="  -Caldaia numero: ".$info['caldaia_numero'];
       	
      			 //codice dell'impianto
      			 $info10="  -Codice Impianto: ".$info['cod_impianto'];	
			
			 $info11 = str_replace("/7", "", $info10);
			
			 $info12 = $scelta;
			
		         //salva i dati delle variabili dentro il array
      			 //$datos[$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn] = "$info11"." ". "$info12"." "."$info1"." "."$info2"." ". "$info3"." "."$info4"." ". "$info5"." "."$info6"." "."$info7"." "."$info8"." "."$info9"."$scelta";
			$datos[$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn] = "$info11"."$info12"."$info1"."$info2"."$info3"."$info4"."$info5"."$info6"."$info7"."$info8"."$info9"."$scelta";
			
			//variabile di controllo per il indice del array
			$cn = $cn + 1;	
			
			if($info11 == $info12){
				$messaggio = 'numero di caldaie presenti e numero impianto';
				http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio.$cn."  ".$scelta."  ".$info11);
		
			}
				
	   		}//fine foreach
		
		$xx = 0;
		foreach($datos as $sequenza){
  			if($sequenza === $scelta) {
				http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text="." - ".$datos[$xx][$xx][$xx][$xx][$xx][$xx][$xx][$xx][$xx][$xx]);
			
			}//fine if datos == sequenza
  			$xx = $xx + 1;
		}//fine confronto impianti con foreach
				
		
		  
		$messaggio = 'numero di caldaie';
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio.$cn.$datos[$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn]);
		
		
		/*
   		for($xx = 0; $xx <= $cn; $xx = $xx + 1){
				if($scelta == $datos[$xx]){
					$avviso = 'impianto trovato';
					http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso.$scelta);
				}
			
			http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text="." - ".$datos[$xx][$xx][$xx][$xx][$xx][$xx][$xx][$xx][$xx][$xx]);
			//http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$datos[$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn]);
		}//fine ciclo for stampa dati
		*/

		
		
		}//fine scelta /7K
		
		/*
		
		$var = 'prova';
		$array = array('prova', 'prova1', 'prova', 'prova2', 'prova3');

		foreach($array as $i => $a)
		{
  		if($a == $var) { echo "L'elemento {$i} è uguale a {$var}."; }
  		else { echo "L'elemento {$i} non è uguale a {$var}."; }
		} 
		
		
		$var = 'prova';
		$array = array('prova', 'prova1', 'prova', 'prova2', 'prova3');

		if(in_array($var, $array))
  		echo "L'array contiene un elemento che corrisponde a {$var}.";
		else
 		 echo "L'array non contiene elementi che corrispondono a {$var}."; 
		
		*/
	
	
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
	     
        		//salva il codice dell'impianto        
        		$info1=" ".$info['cod_impianto'];
	     
			//salva la descrizione dell'impianto
       			$info2=" ".$info['Id_Descrizione'];
       
       			//salva la data contratto
      	      	        $info3=" ".$info['Contratto'];
        		
			//salva i dati delle variabili nel array
      	      	        $datos[$cn][$cn][$cn] = "$info1"." ". "$info2"." "."$info3";
        		
			//variabile di controllo per il indice del array
			$cn = $cn + 1;
			
			//$url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&text=" . urlencode("$mensaje");
			
		}//fine foreach
		
	  	//$cn = $cn - 1;
		//$indice = 1;
		/*
   		for($xx = 0; $xx <= $cn; $xx = $xx + 1){
			http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$indice." - ".$datos[$xx][$xx][$xx]);
			$indice = $indice + 1;
		}//fine for stampa impianti
		*/
		$ct = 0;
		$indice = 1;
		
		foreach($datos as $elemento){
			//http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text="."$info1"." ". "$info2"." "."$info3");
			http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$indice." - ".$datos[$ct][$ct][$ct]);
			$ct = $ct + 1;
			$indice = $indice + 1;
			if($ct === $cn){
				$ct = " ";
			}
			//endforeach;
		}//fine foreach datos as elemento
		//endforeach;
		
		}//fine if /8
		
	elseif($text === '/ora'){
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

	}//fine elseif info ora
	else{	
		$avviso = 'Menu del servizio di messaggistica sulla Gestione Calore scelga una opzione:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		$avviso = '/menu   /ora';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
	}//fine else	
	
}//fine else principale
?>


//---------------------------------------------------------------------
/* 

'/K001   /K002   /K003   /K004   /K005   
/K006   /K007   /K008   /K009   /K010
/K011   /K012   /K014   /K015
/K016   /K017   /K018   /K019   /K020
/K021   /K022   /K023   /K024   /K025
/K026   /K027   /K028   /K029   /K036
/K037   /K038   /K039   /K040   /K041
/K043   /K046   /K047   /K049   /K050
/K051   /K052   /K053   /K054   /K055
/K057   /K058   /K059   /K060   /K061
/K062   /K063   /K065   /K066   /K067
/K068   /K069   /K070   /K071   /K072
/K073   /K074   /K076   /K078   /K079
/K081   /K082   /K083   /K084   /K085
/K086   /K087   /K088   /K089   /K090
/K091   /K092   /K093   /K094   /K095
/K096   /K097   /K098   /K099   /K100
/K101   /K102   /K105   /K274   /K280
/K284   /K285   /K287   /K293   /K301
/K310   /K311   /K312   /K313   /K314
/K315   /K316   /K317   /K318   /K324';


//funzione per la stampa delle caldaie di un determinato impianto
function Caldaie($http_code, $response, $impianto) {
  if ($http_code == 200) {




	   
	   
		$avviso = 'inserisci il codice dell'impiando da interrogare:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
	   
	   $handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Caldaie_Bruciatori.json');
	   
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
//------------------------------------------------------------------------------------------------------------------------

 */

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



