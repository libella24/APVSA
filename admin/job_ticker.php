<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Ticker Subscription</title>
</head>
<body>
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
                <?php
                // ruft alle Einträge der Tabelle "kategorien" auf
                $categories = new Categories();
                $all_categories = $categories->all_categories();
                foreach ($all_categories as $category) {
                    echo "<option value='{$category->id}'";
                    if (!empty($_POST["category_id"]) && ($_POST["category_id"]) == $category->id) {
                        echo " selected";
                    } else if (!empty($job) && $job->category_id == $category->id) {
                        echo " selected";
                    }
                    echo ">{$category->name}</option>";
                };
        </div>
        <div>
            <label for="benutzer">Benutzername:</label>
            <input type="text" name="benutzer" id= "benutzer">
        </div>
        <div>
            <label for="passwort">Passwort:</label>
            <input type="password" name="passwort" id="passwort">
        </div>
        <div>
            <button type="submit">Einloggen</button>
        </div>
    </form>
    <br><br>
    <p><a href='firma_bearbeiten.php'>Registrieren</a></p>
    
    
</body>
</html>