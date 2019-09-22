Script to set webhook:

```bash
curl -F "url=https://<DYNONAME>.herokuapp.com/hook.php" https://api.telegram.org/bot<TOKEN>/setWebhook
```
Estrazione dati da Altervista sia in locale come in remoto.
Nella repository, ci sono presenti due tipi di consulta di dati sia in locale tramite i file: client.php, curl-lib.php, functions.php e la consulta di dati tramite il file index.php con l'interfacia tra Github, Heroku ed Altervista.
  Il file client contiene un menu:
  [1] stampa l'elenco degli impianti in servizio.
  [2] stampa i dettagli delle caldaie esistenti.
  [3] stampa gli interventi effettuati negli impianti.
  [4] stampa pronto intervento.
  [5] stampa il tipo di impianto e la denominazione.
  [6] stampa l'ultima lettura effettuata del contatore gas.
  [7] stampa la matricola dei contatori gas.
  [8] stampa i consumi degli impianti.
  [9] stampa le ore ordinarie di funzionamento.
  [10] uscita del programma.
    Tramite un ciclo if else viene fatta una richiesta http ad una tabella in file json, posizionata su Altervista. 
    Viene stratto il codice di risposta tramite il file curl-lib.php, si effettua la chiamata ad una funzione passando come argomenti la esecuzione della richiesta, la estrazione del codice della risposta (status) ed un impianto scelto eventualmente.
   Il file functions.php è incaricato di effettuare la stampa sul terminal dei dati estratti.
   
   Il file index.php interagisce con il bot "Gestione Calore" presente su telegram, ha bisogno del file curl-lib.php una libreria per la creazione delle richieste http incaricata di inviare le richieste provenienti da Telegram e gestite da Heroku verso Github e Altervista.
   Si legge il contenuto della richiesta, il bot invia il messaggio che viene decodificato e scompattato.
   Il messaggio e visualizzato ed approffitando del fatto che Telegram invia in ingresso del messaggio quello che è scritto dopo il simbolo backslash "/", stampo una opzione iniziale "/menu" e "/ora".
   con menu abbiamo:
/1   Visualizza il tipo di impianti e la denominazione.
/2   Visualizza i dettagli di un determinato impianto.
/3   Visualizza pronto intervento su un determinato impianto.
/4   Visualizza gli interventi effettuati negli impianti.
/5   Visualizza l'ultima lettura effettuata e la matricola del contatore gas.
/6   Visualizza i consumi di un determinato impianto.
/7   Visualizza le ore ordinarie di funzionamento.

Ognuna delle opzioni determina una stampa dei dati:

/1   Visualizza il tipo di impianti e la denominazione.:
GestioneCalore
Elenco e denominazione degli impianti in servizio attualmente:
1 -  K001  Palestra Carducci  2003/00101
2 -  K002  Circoscrizione  Via dei Lavoratori  2003/00101
3 -  K003  Scuola Materna Statale  Il Glicine Via Salandra  2003/00101
4 -  K004  Circoscrizione  Baia Flaminia  2003/00101
5 -  K005  Palestra Via Turati Olivieri  2003/00101
6 -  K006  Scuola Materna Gulliver  2003/00101

/2   Visualizza i dettagli di un determinato impianto.
Selezionare impianto da consultare le caldaie installate:
/2K001     /2K002     /2K003     /2K004     /2K005     /2K006     /2K007     /2K008     /2K009     /2K010     /2K011     /2K012     /2K014    /2K015     /2K016     /2K017     /2K018     /2K019     /2K020     /2K021     /2K022     /2K023     /2K024     /2K025     /2K026    /2K050     /2K051     /2K052     /2K053     /2K054     /2K055     /2K057 
Fino all'impianto /2K324 che corrisponde al 104esimo impianto.

viene selezionato l'impianto ed stampate le caratteristiche delle caldaie installate:

/2K058
GestioneCalore
K058
- -Codice Impianto: K058-Anno installazione: 2002 -Anno costruzione caldaia: 1998  -Marca Caldaia: Cald Sant'Andrea  -Matricola Bruciatore: Bruciat Sant'Andrea KB 40 G EH60057280  -Matricola Caldaia: 44555  -Modello Caldaia GN 120  -Potenza al Focolare: 155  -Potenza Utile: 140  -Caldaia numero: 1
Menu del servizio di messaggistica sulla Gestione Calore scelga una opzione:
/menu   /ora

