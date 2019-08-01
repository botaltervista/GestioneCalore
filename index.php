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
		
  		$messaggio1 = " /3   Visualizza gli interventi effettuati negli impianti.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);
		
  		$messaggio1 = " /4   Visualizza le ore ordinarie di funzionamento.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);
		
	  	$messaggio1 = " /5   Visualizza l'ultima lettura effettuata del contatore gas.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);  		
		
  		$messaggio1 = " /6   Visualizza i consumi degli impianti.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);		
		
		$messaggio1 = " /7   Visualizza la matricola dei contatori gas.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);
		
  		$messaggio1 = " /8   Visualizza pronto intervento.";
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio1);
  		
	}
	
	//se viene inserita la scelta /1
	else if($text === '/1'){
		
		$avviso = 'Elenco e denominazione degli impianti in servizio attualmente:';
		
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

	  
	}//fine if /1
	
	//se viene inserita la scelta /2
	else if($text === '/2'){
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
      			 $info10=$info['cod_impianto'];	
			
			 $info11 = str_replace("/7", "", $info10);
			
			 $info12 = $scelta;
			
			 $info13 = "-Codice Impianto: ".$info10;
			
			if($info11 == $info12){
				//$messaggio = 'numero di caldaie presenti e numero impianto';
				//http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio.$cn."  ".$scelta."  ".$info11);
		
		        	 //salva i dati delle variabili dentro il array
				//$datos[$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn] = "$info11"."$info13"."$info12"."$info1"."$info2"."$info3"."$info4"."$info5"."$info6"."$info7"."$info8"."$info9"."$scelta";
				$datos[0][0][0][0][0][0][0][0][0][0] = "$info11"."$info13"."$info12"."$info1"."$info2"."$info3"."$info4"."$info5"."$info6"."$info7"."$info8"."$info9"."$scelta";
			}			
			//variabile di controllo per il indice del array
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
		

	
		//se viene inserita la scelta /2
	else if($text === '/3'){
	   	$avviso = 'Selezionare impianto da consultare gli interventi effettuati:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		$avviso1 = ' /3K001     /3K002     /3K003     /3K004     /3K005     /3K006     /3K007     /3K008     /3K009     /3K010     /3K011     /3K012     /2K014';
		
		$avviso2 = ' /3K015     /3K016     /3K017     /3K018     /3K019     /3K020     /3K021     /3K022     /3K023     /3K024     /3K025     /3K026';

		$avviso3 = ' /3K050     /3K051     /3K052     /3K053     /3K054     /3K055     /3K057     /3K058     /3K059     /3K060     /3K061     /3K062';
		
		$avviso4 = ' /3K027     /3K028     /3K029     /3K036     /3K037     /3K038     /3K039     /3K040     /3K041     /3K043     /3K046     /3K047     /2K049';

		$avviso5 = ' /3K063     /3K065     /3K066     /3K067     /3K068     /3K069     /3K070     /3K071     /3K072     /3K073     /3K074     /3K076     /2K078';
		
		$avviso6 = ' /3K079     /3K081     /3K082     /3K083     /3K084     /3K085     /3K086     /3K087     /3K088     /3K089     /3K090     /3K091';

		$avviso7 = ' /3K092     /3K093     /3K094     /3K095     /3K096     /3K097     /3K098     /3K099     /3K100     /3K101     /3K102     /3K105     /2K274';
		
		$avviso8 = ' /3K280     /3K284     /3K285     /3K287     /3K293     /3K301     /3K310     /3K311     /3K312     /3K313     /3K314     /3K315';

		$avviso9 = ' /3K316     /3K317     /3K318     /3K324';
		
		$avviso10 = $avviso1."   ".$avviso2."   ".$avviso3."   ".$avviso4."   ".$avviso5."   ".$avviso6."   ".$avviso7."   ".$avviso8."   ".$avviso9;     

		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso10);
			  
		}//fine if text === /2	      		
	
	//$testo = substr($text, 0, 3); // otteniamo dal primo fino al 3°)  
	else if(($testo = substr($text, 0, 3)) === '/3K'){
		
		//$sub3 = substr($stringa, 1, 0); // otteniamo 'niscrip' (parte dal 2° ed arriva fino al ultimo) 
		$scelta = substr($text, 2, 4);
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$scelta);
		
		//$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Caldaie_Bruciatori.json');
    		$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Interventi.json');
    		//richiesta della risposta HTTP come stringa
    		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    		//esecuzione della richiesta HTTP
    		$response = curl_exec($handle);
    		//estrazione del codice di risposta (HTTP status)
    		$http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));		
	
   		$data = json_decode($response, true);
		   
		//salva i dati degli interventi nelle variabili
    	 	foreach ($data as $info) { 
        			
			//Cognome del manutentore
      			 $info1="-Cognome Manutentore: ".$info['Cognome_Manutentore'];
			
      			 //Data dell'intervento
      			 $info2=" -Data Intervento: ".$info['Data_Intervento'];
       
      			 //descrizione dell'intervento
      		 	 $info3="  -Descrizione: ".$info['Descrizione_Intervento'];
       
      			 //Nome manutentore
      			 $info4="  -Nome Manutentore: ".$info['Nome_Manutentore'];
       	
     		 	 //codice dell'impianto
      			 $info5="  -Codice del Impianto: ".$info['cod_impianto'];
       
			 $info6 = str_replace("/3", "", $info5);
			
			 $info7 = $scelta;
			
			 $info8 = "-Codice Impianto: ".$info5;
			
			if($info6 == $info7){
		        	 //salva i dati delle variabili dentro il array
				
				$datos[$cn][$cn][$cn][$cn][$cn] = "$info5"."$info1"."$info4"."$info2"."$info3";
				//variabile di controllo per il indice del array
				$cn = $cn + 1;
				
			}			
	
			

				
	   		}//fine foreach
		
		$cn = $cn - 1;
		$interventi = 'Numero di interventi effettuati nel impianto: ';
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$interventi.$cn);
		
		$xx = 0;
		foreach($datos as $sequenza){
  			
			http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text="." - ".$datos[$xx][$xx][$xx][$xx][$xx]);
			//$xx variabile di controllo per il ciclo
			$xx = $xx + 1;
		}//fine confronto impianti con foreach$xx][$xx][$xx][$xx][$xx][$xx]);
  			

		
		$avviso = 'Menu del servizio di messaggistica sulla Gestione Calore scelga una opzione:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		$avviso = '/menu   /ora';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		
		}//fine scelta /3K
	
	//////////////////////////////////////////////////////////////////////////
	
		//se viene inserita la scelta /2
	else if($text === '/4'){
	   	$avviso = 'Selezionare impianto da consultare le ore di funzionamento:';
		
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
	else if(($testo = substr($text, 0, 3)) === '/4K'){
		
		//$sub3 = substr($stringa, 1, 0); // otteniamo 'niscrip' (parte dal 2° ed arriva fino al ultimo) 
		$scelta = substr($text, 2, 4);
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$scelta);
		
		//$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Caldaie_Bruciatori.json');
    		$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Ore_Funzionamento.json');
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
			
			if($info10 == $info12){
				//$messaggio = 'numero di caldaie presenti e numero impianto';
				//http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio.$cn."  ".$scelta."  ".$info11);
		
		        	 //salva i dati delle variabili dentro il array
				//$datos[$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn] = "$info11"."$info13"."$info12"."$info1"."$info2"."$info3"."$info4"."$info5"."$info6"."$info7"."$info8"."$info9"."$scelta";
				$datos[0][0][0][0][0][0][0][0][0][0] = "$info11"."$info13"."$info12"."$info1"."$info2"."$info3"."$info4"."$info5"."$info6"."$info7"."$info8"."$info9"."$scelta";
			}			
			//variabile di controllo per il indice del array
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
		
		
		}//fine scelta /4K
	
	/////////////////////////////////////////////////////////////////
	
	//////////////////////////////////////////////////////////////////////////
	
		//se viene inserita la scelta /2
	else if($text === '/5'){
	   	$avviso = 'Selezionare impianto da consultare la ultima lettura del contatore gas:';
		
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
	else if(($testo = substr($text, 0, 3)) === '/5K'){
		
		//$sub3 = substr($stringa, 1, 0); // otteniamo 'niscrip' (parte dal 2° ed arriva fino al ultimo) 
		$scelta = substr($text, 2, 4);
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$scelta);
		
		//$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Caldaie_Bruciatori.json');
    		$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Ultima_Lettura.json');
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
			
			if($info10 == $info12){
				//$messaggio = 'numero di caldaie presenti e numero impianto';
				//http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio.$cn."  ".$scelta."  ".$info11);
		
		        	 //salva i dati delle variabili dentro il array
				//$datos[$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn] = "$info11"."$info13"."$info12"."$info1"."$info2"."$info3"."$info4"."$info5"."$info6"."$info7"."$info8"."$info9"."$scelta";
				$datos[0][0][0][0][0][0][0][0][0][0] = "$info11"."$info13"."$info12"."$info1"."$info2"."$info3"."$info4"."$info5"."$info6"."$info7"."$info8"."$info9"."$scelta";
			}			
			//variabile di controllo per il indice del array
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
		
		
		}//fine scelta /5K
	
	/////////////////////////////////////////////////////////////////
	
	//////////////////////////////////////////////////////////////////////////
	
		//se viene inserita la scelta /2
	else if($text === '/6'){
	   	$avviso = 'Selezionare impianto da consultare il consumo:';
		
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
	else if(($testo = substr($text, 0, 3)) === '/6K'){
		
		//$sub3 = substr($stringa, 1, 0); // otteniamo 'niscrip' (parte dal 2° ed arriva fino al ultimo) 
		$scelta = substr($text, 2, 4);
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$scelta);
		
		//$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Caldaie_Bruciatori.json');
    		$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Consumi_2000_2012.json');
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
			
			if($info10 == $info12){
				//$messaggio = 'numero di caldaie presenti e numero impianto';
				//http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio.$cn."  ".$scelta."  ".$info11);
		
		        	 //salva i dati delle variabili dentro il array
				//$datos[$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn] = "$info11"."$info13"."$info12"."$info1"."$info2"."$info3"."$info4"."$info5"."$info6"."$info7"."$info8"."$info9"."$scelta";
				$datos[0][0][0][0][0][0][0][0][0][0] = "$info11"."$info13"."$info12"."$info1"."$info2"."$info3"."$info4"."$info5"."$info6"."$info7"."$info8"."$info9"."$scelta";
			}			
			//variabile di controllo per il indice del array
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
		
		
		}//fine scelta /6K
	
	/////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////
	
		//se viene inserita la scelta /7
	else if($text === '/7'){
	   	$avviso = 'Selezionare impianto da consultare la matricola del contatore gas:';
		
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
	else if(($testo = substr($text, 0, 3)) === '/7K'){
		
		//$sub3 = substr($stringa, 1, 0); // otteniamo 'niscrip' (parte dal 2° ed arriva fino al ultimo) 
		$scelta = substr($text, 2, 4);
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$scelta);
		
		//$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Caldaie_Bruciatori.json');
    		$handle = curl_init('http://tayrona.altervista.org/prueva_database_json/database_json/Matr_Cont_Cod_Serv.json');
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
			
			if($info10 == $info12){
				//$messaggio = 'numero di caldaie presenti e numero impianto';
				//http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio.$cn."  ".$scelta."  ".$info11);
		
		        	 //salva i dati delle variabili dentro il array
				//$datos[$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn] = "$info11"."$info13"."$info12"."$info1"."$info2"."$info3"."$info4"."$info5"."$info6"."$info7"."$info8"."$info9"."$scelta";
				$datos[0][0][0][0][0][0][0][0][0][0] = "$info11"."$info13"."$info12"."$info1"."$info2"."$info3"."$info4"."$info5"."$info6"."$info7"."$info8"."$info9"."$scelta";
			}			
			//variabile di controllo per il indice del array
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
		
		
		}//fine scelta /7K
	
	/////////////////////////////////////////////////////////////////
	
	//////////////////////////////////////////////////////////////////////////
	
		//se viene inserita la scelta /2
	else if($text === '/8'){
	   	$avviso = 'Selezionare impianto da consultare le chiamate di pronto intervento:';
		
		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso);
		
		$avviso1 = ' /8K001     /8K002     /8K003     /8K004     /2K005     /2K006     /2K007     /2K008     /2K009     /2K010     /2K011     /2K012     /2K014';
		
		$avviso2 = ' /8K015     /8K016     /8K017     /8K018     /2K019     /2K020     /2K021     /2K022     /2K023     /2K024     /2K025     /2K026';

		$avviso3 = ' /8K050     /8K051     /8K052     /8K053     /2K054     /2K055     /2K057     /2K058     /2K059     /2K060     /2K061     /2K062';
		
		$avviso4 = ' /8K027     /8K028     /8K029     /8K036     /2K037     /2K038     /2K039     /2K040     /2K041     /2K043     /2K046     /2K047     /2K049';
		
		$avviso5 = ' /8K063     /8K065     /8K066     /8K067     /2K068     /2K069     /2K070     /2K071     /2K072     /2K073     /2K074     /2K076     /2K078';
		
		$avviso6 = ' /8K079     /8K081     /8K082     /8K083     /2K084     /2K085     /2K086     /2K087     /2K088     /2K089     /2K090     /2K091';

		$avviso7 = ' /8K092     /8K093     /8K094     /8K095     /2K096     /2K097     /2K098     /2K099     /2K100     /2K101     /2K102     /2K105     /2K274';
		
		$avviso8 = ' /8K280     /8K284     /8K285     /8K287     /2K293     /2K301     /2K310     /2K311     /2K312     /2K313     /2K314     /2K315';

		$avviso9 = ' /8K316     /8K317     /8K318     /8K324';
		
		$avviso10 = $avviso1."   ".$avviso2."   ".$avviso3."   ".$avviso4."   ".$avviso5."   ".$avviso6."   ".$avviso7."   ".$avviso8."   ".$avviso9;     

		http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$avviso10);
			  
		}//fine if text === /2	      		
	
	//$testo = substr($text, 0, 3); // otteniamo dal primo fino al 3°)  
	else if(($testo = substr($text, 0, 3)) === '/2K'){
		
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
      			 $info10=$info['cod_impianto'];	
			
			 $info11 = str_replace("/7", "", $info10);
			
			 $info12 = $scelta;
			
			 $info13 = "-Codice Impianto: ".$info10;
			
			if($info10 == $info12){
				//$messaggio = 'numero di caldaie presenti e numero impianto';
				//http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio.$cn."  ".$scelta."  ".$info11);
		
		        	 //salva i dati delle variabili dentro il array
				//$datos[$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn] = "$info11"."$info13"."$info12"."$info1"."$info2"."$info3"."$info4"."$info5"."$info6"."$info7"."$info8"."$info9"."$scelta";
				$datos[0][0][0][0][0][0][0][0][0][0] = "$info11"."$info13"."$info12"."$info1"."$info2"."$info3"."$info4"."$info5"."$info6"."$info7"."$info8"."$info9"."$scelta";
			}			
			//variabile di controllo per il indice del array
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
		
		
		}//fine scelta /8K
	
	/////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////
	
		//se viene inserita la scelta /2
	else if($text === '/9'){
	   	$avviso = 'Selezionare impianto da consultare';
		
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
      			 $info10=$info['cod_impianto'];	
			
			 $info11 = str_replace("/7", "", $info10);
			
			 $info12 = $scelta;
			
			 $info13 = "-Codice Impianto: ".$info10;
			
			if($info10 == $info12){
				//$messaggio = 'numero di caldaie presenti e numero impianto';
				//http_request("https://api.telegram.org/bot{$token}/sendMessage?chat_id=".$chat_id."&text=".$messaggio.$cn."  ".$scelta."  ".$info11);
		
		        	 //salva i dati delle variabili dentro il array
				//$datos[$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn][$cn] = "$info11"."$info13"."$info12"."$info1"."$info2"."$info3"."$info4"."$info5"."$info6"."$info7"."$info8"."$info9"."$scelta";
				$datos[0][0][0][0][0][0][0][0][0][0] = "$info11"."$info13"."$info12"."$info1"."$info2"."$info3"."$info4"."$info5"."$info6"."$info7"."$info8"."$info9"."$scelta";
			}			
			//variabile di controllo per il indice del array
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
		
		
		}//fine scelta /9K
	
	/////////////////////////////////////////////////////////////////
	
	
	
	
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



