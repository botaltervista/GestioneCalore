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


/*
//////////
$sito = getenv("SITO");
$password = getenv("ENTRATA");

mysql_connect('localhost','sito','password');
my_sql_select_db('my_tayrona');

//*************

$Search = mysql_qery("SELECT * FROM `collegamentotelegram` WHERE `NomeCMD` LIKE '%message%'");

while($Riga=mysql_fetch_assoc($Search))
{
	$Text = $Riga["Messaggio"];
	$CMD = $Riga["NomeCMD"];
	$ID = $Riga["ID"];
}

//*************
*/

//////////


//****************************

/**
 * Creates or retrieves a connection to the database.
 * @param bool $quick True if the connection should be returned untested.
 * @return object A valid connection to the database.
 */
function db_open_connection($quick = false) {
    if(isset($GLOBALS['db_connection'])) {
        $connection = $GLOBALS['db_connection'];

        if(!$quick) {
            // Ping the connection just to be safe
            // This can be removed for performance since we usually have no
            // long-running scripts.
            if(!mysqli_ping($connection)) {
                error_log('Database connection already open but does not respond to ping');
                die();
            }
        }

        return $connection;
    }
    else {
        // Check configuration
        if(!DATABASE_USERNAME || !DATABASE_NAME) {
            error_log('Please configure the database connection in file config.php');
            die();
        }

        // Open up a new connection
        $connection = mysqli_connect(ftp.tayrona.altervista.org, tayrona, kpp2ztqRBFZD, my_tairona);

        if(!$connection) {
            $errno = mysqli_connect_errno();
            $error = mysqli_connect_error();
            error_log("Failed to establish database connection. Error #$errno: $error");
            die();
        }

        // Store connection for later
        $GLOBALS['db_connection'] = $connection;

        // Register clean up function for termination
        register_shutdown_function('db_close_connection');

        return $connection;
    }
}

//****************************






////////////////////////

//aggiunto da controllare funzionamento
	$ora = date('H'), date('i');
	$giorno = date('d/m/Y');	
$message = "".$name." sono le: $ora, del giorno: $giorno";  

$ore = date('H'), date('i');

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
    $message1 = "Buon notte";
break;

default:
    $message1 = "Buon mattino";
break;

}

///////////////////////////////

$url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&text=" . urlencode("$message1 $message\nMi hai scritto questo: {$text}");
//stringa convertita per inserire nell'url per essere compattibile

error_log("URL: " . $url);

$handle = curl_init($url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_POST, true);
$response = curl_exec($handle);

error_log("sendMessage: " . $response);
