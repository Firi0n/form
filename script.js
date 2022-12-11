//Intercettazione del submit del form.
document.addEventListener('submit', function(e) {
    //Salvataggio dei valori dei campi del form.
    let nome = document.getElementById('nome').value;
    let cognome = document.getElementById('cognome').value;
    let dataNascita = document.getElementById('dataNascita').value;
    //Controllo che i campi non siano vuoti.
    if(nome == '' || cognome == '' || dataNascita == '') {
        //Se uno dei campi è vuoto, viene mostrato un alert e viene impedito il submit del form.
        alert('Compila tutti i campi');
        e.preventDefault();
    //Controllo che il nome e il cognome siano di almeno 4 caratteri.
    }else if(nome.length < 4 || cognome.length < 4) {
        //Se il nome o il cognome sono di meno di 4 caratteri, viene mostrato un alert e viene impedito il submit del form.
        alert('Il nome e il cognome devono essere di almeno 4 caratteri');
        e.preventDefault();
    //Conferma dei dati inseriti.
    }else if(!confirm('Confermi i dati inseriti?')) {
    //Se l'utente non conferma i dati, viene impedito il submit del form.
        e.preventDefault();
    }
});
