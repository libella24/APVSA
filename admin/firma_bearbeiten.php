<?php

include "setup.php";
ist_eingeloggt();

include "kopf.php";

use WIFI\apvsa\Jobify\Validieren;
use WIFI\apvsa\Jobify\Class\Subclass\Firma;
use WIFI\apvsa\Jobify\Mysql;

$erfolg = false;

// die Errors werden in der Klasse "Validieren" gespeichert ($errors)

//Prüfen ob das Formular abgeschickt wurde
if ( !empty($_POST)) {
    $validieren = new Validieren();
    //  $wert wird auf Leerheit überprüft; $feldname = Variable, die Überprüft wird, wird in der Fehlermeldung verwendet; Errors-Array wird befüllt
    $validieren->ist_ausgefuellt($_POST["bezeichnung"], "Firmenname");
    $validieren->ist_ausgefuellt($_POST["strasse"], "Straße");
    $validieren->ist_ausgefuellt($_POST["plz"], "Postleitzahl");
    $validieren->ist_ausgefuellt($_POST["ort"], "Ort");
    $validieren->ist_ausgefuellt($_POST["email"], "E-Mail");
    $validieren->ist_ausgefuellt($_POST["benutzer"], "Benutzername");
    $validieren->ist_ausgefuellt($_POST["passwort"], "Passwort");
    
    $passwort = $_POST["passwort"];
    $pw_hash = password_hash($passwort, PASSWORD_DEFAULT);
    echo $pw_hash;
    
    if(!$validieren->fehler_aufgetreten()){ //prüft, ob das Errors-Array leer ist
        $firma = new Firma(array(
            "id" => $_GET["id"] ?? null, // ??: wenn id vorhanden, dann verwenden, sonst den rechten Wert (null)
            "bezeichnung" => $_POST["bezeichnung"],
            "strasse" => $_POST["strasse"],
            "plz" => $_POST["plz"],
            "ort" => $_POST["ort"],
            "email" => $_POST["email"],
            "benutzer" => $_POST["benutzer"],
            "passwort" => $pw_hash,
        ));
        $firma->speichern();
        $erfolg = true;

    }
}

if($erfolg) 
{
    echo "<p><strong>Die Firma wurde gespeichert. Sie werden jetzt zur Jobverwaltung geleitet.</strong><br>
    <a href='job_liste_firma.php'>Zur Jobverwaltung</a></p>";
}

if(!empty($validieren))
{
    echo $validieren->fehler_html(); //gibt leeren String zurück, wenn kein Fehler aufgetreten ist
}

if(!empty($_GET["id"])) { //Bearbeiten-Modus - Fehrzeugdaten ermitteln zum Formular vorausfüllen
        $firma = new Firma($_GET["id"]);
}
?>
<div class="inner-wrapper">
    <h1>Firmendaten</h1>
</div>

<?php 
    if(! empty($errors)) {
        echo "<ul>";
        foreach ($errors as $key => $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
    }

    //Erfolgsmeldung
    if ( $erfolg) {
        echo "<p>Du hast Deine Firma erfolgreich angelegt.
        </p>";
    }
    // Formular
    ?>
    <div class="login-form inner-wrapper">
    <form action="firma_bearbeiten.php" method="post">
        <div class="form-container">
        <div>
            <!-- Firmenbezeichnung -->
            <label for="bezeichnung">Firmenname:</label>
            <input type="text" name="bezeichnung" id="bezeichnung" placeholder="Firmenname" value="<?php
            if (!empty($_POST["bezeichnung"])) 
            {
                echo htmlspecialchars($_POST["bezeichnung"]);
            } else if (!empty($firma)) {
                echo htmlspecialchars($firma->bezeichnung);
            }
        ?>">
            
        </div>
        <div>
            <!-- Straße -->
            <label for="strasse">Straße:</label>
            <input type="text" name="strasse" id="strasse"value="<?php
            if (!empty($_POST["strasse"])) {
                echo htmlspecialchars($_POST["strasse"]);
            } else if (!empty($firma)) {
                echo htmlspecialchars($firma->strasse);
            }
        ?>">
        </div>
        <div>
            <!-- PLZ -->
            <label for="plz">PLZ:</label>
            <input type="number" name="plz" id="plz" min ="1000" max ="99999" value="<?php
            if (!empty($_POST["plz"])) {
                echo htmlspecialchars($_POST["plz"]);
            } else if (!empty($firma)) {
                echo htmlspecialchars($firma->plz);
            }
        ?>">
        </div>
        <div>
            <!-- Ort -->
            <label for="ort">Ort:</label>
            <input type="text" name="ort" id="ort"value="<?php
            if (!empty($_POST["ort"])) {
                echo htmlspecialchars($_POST["ort"]);
            } else if (!empty($firma)) {
                echo htmlspecialchars($firma->ort);
            }
        ?>">
        </div>
        <div>
            <!-- E-Mail -->
            <label for="email">E-Mail:</label>
            <input type="text" name="email" id="email"value="<?php
            if (!empty($_POST["email"])) {
                echo htmlspecialchars($_POST["email"]);
            } else if (!empty($firma)) {
                echo htmlspecialchars($firma->email);
            }
        ?>">
        </div>
        <div>
            <!-- Benutzer -->
            <label for="benutzer">Benutzer:</label>
            <input type="text" name="benutzer" id="benutzer"value="<?php
            if (!empty($_POST["benutzer"])) {
                echo htmlspecialchars($_POST["benutzer"]);
            } else if (!empty($firma)) {
                echo htmlspecialchars($firma->benutzer);
            }
        ?>">
        </div>
        <!-- Passwort -->
        <label for="passwort">Passwort:</label>
        <input type="password" name = "passwort" placeholder ="Passwort" id="passwort" value="<?php
            if (!empty($_POST["passwort"])) {
                echo htmlspecialchars($_POST["passwort"]);
            } else if (!empty($firma)) {
                echo htmlspecialchars($firma->passwort);
            }
        ?>">
        </div>
        <div class="submit-button">
            <button type="submit">Speichern</button>
    </form>
    </div>
</div>
<div class="inner-wrapper">
    
    <a href='job_liste_firma.php'><h2>>> zur Jobverwaltung</h2></a>
</div>
<footer>

<?php
include "fuss.php";