<?php
include "setup.php";
ist_eingeloggt();

use WIFI\apvsa\Jobify\Validieren;
use WIFI\apvsa\Jobify\Class\Jobs;
use WIFI\apvsa\Jobify\Class\Subclass\Job;
use WIFI\apvsa\Jobify\Class\Categories;

$erfolg = false;


if ( !empty($_POST)) {
    $validieren = new Validieren();
    //  $wert wird auf Leerheit überprüft; $feldname = Variable, die Überprüft wird, wird in der Fehlermeldung verwendet; Errors-Array wird befüllt
    $validieren->ist_ausgefuellt($_POST["titel"], "Titel");
    $validieren->ist_ausgefuellt($_POST["beschreibung"], "Beschreibung");
    $validieren->ist_ausgefuellt($_POST["profil"], "Profil");
    $validieren->ist_ausgefuellt($_POST["category_id"], "Kategorie");
    $validieren->ist_ausgefuellt($_POST["dienstort"], "Dienstort");
    $validieren->ist_ausgefuellt($_POST["stunden"], "Stunden");
    $validieren->ist_ausgefuellt($_POST["gehalt"], "Gehalt");
    //OFFEN: Die Firmen ID muss pro Job mitgespeichert werden
    //$validieren->ist_ausgefuellt($_POST["firmen_id"], "Firma");
    
    
    if(!$validieren->fehler_aufgetreten()){ //prüft, ob das Errors-Array leer ist
        $job = new Job(array(
            "id" => $_GET["id"] ?? null, // ??: wenn id vorhanden, dann verwenden, sonst den rechten Wert (null)
            "titel" => $_POST["titel"],
            "beschreibung" => $_POST["beschreibung"],
            "profil" => $_POST["profil"],
            "category_id" => $_POST["category_id"],
            "dienstort" => $_POST["dienstort"],
            "stunden" => $_POST["stunden"],
            "gehalt" => $_POST["gehalt"],
            "firmen_id" => $_SESSION["firmen_id"]
        ));
        $job->speichern();
        $erfolg = true;
    }
}
echo "<pre>";print_r($job);echo "</pre>";

include "kopf.php";

?>
    <h1>Job bearbeiten</h1>
<?php

if($erfolg){
    echo "<p>Der Job wurde erfolgreich bearbeitet.<br>
    <a href='job_liste.php'>Zurück zur Liste</a>
    </p>";
}

if(!empty($validieren)) {
    echo $validieren->fehler_html();
}

if (!empty($_GET["id"])) {
    //Ist die ID nicht leer -> Bearbeiten-Modus - Job ermitteln zum Formular vorausfüllen
    $job = new Job($_GET["id"]);
}
?>

<form action="job_bearbeiten.php
<?php if (!empty($jobs)) 
    {
     echo "?id=" . $jobs->id;   
    }
    ?>
    " method="post">
    <div>
        <!-- Titel -->
    <label for="titel">Titel:</label>
        <input type="text" name="titel" id="titel" value="
        <?php 
        if(!empty($_POST["titel"])){
            // Der Wert darf verändert werden, die ID bleibt die Gleich.
            echo htmlspecialchars ($_POST["titel"]);
        }else if (!empty($job)) {
            echo htmlspecialchars($job->titel);
        }
        ?>
        "/>
    </div>
    <div>
        <!-- Beschreibung -->
    <label for="beschreibung">Beschreibung:</label>
        <input type="text" name="beschreibung" value="
        <?php 
        if(!empty($_POST["beschreibung"])){
            echo htmlspecialchars ($_POST["beschreibung"]);
        }else if (!empty($job)) {
            echo htmlspecialchars($job->beschreibung);
        }
        ?>
        ">
    </div>
    <div>
        <!-- Profil (Anforderung) -->
        <label for="profil">Profil:</label>
        <input type="text" name="profil" id="profil" value="
        <?php 
        if(!empty($_POST["profil"])){
            echo htmlspecialchars ($_POST["profil"]);
        }else if (!empty($job)) {
            echo htmlspecialchars($job->profil);
        }
        ?>
        ">
    </div>
    <div>
        <label for="category_id">Kategorie</label>
        <select name="category_id" id="category_id">
            <option value="">--Bitte wählen--</option>
        </select>
    </div>
    <div>
        <!-- Dienstort -->
        <label for="dienstort">Dienstort:</label>
        <input type="text" name="dienstort" id="dienstort" value="
        <?php 
        if(!empty($_POST["dienstort"])){
            echo htmlspecialchars ($_POST["dienstort"]);
        }else if (!empty($job)) {
            echo htmlspecialchars($job->dienstort);
        }
        ?>
        ">
    </div>
    <div>
        <!-- Stunden -->
        <label for="stunden">Stunden:</label>
        <input type="text" name="stunden" id="stunden" value="
        <?php 
        if(!empty($_POST["stunden"])){
            echo htmlspecialchars ($_POST["stunden"]);
        }else if (!empty($job)){
            echo htmlspecialchars($job["stunden"]);
        }
        ?>
        ">
    </div>
    <div>
        <label for="gehalt">Gehalt:</label>
        <input type="text" name="gehalt" id="gehalt" value="
        <?php 
        if(!empty($_POST["gehalt"])){
            echo htmlspecialchars ($_POST["gehalt"]);
        }else if (!empty($job)){
            echo htmlspecialchars($job["gehalt"]);
        }
        ?>
        ">
    </div>
    <div>
        <button type="submit">Job speichern</button>
    </div>

</form>
<?php

echo "<pre>";print_r($job);echo "</pre>";
    include "fuss.php";
?>