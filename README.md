"# mercatnoMeucci" 
# A.S. 2023/2024 5 CIA

## Progetto Mercatino del Meucci
### a cura di Asuncion Pier Noel, Faginali Matteo, Langone Vincenzo

---

### Modello ER e Modello Logico

Ci è stato spiegato che il progetto del mercatino dell'usato ha l'obiettivo di creare una piattaforma online, in questo caso sulla piattaforma Altervista, dove gli utenti potranno vendere e acquistare articoli usati.

Per gestire i dati del mercatino, abbiamo strutturato il database di AlterVista con le seguenti tabelle: **utente**, **proposte**, **annuncio** e **foto**. Queste tabelle sono state scelte per garantire tutte le esigenze fondamentali della piattaforma. Questo portale dovrà avere come funzionalità principali: registrazione e login, creazione e gestione degli annunci, proposte di prezzo e configurazione del profilo utente.

Attraverso Visual Studio Code, abbiamo utilizzato i seguenti linguaggi di programmazione: **HTML**, **CSS**, **PHP** e delle query **SQL**.

#### Tabella Utente
* **Utilità**: La tabella utente è fondamentale per gestire le informazioni di ogni persona registrata sulla piattaforma. Contiene i dati necessari per autenticare gli utenti durante il login, come email e password. Permette di conservare le informazioni personali degli utenti, necessarie per la gestione degli account.

#### Tabella Proposte
* **Utilità**: La tabella proposte consente ad un utente di creare un’offerta che si collegherà con la tabella annuncio.

#### Tabella Annuncio
* **Utilità**: La tabella annuncio è il fulcro della piattaforma, contenendo tutte le informazioni relative agli articoli messi in vendita con la descrizione e insieme alla Tabella Foto. Include titoli, descrizioni, categorie e date di pubblicazione, facilitando la ricerca e la visualizzazione degli articoli da parte degli utenti.

#### Tabella Foto
* **Utilità**: La tabella foto gestisce le immagini associate a ogni annuncio. Le immagini sono fondamentali per attirare l'interesse degli acquirenti, fornendo una rappresentazione visiva accurata degli articoli. Garantisce che ogni annuncio abbia le immagini appropriate, migliorando l'esperienza utente e aumentando le probabilità di vendita.

---

### Cosa bisogna fare

* Schema concettuale attraverso il modello ER
* Modello logico
* Implementazione della piattaforma e pubblicazione su Altervista di uno degli studenti del gruppo
* Una breve relazione (contenente modello ER e modello logico), accompagnata dalle scelte progettuali che sono ritenute importanti
* Effettuare delle ipotesi per gestire eventuali situazioni non specificate

### Funzionalità

* Registrazione e login
* Creazione degli annunci
* Effettuare proposte di prezzo
* Gestione degli annunci creati
* Profilo dell’utente

### NO framework front-end / back-end

* React, Angular, Laravel, Vue, SvelteKit, ecc.
* **OK** Bootstrap

---

### Ipotesi e modifiche future

* **Gestione Pagamenti**: Si potrebbe implementare l’API di Paypal che poi andrà a gestire in modo sicuro i pagamenti.
* **Sistema di Messaggistica**: Fare una tabella per i messaggi tra utenti risulterebbe molto complicata e impegnativa, soprattutto in tempo reale.
* **Storico delle Modifiche**: Implementare una tabella per tracciare le modifiche agli annunci, inclusi aggiornamenti a descrizioni e categorie, per mantenere un registro dettagliato delle attività.
* **Monitoraggio delle Attività Sospette**: Si potrebbe monitorare le attività di logout e gli accessi in modo da poter avvertire gli utenti in caso siano entrati persone non appartenenti ad un specifico account.
* **Backup e Ripristino dei Dati**: Si potrebbe gestire il backup e ripristino di un account in caso di perdita o cancellazione.
* **Supporto Clienti**: Un modo per aiutare gli utenti in caso di problemi riscontrati con altri utenti oppure anche nel sito per eventuali bug.
* **Gestione delle Promozioni e Offerte Speciali**: In caso un item non dovesse vendere dopo un tot di tempo si potrebbe fare in modo che possano essere scontati così da aumentare la possibilità di vendita dall’utente stesso.

---

### Bibliografia

* [Stack Overflow](https://stackoverflow.com/)
* [ChatGPT](https://chat.openai.com/)
* [Bootstrap](https://getbootstrap.com/)
* [W3Schools](https://www.w3schools.com/)
* [PHP Manual](https://www.php.net/manual/it/)
* [Subito](https://www.subito.it/)
* [eBay](https://www.ebay.it/)
* [Amazon](https://www.amazon.it/)

---

> **Note**: 
> 1. Asu hai scritto prezzi anziché proposte.
> 2. ?
