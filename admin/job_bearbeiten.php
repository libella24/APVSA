<?php
include "setup.php";
ist_eingeloggt();

use WIFI\apvsa\Jobify\Validieren;
use WIFI\apvsa\Jobify\Mysql;
use WIFI\apvsa\Jobify\Class\Jobs;
use WIFI\apvsa\Jobify\Class\Subclass\Job;
use WIFI\apvsa\Jobify\Class\Categories;

$erfolg = false;
$validieren = new Validieren();

if (!empty($_POST)) {
    // Überprüfe die Pflichtfelder
    $validieren->ist_ausgefuellt($_POST["titel"], "Titel");
    $validieren->ist_ausgefuellt($_POST["beschreibung"], "Beschreibung");
    $validieren->ist_ausgefuellt($_POST["profil"], "Profil");
    $validieren->ist_ausgefuellt($_POST["category_id"], "Kategorie");
    $validieren->ist_ausgefuellt($_POST["dienstort"], "Dienstort");
    $validieren->ist_ausgefuellt($_POST["stunden"], "Stunden");
    $validieren->ist_ausgefuellt($_POST["gehalt"], "Gehalt");
    $validieren->ist_ausgefuellt($_POST["firmen_bez"], "firmen_bez");
    $validieren->ist_ausgefuellt($_POST["kontakt"], "Kontakt");

    if (!$validieren->fehler_aufgetreten()) {
        // Eintrag in die Tabelle "jobs"
        $job = new Job(array(
            "id" => $_GET["id"] ?? null,
            "titel" => $_POST["titel"],
            "beschreibung" => $_POST["beschreibung"],
            "profil" => $_POST["profil"],
            "category_id" => $_POST["category_id"],
            "dienstort" => $_POST["dienstort"],
            "stunden" => $_POST["stunden"],
            "gehalt" => $_POST["gehalt"],
            "firmen_id" => $_SESSION["firmen_id"],
            "firmen_bez" => $_POST["firmen_bez"],
            "kontakt" => $_POST["kontakt"],
            "update" => date('Y-m-d H:i:s'),
        ));
        echo "<pre>"; print_r($job); echo "</pre>";
        $job->speichern();
        $erfolg = true;
    }
}

include "kopf.php";

if ($erfolg) {
    echo "<p>Der Job wurde erfolgreich bearbeitet.<br>
    <a href='job_liste_firma.php'>Zurück zur Liste der Stellenanzeigen</a>
    </p>";
}

if (!empty($validieren)) {
    echo $validieren->fehler_html();
}

if (!empty($_GET["id"])) {
    // Ist die ID nicht leer -> Bearbeiten-Modus - Job ermitteln zum Formular vorausfüllen
    $job = new Job($_GET["id"]);
}
?>
<main>
    <div class="inner-wrapper">
        <h1>Job Details</h1>
        <div class="login-form inner-wrapper">
            <form action="job_bearbeiten.php" <?php if (!empty($job)) { echo "?id=" . $job->id; } ?> method="post">
                <div class="form-container">
                    <div>   
                        <!-- Titel -->
                        <label for="titel">Titel:</label>
                        <input type="text" name="titel" id="titel" value="<?php echo !empty($_POST["titel"]) ? htmlspecialchars($_POST["titel"]) : (!empty($job) ? htmlspecialchars($job->titel) : ''); ?>"/>
                    </div>
                    <div>
                        <!-- Beschreibung -->
                        <label for="beschreibung">Beschreibung:</label>
                        <input type="text" name="beschreibung" value="<?php echo !empty($_POST["beschreibung"]) ? htmlspecialchars($_POST["beschreibung"]) : (!empty($job) ? htmlspecialchars($job->beschreibung) : ''); ?>">
                    </div>
                    <div>
                        <!-- Profil (Anforderung) -->
                        <label for="profil">Profil:</label>
                        <input type="text" name="profil" id="profil" value="<?php echo !empty($_POST["profil"]) ? htmlspecialchars($_POST["profil"]) : (!empty($job) ? htmlspecialchars($job->profil) : ''); ?>">
                    </div>
                    <div class="category_list">
                        <div class="category_block">
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
                                        if (!empty($_POST["category_id"]) && ($_POST["category_id"] == $category->id)) {
                                            echo " selected";
                                        } else if (!empty($job) && $job->category_id == $category->id) {
                                            echo " selected";
                                        }
                                        echo ">{$category->name}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div>
                            <!-- Dienstort -->
                            <label for="dienstort">Dienstort:</label>
                            <input type="text" name="dienstort" id="dienstort" value="<?php echo !empty($_POST["dienstort"]) ? htmlspecialchars($_POST["dienstort"]) : (!empty($job) ? htmlspecialchars($job->dienstort) : ''); ?>">
                        </div>
                        <div>
                            <!-- Stunden -->
                            <label for="stunden">Stunden:</label>
                            <input type="text" name="stunden" id="stunden" value="<?php echo !empty($_POST["stunden"]) ? htmlspecialchars($_POST["stunden"]) : (!empty($job) ? htmlspecialchars($job->stunden) : ''); ?>">
                        </div>
                        <div>
                            <label for="gehalt">Gehalt:</label>
                            <input type="text" name="gehalt" id="gehalt" value="<?php echo !empty($_POST["gehalt"]) ? htmlspecialchars($_POST["gehalt"]) : (!empty($job) ? htmlspecialchars($job->gehalt) : ''); ?>">
                        </div>
                        <div>
                            <label for="firmen_bez">Firma:</label>
                            <input type="text" name="firmen_bez" placeholder="Bezeichnung der Firma/Abteilung" id="firmen_bez" value="<?php echo !empty($_POST["firmen_bez"]) ? htmlspecialchars($_POST["firmen_bez"]) : (!empty($job) ? htmlspecialchars($job->firmen_bez) : ''); ?>">
                        </div>
                        <div>
                            <label for="kontakt">Bewerbung an (E-Mail Adresse):</label>
                            <input type="text" name="kontakt" placeholder="Empfänger E-Mail-Adresse für Bewerbungen" id="kontakt" value="<?php echo !empty($_POST["kontakt"]) ? htmlspecialchars($_POST["kontakt"]) : (!empty($job) ? htmlspecialchars($job->kontakt) : ''); ?>">
                        </div>
                        <div class="submit-button">
                            <button type="submit">Speichern</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="inner-wrapper">
            <a href='job_liste_firma.php?id=<?php echo $_SESSION["firmen_id"]; ?>'><h2><< zur Jobliste</h2></a>
            <a href='job_bearbeiten.php'><h2>>> neuen Job erfassen </h2></a>
            <a href='firma_bearbeiten.php?id=<?php echo $_SESSION["firmen_id"]; ?>'><h2><< zu den Account Einstellungen</h2></a>
        </div>
    </div>
</main>

<?php
include "fuss.php";
?>
