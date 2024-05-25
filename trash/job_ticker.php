<?php
use WIFI\apvsa\Jobify\Validieren;
use WIFI\apvsa\Jobify\Class\Jobs;
use WIFI\apvsa\Jobify\Class\Subclass\Job;
use WIFI\apvsa\Jobify\Class\Categories;
use WIFI\apvsa\Jobify\Class\Subclass\Category;
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Ticker Subscription</title>

    <style>
        #ticker {
            border: 1px solid #ccc;
            padding: 10px;
            width: 100%;
            height: 50px;
            overflow: hidden;
            position: relative;
        }
    </style>
</head>
<body>
    <div id="ticker">
        <?php 
        echo date('H:i:s');
        ?>
    </div>

<?php
// Beispiel: Aktuelle Zeit als Ticker-Daten ausgeben
echo date('H:i:s') . " - Dies ist ein Beispiel-Tickertext.";
?>

    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="ticker.js"></script>

    
    <h1>Job Ticker Subscription</h1>
    <br><br>
    <p>Wähle Deine Suchkriterien und erfahre automatisch von den neuesten Jobs per E-Mail</p>
    <br><br>
    <?php
    // Wenn im $error Array ein Fehler registriert wurde - $error is not empty - , dann soll der Fehlertext ($error = "Blabla") oberhalb des Formulars angezeigt werden.
    if(!empty($error)){
        echo "<p>".$error."</p>";
    }
    ?>
    <form action="job_ticker.php" method="post">
        <div>
            <label for="firma">Nach welchem Job willst Du suchen?</label>
            <input type="text" name="firma" id= "firma">
        </div>
        <div>
            <label for="ort">Wo möchtest Du arbeiten?</label>
            <input type="text" name="ort" id= "ort">
        </div>
        <div>
                <label for="category_id">Kategorie:</label>
                <select name="category_id" id="category_id">
                <option>--Bitte wählen--</option>
                <!-- hier werden später alle Kategorien aufgerufen - siehe job_bearbeiten.php, Zeile 122-->
        </div>
        <div>
            <label for="benutzer">Meine E-Mail Adresse:</label>
            <input type="text" name="benutzer" id= "benutzer">
        </div>
        <div>
            <button type="submit">Jobs erhalten</button>
        </div>
    </form>
    
    
</body>
</html>