Alla fine viene riproposta la scelta /menu  /ora

3 -  K003  Scuola Materna Statale  Il Glicine Via Salandra  2003/00101

/3
GestioneCalore
Selezionare impianto da consultare gli interventi in pronto intervento:
/3K001     /3K002     /3K003     /3K004     /3K005     /3K006     /3K007     /3K008     /3K009     /3K010     /3K011     /3K012     /3K014    /3K015     /3K016     /3K017     /3K018     /3K019     /3K020 
La risposta:
/3K010
GestioneCalore
K010
- K010  -Numero chiamata: 176  -Id della chiamata: 2012/00114/C -Data assegnazione: 2012-01-18  -Data intervento: 2012-01-18  -Descrizione chiamata: NON C'è L'ACQUA CALDA  -Tempo di risposta della chiamata: 00:50:00-Chiamante: - MELCHIORRI N

/4   Visualizza gli interventi effettuati negli impianti.
/4
GestioneCalore
Interventi effettuati negli impianti:
1 -   -Codice del Impianto: K105  -Data Intervento: 2003-10-01   -Descrizione: PULIZIA CALDAIE E BRUCIAT -Cognome: AVILA   -Nome:  RODOLFO
2 -   -Codice del Impianto: K055  -Data Intervento: 2003-10-07   -Descrizione: MANUTENZIONE ORDINARIA CA -Cognome: AVILA   -Nome:  RODOLFO
3 -   -Codice del Impianto: K010  -Data Intervento: 2003-10-20   -Descrizione: MANUTENZIONE CALDAIA   BO -Cognome: SANCHEZ   -Nome: MIGUEL
4 -   -Codice del Impianto: K061  -Data Intervento: 2003-10-23   -Descrizione: REGOLAZIONE RAMPA GAS E M -Cognome: GUTIERREZ   -Nome: FABRIZIO
5 -   -Codice del Impianto: K052  -Data Intervento: 2003-10-27   -Descrizione: PULIZIA CALDAIA BOLLA 115 -Cognome: LEHDER   -Nome: CARLITOS

/5   Visualizza l'ultima lettura effettuata e la matricola del contatore gas.
/5
GestioneCalore
Ultima lettura dei contatori gas degli impianti:
Selezionare impianto da consultare:
/5K001     /5K002     /5K003     /5K004     /5K005     /5K006     /5K007     /5K008     /5K009     /5K010     /5K011     /5K012     /5K014    /5K015     /5K016     /5K017     /5K018     /5K019     /5K020     /5K021     /5K022     /5K023     /5K024     /5K025     /5K026    /5K050 

/5K017
GestioneCalore
- K017 - Campo Scuola
-  - Codice di servizio: 122624642 - Lettura: 18345 - Matricola del contatore gas: 6905938
- Campo Scuola122624642 6905938
Menu del servizio di messaggistica sulla Gestione Calore scelga una opzione:
/menu   /ora

/6   Visualizza i consumi di un determinato impianto.
/6
GestioneCalore
Selezionare impianto da consultare il consumo:
/6K001     /6K002     /6K003     /6K004     /6K005     /6K006     /6K007     /6K008     /6K009     /6K010     /6K011     /6K012     /6K014    /6K015     /6K016     /6K017     /6K018     /6K019     /6K020

/6K008
GestioneCalore
Impianto: K008 - Palestra Via Rossetti
Codice di servizio: 122626258 -Matricola contatore: 2139368
- Data Lettura: 2002-11-26 - Lettura del consumo: 5231


/7   Visualizza le ore ordinarie di funzionamento.
/7
GestioneCalore
Selezionare impianto da consultare il numero di ore di funzionamento:
/7K001     /7K002     /7K003     /7K004     /7K005     /7K006     /7K007     /7K008     /7K009     /7K010     /7K011     /7K012     /7K014    /7K015     /7K016     /7K017     /7K018     /7K019     /7K020    

/7K001
GestioneCalore
K001 - Palestra Carducci
-Ore di funzionamento dell'impianto: 1057

  In qualunque momento si può abbandonare il coloquio con il bot così come si può riprendere.
