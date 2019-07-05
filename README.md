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

</p>
