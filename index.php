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
		$messaggio1 = " /1   Visualizza il tipo di impianti e la denominazione.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);
		
		$messaggio1 = " /2   Visualizza i dettagli di un determinato impianto.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);
		
  		$messaggio1 = " /3   Visualizza pronto intervento su un determinato impianto.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);
		
  		$messaggio1 = " /4   Visualizza gli interventi effettuati negli impianti.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);
		
	  	$messaggio1 = " /5   Visualizza l'ultima lettura effettuata e la matricola del contatore gas.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);  		
		
  		$messaggio1 = " /6   Visualizza i consumi di un determinato impianto.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);		
		
  		$messaggio1 = " /7   Visualizza le ore ordinarie di funzionamento.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);
  		
	}
	
	//se viene inserita la scelta /1
	else if($text === '/1'){
		//inizializzo e azzero le variabili
		$info1 = $info2 = $info3 = $info4 = $info5 =$info6 =$info7 =$info8 =$info9 =$info10 =$info11 =$info12 =$info13 =$info14 = $info15 = 0;
		
		///1   Visualizza il tipo di impianti e la denominazione.";
		$avviso = 'Elenco e denominazione degli impianti in servizio attualmente:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		//scarico i dati dalla tabella Elenco_Impianti.json posta su altervista
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
			
		
		}//fine foreach data as info
		$ct = 0;
		$indice = 1;
		
		foreach($datos as $elemento){
			//http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text="."$info1"." ". "$info2"." "."$info3");
			http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$indice." - ".$datos[$ct][$ct][$ct]);
			$ct = $ct + 1;
			$indice = $indice + 1;
			if($ct === $cn){
				$ct = " ";
			}//fine if ct === cn
		}//fine foreach datos as elemento
		
		$avviso = 'Menu del servizio di messaggistica sulla Gestione Calore scelga una opzione:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		$avviso = '/menu   /ora';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
	  
	}//fine if /1
	
	///2   Visualizza i dettagli di un determinato impianto.";
	else if($text === '/2'){
		//inizializzo e azzero le variabili
		$info1 = $info2 = $info3 = $info4 = $info5 =$info6 =$info7 =$info8 =$info9 =$info10 =$info11 =$info12 =$info13 =$info14 = $info15 = 0;
	   	
		$avviso = 'Selezionare impianto da consultare le caldaie installate:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		$avviso1 = ' /2K001     /2K002     /2K003     /2K004     /2K005     /2K006     /2K007     /2K008     /2K009     /2K010     /2K011     /2K012     /2K014';
		
		$avviso2 = ' /2K015     /2K016     /2K017     /2K018     /2K019     /2K020     /2K021     /2K022     /2K023     /2K024     /2K025     /2K026';

		$avviso3 = ' /2K050     /2K051     /2K052     /2K053     /2K054     /2K055     /2K057     /2K058     /2K059     /2K060     /2K061     /2K062';
		
		$avviso4 = ' /2K027     /2K028     /2K029     /2K036     /2K037     /2K038     /2K039     /2K040     /2K041     /2K043     /2K046     /2K047     /2K049';

		$avviso5 = ' /2K063     /2K065     /2K066     /2K067     /2K068     /2K069     /2K070     /2K071     /2K072     /2K073     /2K074     /2K076     /2K078';
		
		$avviso6 = ' /2K079     /K2081     /2K082     /2K083     /2K084     /2K085     /2K086     /2K087     /2K088     /2K089     /2K090     /2K091';

		$avviso7 = ' /2K092     /2K093     /2K094     /2K095     /2K096     /2K097     /2K098     /2K099     /2K100     /2K101     /2K102     /2K105     /2K274';
		
		$avviso8 = ' /2K280     /2K284     /2K285     /2K287     /2K293     /2K301     /2K310     /2K311     /2K312     /2K313     /2K314     /2K315';

		$avviso9 = ' /2K316     /2K317     /2K318     /2K324';
		
		$avviso10 = $avviso1."   ".$avviso2."   ".$avviso3."   ".$avviso4."   ".$avviso5."   ".$avviso6."   ".$avviso7."   ".$avviso8."   ".$avviso9;     

		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso10);
			  
		}//fine if text === /2	      		
	
	//$testo = substr($text, 0, 3); // otteniamo dal primo fino al 3°)  
	else if(($testo = substr($text, 0, 3)) === '/2K'){
		//inizializzo e azzero le variabili
		$info1 = $info2 = $info3 = $info4 = $info5 =$info6 =$info7 =$info8 =$info9 =$info10 =$info11 =$info12 =$info13 =$info14 = $info15 = 0;
		
		//$sub3 = substr($stringa, 1, 0); // otteniamo 'niscrip' (parte dal 2° ed arriva fino al ultimo) 
		$scelta = substr($text, 2, 4);
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$scelta);
		
		//scarico i dati dalla tabella Caldaie_Bruciatori.json posta su altervista
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
      			 $info10=$info['cod_impianto'];	
			
			 $info11 = str_replace("/7", "", $info10);
			
			 $info12 = $scelta;
			
			 $info13 = "-Codice Impianto: ".$info10;
			
			if($info11 == $scelta){
		        	 //salva i dati delle variabili dentro il array
				$datos[0][0][0][0][0][0][0][0][0][0] = "$info11"."$info13"."$info12"."$info1"."$info2"."$info3"."$info4"."$info5"."$info6"."$info7"."$info8"."$info9"."$scelta";
			}			
			//variabile di controllo per il numero di caldaie
			$cn = $cn + 1;	
			
	   		}//fine foreach
		
		$xx = 0;
		foreach($datos as $sequenza){
  			
			http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text="." - ".$datos[$xx][$xx][$xx][$xx][$xx][$xx][$xx][$xx][$xx][$xx]);
  			$xx = $xx + 1;
		}//fine confronto impianti con foreach
		
		
		$messaggio = 'numero di caldaie';
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio.$cn.$datos[$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn]);
		
		
		$avviso = 'Menu del servizio di messaggistica sulla Gestione Calore scelga una opzione:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		$avviso = '/menu   /ora';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		
		}//fine scelta /2K
		

	
		//3   Visualizza pronto intervento su un determinato impianto.";
	else if($text === '/3'){
	   	
		//inizializzo e azzero le variabili
		$info1 = $info2 = $info3 = $info4 = $info5 =$info6 =$info7 =$info8 =$info9 =$info10 =$info11 =$info12 =$info13 =$info14 = $info15 = 0;
		
		$avviso = 'Selezionare impianto da consultare gli interventi in pronto intervento:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		$avviso1 = ' /3K001     /3K002     /3K003     /3K004     /3K005     /3K006     /3K007     /3K008     /3K009     /3K010     /3K011     /3K012     /3K014';
		
		$avviso2 = ' /3K015     /3K016     /3K017     /3K018     /3K019     /3K020     /3K021     /3K022     /3K023     /3K024     /3K025     /3K026';

		$avviso3 = ' /3K050     /3K051     /3K052     /3K053     /3K054     /3K055     /3K057     /3K058     /3K059     /3K060     /3K061     /3K062';
		
		$avviso4 = ' /3K027     /3K028     /3K029     /3K036     /3K037     /3K038     /3K039     /3K040     /3K041     /3K043     /3K046     /3K047     /3K049';

		$avviso5 = ' /3K063     /3K065     /3K066     /3K067     /3K068     /3K069     /3K070     /3K071     /3K072     /3K073     /3K074     /3K076     /3K078';
		
		$avviso6 = ' /3K079     /3K081     /3K082     /3K083     /3K084     /3K085     /3K086     /3K087     /3K088     /3K089     /3K090     /3K091';

		$avviso7 = ' /3K092     /3K093     /3K094     /3K095     /3K096     /3K097     /3K098     /3K099     /3K100     /3K101     /3K102     /3K105     /3K274';
		
		$avviso8 = ' /3K280     /3K284     /3K285     /3K287     /3K293     /3K301     /3K310     /3K311     /3K312     /3K313     /3K314     /3K315';

		$avviso9 = ' /3K316     /3K317     /3K318     /3K324';
		
		$avviso10 = $avviso1."   ".$avviso2."   ".$avviso3."   ".$avviso4."   ".$avviso5."   ".$avviso6."   ".$avviso7."   ".$avviso8."   ".$avviso9;     

		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso10);
			  
		}//fine if text === /3      		
	
	//$testo = substr($text, 0, 3); // otteniamo dal primo fino al 3°)  
	else if(($testo = substr($text, 0, 3)) === '/3K'){
		//inizializzo e azzero le variabili
		$info1 = $info2 = $info3 = $info4 = $info5 =$info6 =$info7 =$info8 =$info9 =$info10 =$info11 =$info12 =$info13 =$info14 = $info15 = 0;
		
		//$sub3 = substr($stringa, 1, 0); // otteniamo 'niscrip' (parte dal 2° ed arriva fino al ultimo) 
		$scelta = substr($text, 2, 4);
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$scelta);
		
		//scarico i dati dalla tabella Pronto_Intervento.json posta su altervista
    		$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Pronto_Intervento.json');
    		//richiesta della risposta HTTP come stringa
    		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    		//esecuzione della richiesta HTTP
    		$response = curl_exec($handle);
    		//estrazione del codice di risposta (HTTP status)
    		$http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));		
	
   		$data = json_decode($response, true);
		   
		//salva i dati degli interventi nelle variabili
    	 	foreach ($data as $info) { 
        			
			//Dati della persona chiamante
      			 $info1="-Chiamante: ".$info['Chiamante'];
			
      			 //Data di assegnazione della chiamata
      			 $info2=" -Data assegnazione: ".$info['Data_Assegnazione'];
       
      			 //datadell'intervento
      		 	 $info3="  -Data intervento: ".$info['Data_Intervento'];
       
      			 //Descrizione della chiamata
      			 $info4="  -Descrizione chiamata: ".$info['Descrizione_Chiamata'];
        
      			 //Descrizione della chiamata
      			 $info5="  -Id della chiamata: ".$info['ID_Chiamata'];      	
	       
      			 //Descrizione della chiamata
      			 $info6="  -Numero chiamata: ".$info['Id'];		
			
	       
      			 //Descrizione della chiamata
      			 $info7="  -Tempo di risposta della chiamata: ".$info['Tempo_Risposta'];		
	
      			 //codice dell'impianto
      			 $info8=$info['cod_impianto'];			
       
			 $info9 = str_replace("/3", "", $info8);
			
			 $info10 = $scelta;
			
			 $info11 = "-Codice Impianto: ".$info8;
			
			if($info8 == $info10){
		        	 //salva i dati delle variabili dentro il array
				
				$datos[$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn] = "$info9"."$info6"."$info5"."$info2"."$info3"."$info4"."$info7"."$info1";
				//variabile di controllo per il indice del array
				$cn = $cn + 1;
				
			}			

				
	   		}//fine foreach
		
		//$prontoint variabile per dicitura
		$prontoint = 'Dettagli delle chiamate in pronto intervento del impianto: ';
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$prontoint.$info9);
		
		$xx = 0;
		foreach($datos as $sequenza){
  			
			http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text="." - ".$datos[$xx][$xx][$xx][$xx][$xx][$xx][$xx][$xx]);
			//$xx variabile di controllo per il ciclo
			$xx = $xx + 1;
		}//fine confronto impianti con foreach$xx][$xx][$xx][$xx][$xx][$xx][$xx][$xx][$xx]);
  			

		
		$avviso = 'Menu del servizio di messaggistica sulla Gestione Calore scelga una opzione:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		$avviso = '/menu   /ora';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		
		}//fine scelta /3K

	
	///4   Visualizza gli interventi effettuati negli impianti.";
	else if($text === '/4'){
		//inizializzo e azzero le variabili
		$info1 = $info2 = $info3 = $info4 = $info5 =$info6 =$info7 =$info8 =$info9 =$info10 =$info11 =$info12 =$info13 =$info14 = $info15 = 0;
		
		$avviso = 'Interventi effettuati negli impianti:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		//scarico i dati dalla tabella Interventi.json posta su altervista
    		$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Interventi.json');
    		//richiesta della risposta HTTP come stringa
    		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    		//esecuzione della richiesta HTTP
    		$response = curl_exec($handle);
    		//estrazione del codice di risposta (HTTP status)
    		$http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));		
		
   		$data = json_decode($response, true);
     
    	 	foreach ($data as $info) { 
	     		
			//Cognome del manutentore
      			 $info1="-Cognome: ".$info['Cognome_Manutentore'];
			
      			 //Data dell'intervento
      			 $info2=" -Data Intervento: ".$info['Data_Intervento'];
       
      			 //descrizione dell'intervento
      		 	 $info3="  -Descrizione: ".$info['Descrizione_Intervento'];
       
      			 //Nome manutentore
      			 $info4="  -Nome: ".$info['Nome_Manutentore'];
       	
     		 	 //codice dell'impianto
      			 $info5="  -Codice del Impianto: ".$info['cod_impianto'];
       	
			//salva i dati delle variabili nel array
      	      	        $datos[$cn][$cn][$cn][$cn][$cn] = "$info5"." ". "$info2"." "."$info3"." ". "$info1"." "."$info4";
        		
			//variabile di controllo per il indice del array
			$cn = $cn + 1;
			
		
		}//fine foreach data as info
		
		$cn = $cn - 1;
		$ct = 0;
		$indice = 1;
		
		foreach($datos as $elemento){
			
			http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$indice." - ".$datos[$ct][$ct][$ct][$ct][$ct]);
			$ct = $ct + 1;
			$indice = $indice + 1;
			if($ct === $cn){
				$ct = " ";
			}//fine if ct === cn
		}//fine foreach datos as elemento
		
		$avviso = 'Menu del servizio di messaggistica sulla Gestione Calore scelga una opzione:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		$avviso = '/menu   /ora';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
	  
	}//fine if /4


	///5   Visualizza l'ultima lettura effettuata e la matricola del contatore gas.";
	else if($text === '/5'){
		//inizializzo e azzero le variabili
		$info1 = $info2 = $info3 = $info4 = $info5 =$info6 =$info7 =$info8 =$info9 =$info10 =$info11 =$info12 =$info13 =$info14 = $info15 = 0;
		
		$avviso = 'Ultima lettura dei contatori gas degli impianti:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		
		$avviso = 'Selezionare impianto da consultare gli interventi in pronto intervento:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		$avviso1 = ' /5K001     /5K002     /5K003     /5K004     /5K005     /5K006     /5K007     /5K008     /5K009     /5K010     /5K011     /5K012     /5K014';
		
		$avviso2 = ' /5K015     /5K016     /5K017     /5K018     /5K019     /5K020     /5K021     /5K022     /5K023     /5K024     /5K025     /5K026';

		$avviso3 = ' /5K050     /5K051     /5K052     /5K053     /5K054     /5K055     /5K057     /5K058     /5K059     /5K060     /5K061     /5K062';
		
		$avviso4 = ' /5K027     /5K028     /5K029     /5K036     /5K037     /5K038     /5K039     /5K040     /5K041     /5K043     /5K046     /5K047     /5K049';

		$avviso5 = ' /5K063     /5K065     /5K066     /5K067     /5K068     /5K069     /5K070     /5K071     /5K072     /5K073     /5K074     /5K076     /5K078';
		
		$avviso6 = ' /5K079     /5K081     /5K082     /5K083     /5K084     /5K085     /5K086     /5K087     /5K088     /5K089     /5K090     /5K091';

		$avviso7 = ' /5K092     /5K093     /5K094     /5K095     /5K096     /5K097     /5K098     /5K099     /5K100     /5K101     /5K102     /5K105     /5K274';
		
		$avviso8 = ' /5K280     /5K284     /5K285     /5K287     /5K293     /5K301     /5K310     /5K311     /5K312     /5K313     /5K314     /5K315';

		$avviso9 = ' /5K316     /5K317     /5K318     /5K324';
		
		$avviso10 = $avviso1."   ".$avviso2."   ".$avviso3."   ".$avviso4."   ".$avviso5."   ".$avviso6."   ".$avviso7."   ".$avviso8."   ".$avviso9;     

		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso10);
			  
		}//fine if text === /5      		
	
	//$testo = substr($text, 0, 3); // otteniamo dal primo fino al 3°)  
	else if(($testo = substr($text, 0, 3)) === '/5K'){
		//inizializzo e azzero le variabili
		$info1 = $info2 = $info3 = $info4 = $info5 =$info6 =$info7 =$info8 =$info9 =$info10 =$info11 =$info12 =$info13 =$info14 = $info15 = 0;
		
		$scelta = substr($text, 2, 4);
		
		//scarico i dati dalla tabella Elenco_Impianti.json posta su altervista per strarre ID_Descrizione
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
        		$info5=$info['Contratto'];
	     
			//salva la descrizione dell'impianto
       			$info6=$info['Id_Descrizione'];
       
       			//salva la data contratto
      	      	        $info7=$info['cod_impianto'];
			
			$info11 = str_replace("/5", "", $info7);
			
			$info12 = " - ".$info6;
			
			if($info11 === $scelta){
			
				//Salvo la denominazione del impianto in una variabile dedicata
				$info13 = $info6;
				
		       		//salva i dati delle variabili dentro il array impianti
				$impianti[0][0] = "$info11"."$info12";
			}	
			//variabile di controllo per il indice del array
			$cl = $cl + 1;
			
		
		}//fine foreach data as info K impianti	

		//scarico i dati dalla tabella Matr_Cont_Cod_Serv.json corrispondenti al ID_Descrizione  per strarre il Cod_Servizio posta su altervista
		$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Matricola.json');
    		//richiesta della risposta HTTP come stringa
    		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    		//esecuzione della richiesta HTTP
    		$response = curl_exec($handle);
    		//estrazione del codice di risposta (HTTP status)
    		$http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));		
		
   		$data = json_decode($response, true);
     
    	 	foreach ($data as $info) { 
	     
        		//salva il codice dell'impianto        
        		$info8=$info['Id_Descrizione'];
	     
			//salva la descrizione dell'impianto
       			$info9=$info['Cod_Servizio'];
       
       			//salva la data contratto
      	      	        $info10=" ".$info['Matr_Contatore'];
			
			if($info8 === $info13){
				//salvo i dati del codice di servizio del impianto scelto
				$info14 = $info9;
				
				//salva i dati delle variabili nel array
      	      	        	$matricola[0][0][0] = "$info8"."$info9"."$info10";
			}
			
			//variabile di controllo per il indice del array
			$cp = $cp + 1;
			
		
		}//fine foreach
		
		//scarico i dati dalla tabella Ultima_Lettura.json con il Cod_Servizio precedente posti su altervista
    		$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Ultima_Lettura.json');
    		//richiesta della risposta HTTP come stringa
    		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    		//esecuzione della richiesta HTTP
    		$response = curl_exec($handle);
    		//estrazione del codice di risposta (HTTP status)
    		$http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));		
		
   		$data = json_decode($response, true);
     
    	 	foreach ($data as $info) { 
	     
        		//salva il codice dell'impianto        
        		$info1=$info['Cod_Servizio'];
	     
			//salva la descrizione dell'impianto
       			$info2=" - Lettura: ".$info['Lettura_Consumo'];
       
       			//salva la data contratto
      	      	        $info3=" - Matricola del contatore gas: ".$info['Matr_Contatore'];
			
			//salva i dati nella variabile
			$info4 =" - Codice di servizio: ".$info1;
        		
			if($info1 === $info14){
				//salva i dati delle variabili nel array lettura
      	      	        	$lettura[0][0][0] = "$info4"."$info2"."$info3";
			}
			
			
			//variabile di controllo per il indice del array
			$cn = $cn + 1;
			
		}//fine foreach data as info ultima lettura
	     
		$xx = 0;
		foreach($impianti as $sequenza){
  			
			http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text="." - ".$impianti[$xx][$xx]);
  			$xx = $xx + 1;
		}//fine confronto impianti con foreach		
		
		
		$xx = 0;
		foreach($lettura as $sequenza){
  			
			http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text="." - ".$lettura[$xx][$xx][$xx]);
  			$xx = $xx + 1;
		}//fine lettura con foreach
		
		
		$xx = 0;
		foreach($matricola as $sequenza){
  			
			http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text="." - ".$matricola[$xx][$xx][$xx]);
  			$xx = $xx + 1;
		}// fine matricola contatore con foreach		
		
	
		$avviso = 'Menu del servizio di messaggistica sulla Gestione Calore scelga una opzione:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		$avviso = '/menu   /ora';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
	  
	}//fine if /5

	
	///6   Visualizza i consumi di un determinato impianto
	else if($text === '/6'){
		//inizializzo e azzero le variabili
		$info1 = $info2 = $info3 = $info4 = $info5 =$info6 =$info7 =$info8 =$info9 =$info10 =$info11 =$info12 =$info13 =$info14 = $info15 = 0;
		
	   	$avviso = 'Selezionare impianto da consultare il consumo:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		$avviso1 = ' /6K001     /6K002     /6K003     /6K004     /6K005     /6K006     /6K007     /6K008     /6K009     /6K010     /6K011     /6K012     /6K014';
		
		$avviso2 = ' /6K015     /6K016     /6K017     /6K018     /6K019     /6K020     /6K021     /6K022     /6K023     /6K024     /6K025     /6K026';
		$avviso3 = ' /6K050     /6K051     /6K052     /6K053     /6K054     /6K055     /6K057     /6K058     /6K059     /6K060     /6K061     /6K062';
		
		$avviso4 = ' /6K027     /6K028     /6K029     /6K036     /6K037     /6K038     /6K039     /6K040     /6K041     /6K043     /6K046     /6K047     /6K049';
		$avviso5 = ' /6K063     /6K065     /6K066     /6K067     /6K068     /6K069     /6K070     /6K071     /6K072     /6K073     /6K074     /6K076     /6K078';
		
		$avviso6 = ' /6K079     /6K081     /6K082     /6K083     /6K084     /6K085     /6K086     /6K087     /6K088     /6K089     /6K090     /6K091';
		$avviso7 = ' /6K092     /6K093     /6K094     /6K095     /6K096     /6K097     /6K098     /6K099     /6K100     /6K101     /6K102     /6K105     /6K274';
		
		$avviso8 = ' /6K280     /6K284     /6K285     /6K287     /6K293     /6K301     /6K310     /6K311     /6K312     /6K313     /6K314     /6K315';
		$avviso9 = ' /6K316     /6K317     /6K318     /6K324';
		
		$avviso10 = $avviso1."   ".$avviso2."   ".$avviso3."   ".$avviso4."   ".$avviso5."   ".$avviso6."   ".$avviso7."   ".$avviso8."   ".$avviso9;     
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso10);
			        		
		}//fine if text === /6     		
	
	//$testo = substr($text, 0, 3); // otteniamo dal primo fino al 3°)  
	else if(($testo = substr($text, 0, 3)) === '/6K'){
		//inizializzo e azzero le variabili
		$info1 = $info2 = $info3 = $info4 = $info5 =$info6 =$info7 =$info8 =$info9 =$info10 =$info11 =$info12 =$info13 =$info14 = $info15 = 0;
		
		$scelta = substr($text, 2, 4);
	
		//scarico i dati dalla tabella Elenco_Impianti.json posta su altervista per strarre ID_Descrizione
		$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Elenco_Impianti.json');
    		//richiesta della risposta HTTP come stringa
    		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    		//esecuzione della richiesta HTTP
    		$response = curl_exec($handle);
    		//estrazione del codice di risposta (HTTP status)
    		$http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));		
		
   		$data = json_decode($response, true);
     
    	 	foreach ($data as $info) { 
	     
        		//salva il contratto dell'impianto       
        		$info5=$info['Contratto'];
	     
			//salva la descrizione dell'impianto
       			$info6=$info['Id_Descrizione'];
       
       			//salva il codice dell'impianto
      	      	        $info7=$info['cod_impianto'];
			
			$info11 = str_replace("/6", "", $info7);
			
			$info12 = " - ".$info6;
			
			if($info11 === $scelta){

				//Salvo la denominazione del impianto in una variabile dedicata
				$info13 = $info6;
				
		       		//salva i dati delle variabili dentro il array impianti
				$impianti[0][0] = "$info11"."$info12";
			}	
			
		
		}//fine foreach data as info K impianti	

		//scarico i dati dalla tabella Matr_Cont_Cod_Serv.json corrispondenti al ID_Descrizione  per strarre il Cod_Servizio posta su altervista
		$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Matricola.json');
    		//richiesta della risposta HTTP come stringa
    		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    		//esecuzione della richiesta HTTP
    		$response = curl_exec($handle);
    		//estrazione del codice di risposta (HTTP status)
    		$http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));		
		
   		$data = json_decode($response, true);
     
    	 	foreach ($data as $info) { 
	     
        		//salva il codice dell'impianto        
        		$info8=$info['Id_Descrizione'];
	     
			//salva la descrizione dell'impianto
       			$info9=$info['Cod_Servizio'];
       
       			//salva la data contratto
      	      	        $info10=" -Matricola contatore: ".$info['Matr_Contatore'];
			
			if($info8 === $info13){

				//salvo i dati del codice di servizio del impianto scelto
				$info14 = $info9;
				
				//salva i dati delle variabili nel array
      	      	        	$matricola[0][0] = "$info9"."$info10";
			}
				
		
		}//fine foreach
		
		//scarico i dati dalla tabella Ultima_Lettura.json con il Cod_Servizio precedente posti su altervista
    		$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/consumi.json');
    		//richiesta della risposta HTTP come stringa
    		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    		//esecuzione della richiesta HTTP
    		$response = curl_exec($handle);
    		//estrazione del codice di risposta (HTTP status)
    		$http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));		
		
   		$data = json_decode($response, true);
     
    	 	foreach ($data as $info) { 
	     
        		//salva il codice dell'impianto        
        		$info1=$info['Cod_Servizio'];
	     
			//salva la data della lettura
       			$info2=" - Data Lettura: ".$info['data_lettura'];
       
       			//salva il consumo
      	      	        $info3=" - Lettura del consumo: ".$info['lettura'];
			
			//salva il codice di servizio
			$info4 =" - Codice di servizio: ".$info1;
        		
			if($info1 === $info14){

				//salva i dati delle variabili nel array consumo
      	      	        	$consumo[$cn][$cn] = "$info2"."$info3";
				//variabile di controllo per l'array
				$cn = $cn + 1;
			}	
			
		}//fine foreach data as info ultima lettura
		     
		$xx = 0;
		foreach($impianti as $sequenza){
			
  			$leggenda = "Impianto: ";
			http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$leggenda.$impianti[$xx][$xx]);
  			$xx = $xx + 1;
		}//fine confronto impianti con foreach		
		
		
		$xx = 0;
		foreach($matricola as $sequenza){
  			
			$leggenda = "Codice di servizio: ";
			http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$leggenda.$matricola[$xx][$xx]);
  			$xx = $xx + 1;
		}//fine lettura con foreach
		
		
		$xx = 0;
		foreach($consumo as $sequenza){
  			
			http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text="." ".$consumo[$xx][$xx]);
  			$xx = $xx + 1;
		}// fine matricola contatore con foreach		
		
	
		$avviso = 'Menu del servizio di messaggistica sulla Gestione Calore scelga una opzione:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		$avviso = '/menu   /ora';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
	  
	}//fine if /6
	

	///7   Visualizza le ore ordinarie di funzionamento.";
	else if($text === '/7'){
		
		//inizializzo e azzero le variabili
		$info1 = $info2 = $info3 = $info4 = $info5 =$info6 =$info7 =$info8 =$info9 =$info10 =$info11 =$info12 =$info13 =$info14 = $info15 = 0;
		$cb = 0;
		
		//scarico i dati dalla tabella Elenco_Impianti.json posta su altervista per strarre ID_Descrizione
		$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Elenco_Impianti.json');
    		//richiesta della risposta HTTP come stringa
    		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    		//esecuzione della richiesta HTTP
    		$response = curl_exec($handle);
    		//estrazione del codice di risposta (HTTP status)
    		$http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));		
		
   		$data = json_decode($response, true);
     
    	 	foreach ($data as $info) { 
	     
        		//salva il contratto dell'impianto       
        		$info1=$info['Contratto'];
	     
			//salva la descrizione dell'impianto
       			$info2=$info['Id_Descrizione'];
       
       			//salva il codice dell'impianto
      	      	        $info3=$info['cod_impianto'];
				
		       	//salva i dati delle variabili dentro il array impianti
			$impianti[$cb][$cb] = "$info3"."$info2";
			
			//variabile di controllo per l'indice dell'array
			$cb = $cb + 1;
		
		}//fine foreach data as info K impianti	
		
		//inizializzo e azzero le variabili
		$info1 = $info2 = $info3 = $info4 = $info5 =$info6 =$info7 =$info8 =$info9 =$info10 =$info11 =$info12 =$info13 =$info14 = $info15 = 0;
		$ca = 0;
		
		//scarico i dati dalla tabella funzionamento per confrontarlo con il codice impianto
		$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/funzionamento.json');
    		//richiesta della risposta HTTP come stringa
    		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    		//esecuzione della richiesta HTTP
    		$response = curl_exec($handle);
    		//estrazione del codice di risposta (HTTP status)
    		$http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));		
		
   		$data = json_decode($response, true);
     
    	 	foreach ($data as $info) { 
	     
        		//salva il contratto dell'impianto       
        		$info1=$info['Ordinarie'];
	     
			//salva la descrizione dell'impianto
       			$info2=$info['cod_impianto'];
			
		       	//salva i dati delle variabili dentro il array impianti
			$ordinarie[$ca][$ca] = "$info2"."$info1";
			
			//variabile di controllo per l'indice dell'array
			$ca = $ca + 1;
		
		}//fine foreach ordinarie
		
		for($cont = 0; $cont < $cb){
			for($car = 0; $car < $ca){
				if($impianti[$cb][] === $orinarie[$car][]){
					$messaggio = 'trovato: ';
					http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio);
				}
				$car = $car + 1;
			}//fine for interno
			$cb = $cb + 1;
		}//fine for esterno
		/*
		foreach($impianti as $risparmio){
			foreach($ordinarie as $confronto){
				if (in_array($impianti, $ordinarie))
			 	  {
					$messaggio = 'trovato: ';
					http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio." - ".$contatore);
					$contatore = $contatore + 1;
				
			  	  }
			}			
		}//fine foreach esterno impianti
		
		

		foreach ($arraySearch as $value)
			{
			if (in_array($value, $arrayList))
			{
			$arrayList[array_search($value, $arrayList)] .= '*';
			}
		}


		*/
		
		
		
		$messaggio = 'uscita /7';
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio);
		
		
		$avviso = 'Menu del servizio di messaggistica sulla Gestione Calore scelga una opzione:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		$avviso = '/menu   /ora';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		
		}//fine scelta /7K
	

	
	
	//stampa ora
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
		
		$avviso = 'Menu del servizio di messaggistica sulla Gestione Calore scelga una opzione:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		$avviso = '/menu   /ora';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);

	}//fine elseif info ora
	
	//se non viene inserita una delle scelte del menu oppure inserita qualunque cosa.
	else{	
		$avviso = 'Menu del servizio di messaggistica sulla Gestione Calore scelga una opzione:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		$avviso = '/menu   /ora';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
	}//fine else menu
	
}//fine else principale
?>



