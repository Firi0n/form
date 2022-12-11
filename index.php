<!DOCTYPE html>
<!-- Lingua della pagina -->
<html lang="it">

<head>
    <!-- Meta dati per la corretta indicizzazione della pagina da parte del browser -->
    <meta charset="utf-8">
    <meta name="description" content="Form iscrizione">
    <meta name="keywords" content="iscrizione, form">
    <meta name="author" content="Pasquale Rossini">
    <!-- Corretta visualizzazione della pagina su ogni dispositivo -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titolo della pagina -->
    <title>Form iscrizione</title>
    <!-- Collegamento al foglio di stile -->
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
    <!-- Div utilizzati nel css per la formattazione della pagina -->
    <!-- Intestazione -->
    <div>
        <h1>Iscrizione</h1>
    </div>
    <!-- Cambio dell'azione a seconda della fase -->
    <form action="<?php echo !isset($_POST['Citta']) ? 'index.php' : 'paginaFinale.php' ?>" method="post">
        <div>
            <?php
            //Integrazione funzioni create.
            require('funzioni.php');
            //Creazione dell'array delle zone.
            $zone = array(
                //Creazione di un oggetto Zona per ogni zona.
                'Paese' => new Zona('http://api.geonames.org/countryInfoJSON?', value: 'countryName'),
                'Regione' => new Zona('http://api.geonames.org/childrenJSON?geonameId=' . (isset($_POST['Paese']) ? $_POST['Paese'] . "&" : ""), print: isset($_POST['Paese'])),
                'Provincia' => new Zona('http://api.geonames.org/childrenJSON?geonameId=' . (isset($_POST['Regione']) ? $_POST['Regione'] . "&" : ""), print: isset($_POST['Regione'])),
                'Citta' => new Zona('http://api.geonames.org/childrenJSON?geonameId=' . (isset($_POST['Provincia']) ? $_POST['Provincia'] . "&" : ""), print: isset($_POST['Provincia']))
            );
            //Ciclo per la stampa delle select di tutte le zone.
            foreach ($zone as $key => $value) {
                //Controllo se la zona deve essere stampata.
                if ($value->getPrint()) {
                    //Controllo se la zona è già stata compilata.
                    if (isset($_POST[$key])) {
                        //In caso affermativo, stampo la select con il valore già selezionato senza metterne altri.
                        $rispostaAPI = array($_POST[$key] => getName($_POST[$key]));
                    } else {
                        //In caso negativo, stampo la select con il valore di default con la possibilita di scegliere tra tutti quelli disponibili.
                        $rispostaAPI = $value->chiamataAPI();
                    }
                    //Stampa della select.
                    echo '<label>' . $key . ': </label> <select name="' . $key . '">';
                    //Ciclo per la stampa di tutte opzioni.
                    foreach ($rispostaAPI as $key => $value) {
                        echo '<option value="' . $key . '">' . $value . '</option>';
                    }
                    echo '</select>';
                }
            }
            ?>
        </div>
        <div>
            <?php
            //Controllo se la città è stata selezionata.
            if (isset($_POST['Citta'])) {
                //In caso affermativo, stampo i campi per il nome, cognome e data di nascita.
                echo 
                '<input type="text" id="nome" name="nome" placeholder="Nome" maxlength="10" onkeydown="return /[a-z]/i.test(event.key)">
                <input type="text" id="cognome" name="cognome" placeholder="Cognome" maxlength="10" onkeydown="return /[a-z]/i.test(event.key)">
                <input type="date" id="dataNascita" name="dataNascita" placeholder="Data di nascita">';
            }
            ?>
        </div>
        <!-- Submit, reset -->
        <div>
            <input id="submit" type="submit" value="Continua">
            <!-- In caso di reset, viene richiamata la pagina index.php poiche la pagina viene ricaricata più volte
                e quindi un normale reset non funziona-->
            <input id="reset" type="reset" onclick='window.location.replace("index.php");' value="Cancella">
        </div>
    </form>
    <?php
            //Controllo se la città è stata selezionata.
            if (isset($_POST['Citta'])) {
                //In caso affermativo, avvio lo script di controllo.
                echo '<script src="script.js"></script>';
            }
    ?>
</body>

</html>
