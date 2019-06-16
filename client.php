<?php
/* File contenente il codice sorgente del client */

//includiamo file contenente le funzioni usate dal client
require 'functions.php';

//stampa info programmatore e client
echo "\n--------------------------------------\n";
echo "|   Progetto PDGT  A.A. 2017/2018     |\n";
echo "|   Studente: Pedro Antonio Basto     |\n";
echo "|         Matricola: 243735           |\n";
echo "--------------------------------------\n\n";

$close_client = 1;    //impostiamo variabile di controllo ciclo do-while del menù

$impianto = null;     //inizializziamo la variabile

//entriamo nel menù
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
?>
