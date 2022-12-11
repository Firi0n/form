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
    <title>Iscrizione completata</title>
    <!-- Collegamento al foglio di stile -->
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
    <!-- Div utilizzati nel css per la formattazione della pagina -->
    <!-- Intestazione che cambia a seconda della fase -->
    <div>
        <h1>Iscrizione completata</h1>
    </div>
        <?php
        //Integrazione funzioni create.
        require('funzioni.php');
        ?>
    <form>
        <div>
            <!-- Visualizzazione dei dati -->
            <label>Nome: </label><input type="text" readonly name="nome" value="<?php echo  $_POST['nome']; ?>">

            <label>Cognome: </label><input type="text" readonly name="cognome" value="<?php echo $_POST['cognome']; ?>">

            <label>Data di nascita: : </label><input type="text" readonly name="dataNascita" value="<?php echo  $_POST['dataNascita']; ?>">
        </div>
        <div>
            <label>Città: </label><input type="text" readonly name="Citta" value="<?php echo getName($_POST['Citta']); ?>">

            <label>Provincia: </label><input type="text" readonly name="Provincia" value="<?php echo getName($_POST['Provincia']); ?>">

        </div>
        <div>
            <label>Regione: </label><input type="text" readonly name="Regione" value="<?php echo getName($_POST['Regione']); ?>">

            <label>Paese: </label><input type="text" readonly name="Paese" value="<?php echo getName($_POST['Paese']); ?>">
        </div>
        <div>
            <input id="reset" type="reset" onclick='window.location.replace("index.php");' value="Fine">
        </div>
    </form>
</body>

</html>
