# BotAssistant
Chatbot per la programmazione degli oggetti smart.

<h3>Intro</h3>

<p>Con BotAssistant puoi programmare il comportamento dei tuoi dispositivi smart attraverso chatbot (Maya) e quindi tramite linguaggio naturale, automatizzando la tua casa o dei tuoi amici con elevata facilità.</p>

<h3>Node sul progetto</h3>

<p>Il progetto è nelle prime fasi di realizzazioni, pertanto ancora non sono state messe a disposizione tutte le funzionalità che la versione completa prevede. Il progetto nasce dalla necessità di rendere accessibile a utenti non esperti il mondo dell’Internet of things, consentendogli di automatizzare i luoghi in cui quotidianamente vivono e lavorano, secondo le proprie esigenze e conoscenze del dominio.

La nostra sfida è proporre una piattaforma open source che faciliti l’implementazione delle automazioni e soprattutto ridurre il gap tecnologico tra mondo IoT e utenti finali, augurandoci soprattutto che tale piattaforma possa facilitare la realizzazione delle automazioni a supporto di utenti diversamente abili.
</p>

<h3>Componenti software</h3>

<p>Per implementare BotAssistant le componenti richieste sono:
  <li><b>Node-Red:</b> è uno strumento basato su Node.js, per collegare dispositivi hardware, API e servizi online, rappresenta lo   strumento principale per realizzare il motore delle regole dell’automazione, per maggiori informazioni vedi <a href="https://nodered.org/">qui.</a></li><br>
  
  <li><b>DialogFlow:</b> piattaforma di Google che consente di realizzare il chatbot e di addestrarlo con molta facilità, me maggiori informazioni vedi il <a href="https://dialogflow.com/">link.</a></li><br>
  
  <li><b>Webhook:</b> qualsiasi host PHP per implementare il codice PHP necessario per la gestione del DB e le richieste HTTP del chatbot. Host da noi usato <a href="http://altervista.org/">altervista.org.</a></li><br></p>
  
 <h3>Iniziamo</h3>
 
 <p>Per capire come la piattaforma BotAssistant funziona, consideriamo il seguente schema (fig.1):

<img src="https://github.com/botassistant/BotAssistant/blob/master/fig1.PNG?raw=true" alt="fig.1">

Tramite il chatbot, l’utente finale, esprime in linguaggio naturale le regole che i propri dispositivi smart devono rispettare, per realizzare l’automazione voluta, ad esempio esprime la volontà che ogni giorno alle 15:00 si deve accendere la lampada del salotto:

<i>“se sono le 15:00 allora accendi la lampada del salotto”</i>

oppure:

<i>“ogni giorno alle 15:00 accendi la lampada del salotto”</i>

questa è una delle più semplici regole che si possono comporre con la piattaforma BotAssistant. Dopo l'inserimento della regola di automazione, tramite linguaggio naturale, il chatbot invia la regola al webhook PHP il quale provvede a convalidare la regola e memorizzarla nel DB.</p>

<p>Terminata la fase di composizione della regola di automazione, la piattaforma rileva in autonomia gli eventi (nell’esempio precedente l’orario) ed esegue l’azione della regola composta con il chatbot (nel nostro esempio l’accensione della lampada del salotto). Il rilevamento degli eventi e l’esecuzione delle azioni avviene grazie al motore delle regole, implementato tramite Node-Red.</p>

<p>Quindi per rendere funzionante BotAssistant occorre installare innanzitutto Node-Red (link per l’installazione) su un server web oppure su HUB (ad es. Raspberry PI 3), alternativamente è possibile utilizzare il servizio di hosting FRED che mette a disposizione un istanza on-line di Node-Red. Dopo l’installazione occorre implementare il nostro motore delle regole.</p>

<p>Per comprendere al meglio il nostro progetto, si riporta un dizionario dei termini utilizzati tra queste righe:
  <li><b>Trigger:</b><p>evento da rilevare, ad esempio meteo, data e ora ecc.</p></li>
  
  <li><b>Triggerchannel:</b><p>rappresenta la modalità con cui è possibile rilevare un evento, ad esempio se l’evento da rilevare è il meteo, allora possiamo rilevarlo in questo modo “se piove”, oppure “ogni giorno” ecc.</p></li>
  
  <li><b>Action:</b><p>è l’azione da eseguire dopo il rilevamento dell’evento, ossia il dispositivo smart da attivare o il servizio web da richiamare.</p></li>
  
  <li><b>Actionchannel:</b><pcome per i trigger anche per l’action vi sono vari modi per attivare un dispositivo intelligente, ad esempio se l’action è una lampada smart, allora possiamo eseguire  “l’accensione”, “lo spegnimento”, “l’accensione con intensità al 70%” ecc.</p></li>
  
  <li><b>rules:</b><p>rappresentano l’automazione che i nostri dispositivi e servizi smart devono eseguire.</p></li>


</p>

