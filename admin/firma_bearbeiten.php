<?php
include "kopf.php";
include "setup.php";
ist_eingeloggt();

use WIFI\apvsa\Jobify\Validieren;
use WIFI\apvsa\Jobify\Class\Subclass\Firma;

$erfolg = false;

echo "<pre>"; print_r($_POST); echo "</pre>";

// die Errors werden in der Klasse "Validieren" gespeichert ($errors)

//Prüfen ob das Formular abgeschicht wurde
if ( !empty($_POST)) {
    $validieren = new Validieren();
    //  $wert wird auf Leerheit überprüft; $feldname = Variable, die Überprüft wird, wird in der Fehlermeldung verwendet; Errors-Array wird befüllt
    $validieren->ist_ausgefuellt($_POST["bezeichnung"], "Firmenname");
    $validieren->ist_ausgefuellt($_POST["strasse"], "Straße");
    $validieren->ist_ausgefuellt($_POST["plz"], "Postleitzahl");
    $validieren->ist_ausgefuellt($_POST["ort"], "Ort");
    $validieren->ist_ausgefuellt($_POST["email"], "E-Mail");
    $validieren->ist_ausgefuellt($_POST["benutzer"], "Benutzername");
    //$validieren->ist_ausgefuellt($_POST["passwort"], "Passwort");
    
    
    if(!$validieren->fehler_aufgetreten()){ //prüft, ob das Errors-Array leer ist
        $firma = new Firma(array(
            "id" => $_GET["id"] ?? null, // ??: wenn id vorhanden, dann verwenden, sonst den rechten Wert (null)
            "bezeichnung" => $_POST["bezeichnung"],
            "strasse" => $_POST["strasse"],
            "plz" => $_POST["plz"],
            "ort" => $_POST["ort"],
            "email" => $_POST["email"],
            "benutzer" => $_POST["benutzer"],
            //"passwort" => $_POST["passwort"]
        ));
        $firma->speichern();
        $erfolg = true;

    }
}

if($erfolg) 
{
    echo "<p><strong>Die Firma wurde gespeichert. Sie werden jetzt zur Jobverwaltung geleitet.</strong><br>
    <a href='job_vervaltung.php'>Zur Jobverwaltung</a></p>";
}

if(!empty($validieren))
{
    echo $validieren->fehler_html(); //gibt leeren String zurück, wenn kein Fehler aufgetreten ist
}

if(!empty($_GET["id"])) { //Bearbeiten-Modus - Fehrzeugdaten ermitteln zum Formular vorausfüllen
        $firma = new Firma($_GET["id"]);
}



?>
    <h1>Neue Firma anlegen</h1>
<?php 
    if(! empty($errors)) {
        // OFFEN: Fehlermeldung CSS; <div class="alert alert-info"><strong>Info!</strong> Indicates a neutral informative change or action.</div>
        echo "<ul>";
        foreach ($errors as $key => $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
    }

    //Erfolgsmeldung
    if ( $erfolg) {
        echo "<p>Die Firma wurde erfolgreich angelegt.<br>
        <a href='rezepte_liste.php'>Zurück zur Liste</a>
        </p>";
    }
    // Formular
    ?><form action="firma_bearbeiten.php" method="post">
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
            if (!empty($_POST["farbe"])) {
                echo htmlspecialchars($_POST["farbe"]);
            } else if (!empty($firma)) {
                echo htmlspecialchars($firma->farbe);
            }
        ?>">
        </div>
        <div>
            <!-- PLZ -->
            <label for="plz">PLZ:</label>
            <input type="number" name="plz" id="plz" min ="1000" max ="99999" value="<?php
            if (!empty($_POST["plz"])) {
                echo htmlspecialchars($_POST["plz"]);
            } else if (!empty($fahrzeug)) {
                echo htmlspecialchars($fahrzeug->plz);
            }
        ?>">
        </div>
        <div>
            <!-- Ort -->
            <label for="ort">Ort:</label>
            <input type="text" name="ort" id="ort"value="<?php
            if (!empty($_POST["ort"])) {
                echo htmlspecialchars($_POST["ort"]);
            } else if (!empty($fahrzeug)) {
                echo htmlspecialchars($fahrzeug->ort);
            }
        ?>">
        </div>
        <div>
            <!-- E-Mail -->
            <label for="email">E-Mail:</label>
            <input type="text" name="email" id="email"value="<?php
            if (!empty($_POST["email"])) {
                echo htmlspecialchars($_POST["email"]);
            } else if (!empty($fahrzeug)) {
                echo htmlspecialchars($fahrzeug->email);
            }
        ?>">
        </div>
        <div>
            <!-- Benutzer -->
            <label for="benutzer">Benutzer:</label>
            <input type="text" name="benutzer" id="benutzer"value="<?php
            if (!empty($_POST["benutzer"])) {
                echo htmlspecialchars($_POST["benutzer"]);
            } else if (!empty($fahrzeug)) {
                echo htmlspecialchars($fahrzeug->benutzer);
            }
        ?>">
        </div>
        <!-- Passwort<div>
             
            <label for="passwort">Passwort:</label>
            <input type="passwort" name = "passwort" id="passwort"value="<?php
            if (!empty($_POST["passwort"])) {
                echo htmlspecialchars($_POST["passwort"]);
            } else if (!empty($fahrzeug)) {
                echo htmlspecialchars($fahrzeug->passwort);
            }
        ?>">
        </div>-->
        <div class="submit-button">
            <button type="submit">Firma speichern</button>
        </div>
    </form>
<?php
include "fuss.php";