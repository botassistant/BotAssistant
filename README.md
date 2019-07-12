# BotAssistant
Il chatbot per la programmazione degli oggetti smart.

<h3>Intro</h3>

<p>Con BotAssistant puoi programmare il comportamento dei tuoi dispositivi smart attraverso chatbot (Maya) e quindi tramite linguaggio naturale, automatizzando la tua casa o dei tuoi amici con elevata facilità.</p>

<h3>Note sul progetto</h3>

<p>Il progetto è attualmente nelle prime versioni, pertanto ancora non sono state messe a disposizione tutte le funzionalità che la versione completa prevede. Il progetto nasce dalla necessità di rendere accessibile a utenti non esperti il mondo dell’Internet of things, consentendogli di automatizzare i luoghi in cui quotidianamente vivono e lavorano, secondo le proprie esigenze e conoscenze del dominio.

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
  <li><b>Trigger:</b>evento da rilevare, ad esempio meteo, data e ora ecc.</li><br>
  
  <li><b>Triggerchannel:</b>rappresenta la modalità con cui è possibile rilevare un evento, ad esempio se l’evento da rilevare è il meteo, allora possiamo rilevarlo in questo modo “se piove”, oppure “ogni giorno” ecc.</li><br>
  
  <li><b>Action:</b>è l’azione da eseguire dopo il rilevamento dell’evento, ossia il dispositivo smart da attivare o il servizio web da richiamare.</li><br>
  
  <li><b>Actionchannel:</b>come per i trigger anche per l’action vi sono vari modi per attivare un dispositivo intelligente, ad esempio se l’action è una lampada smart, allora possiamo eseguire  “l’accensione”, “lo spegnimento”, “l’accensione con intensità al 70%” ecc.</li><br>
  
  <li><b>Rules:</b>rappresentano l’automazione che i nostri dispositivi e servizi smart devono eseguire.</li><br></p>
  
 <h3>Node-Red</h3>
  
 <p>Per implementare il motore delle regole molto dipende dai dispositivi presenti, pertanto per facilitare la suddetta implementazione abbiamo individuato delle componenti comuni che consentono la realizzazione base del motore delle regole, come acquisire un trigger (evento), ad esempio rilevare “se oggi piove”, eseguire un action (azione), ossia “accendere la lampada del salotto”.</p>

<p>Il prototipo base da noi realizzato, riassume i principali flussi che gestiscono i nostri dispositivi o servizi smart secondo le regole composte tramite il chatbot, di seguito il link del <a href="https://github.com/botassistant/BotAssistant/blob/master/flows.json">JSON</a> da importare in Node-Red.</p>

<p>Dopo aver importato il JSON, bisogna completarlo con l’url del webhook e alcune semplici configurazioni dei dispositivi smart a disposizione.</p>

<p>Prima di procedere alle suddette configurazioni, andiamo a completare l’implementazione della piattaforma nelle parti descritte ad inizio paragrafo, ossia il webhook e il chatbot.</p>

<h3>Webhook</h3>

<p>Per installare il webhook, come già accennato, occorre un servizio di hosting PHP e importare la cartella BotAssistant, in cui è presente il codice per la gestione delle richieste HTTP del chatbot (<a href="https://github.com/botassistant/BotAssistant/blob/master/webhook.php">webhook.php</a>) e i codici sorgenti per la gestione del DB (<a href="https://github.com/botassistant/BotAssistant/blob/master/response_GET.php">response_GET.php</a>).</p>

<p>Per quanto riguarda il DB, è possibile usare lo schema <a href="https://github.com/botassistant/BotAssistant/blob/master/DB.sql">SQL</a> presente nei file, da noi messo a disposizione, quindi usare PhpMyAdmin, che generalmente viene messo a disposizione dal servizio di hosting, e  importare lo schema SQL</p>

<p>Definito il webhook inseriamo l’url nel motore delle regole, facendo doppio click su ogni nodo url + nameTriggerChannel + nameActionChannel , come in <a href="https://github.com/botassistant/BotAssistant/blob/master/fig2.PNG">fig. 2.</a><br></p>

<p>Per completare la piattaforma BotAssistant, rimane da implementare il chatbot.</p>

<h3>Chatbot</h3>
<p>La piattaforma utilizzata per la realizzazione del chatbot è <a href="https://dialogflow.com/">DialogFlow</a>, per realizzare il chatbot adatto ai nostri scopi, sono state utilizzate le linee guida messe a disposizione dalla stessa piattaforma DialoFlow, pertanto è stato realizzato:
  <li>Agent (linee guida <a href="https://dialogflow.com/docs/getting-started/first-agent">link</a>);</li>
  <li>Entities (linee guida <a href="https://dialogflow.com/docs/entities">link</a>);</li>
  <li>Intent (linee guida <a href="https://dialogflow.com/docs/intents">link</a>);</li>
  <li>Collegamento al webhook (linee guida <a href="https://dialogflow.com/docs/fulfillment/configure">link</a>);</li></p>

<p>Dopo aver eseguito l’importazione dell’Agent, l'implementazione del webhook con il DB e del motore delle regole (almeno nella nostra versione base), si procede con la fase di configurazione dei dispositivi smart o/e servizi web nella piattaforma BotAssistant. Per raggiungere questo obiettivo in modo semplice e veloce, abbiamo fatto uso della piattaforma di automazione <a href="https://ifttt.com/">IFTTT</a>. Node-Red mette a disposizione dei nodi per IFTTT (<a href="https://flows.nodered.org/node/node-red-contrib-ifttt">link</a>), pertanto installiamo questi nella nostra istanza di Node-Red.</p>

<p>Dopo l’installazione dei nodi IFTTT, procediamo come segue:
  <li>realizzare un trigger <i>every day at 15:00</i> in IFTTT con il componente webhook, mettendo come url http//www.miosito/everyDayAt1530, ossia il nodo in node-red che riceve la richiesta http dal trigger.</li>
  <br>
  <li>realizzare un action in IFTTT con il componente webhook.</li>
</p>

<p>Effettuando i precedenti passaggi dabbiamo implementato:

  <li><b>trigger:</b> Data e Ora</li>
  <li><b>triggerchannel:</b> ogni giorno alle 15:00</li>
  <li><b>action:</b> lampada del salotto</li>
  <li><b>actionchannel:</b> accensione lampada del salotto</li>
</p>

<p>per rendere più completo la nostra guida ripetiamo i precedenti passaggi per realizzare i nuovi trigger e action:
  <li><b>trigger:</b> meteo</li>
  <li><b>triggerchannel:</b> rileva se piove</li>
  <li><b>action:</b> Telegram</li>
  <li><b>actionchannel:</b> invio messaggio</li>
</p>

<h3>Composizione delle regole</h3>
<p>Completata l’implementazione del motore delle regole, del webhook e del chatbot, abbiamo la piattaforma BotAssistant completa, quindi possiamo iniziare a creare le nostre prime regole.</p>

<p>andando nella piattaforma DialogFlow, aprima la console del nostro Agent e dall’area web “Integrazione”, selezioniamo Web Demo (<a href="https://github.com/botassistant/BotAssistant/blob/master/fig_3.PNG">fig.3</a>) e Ottenendo il link (<a href="https://github.com/botassistant/BotAssistant/blob/master/fig_4.PNG">fig.4</a>) per aprire l’interfaccia del nostro chatbot (<a href="https://github.com/botassistant/BotAssistant/blob/master/fig__5.png">fig.5</a>) </p>




<h2>work in progress</h2>
