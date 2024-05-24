<?php

include "setup.php";

use WIFI\apvsa\Jobify\Validieren;
use WIFI\apvsa\Jobify\Class\Subclass\Firma;
use WIFI\apvsa\Jobify\Mysql;

$erfolg = false;

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
        $firma->speichern(); // siehe RowAbstract
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

if(!empty($_GET["id"])) { //Bearbeiten-Modus - Wenn es schon eine Firma - mit ID gibt, dann startet der Bearbeiten-Modus (Formular wird vorausgefüllt).
        $firma = new Firma($_GET["id"]);
}



?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobify</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/APVSA/css/base.css">
</head>
<body>
    <header>
        <div class="wrapper">
            <header id="main-header">
                <div class="top-header h-spacing inner-wrapper">
                    <div id="logo">
                        <a href="/APVSA/index.html"
                            ><img src="img/logo.png" alt="Logo"
                        /></a>
                    </div>
                    <div class="burger">
                        <img src="img/burger.svg" alt="Burger Menu Icon" />
                    </div>
                    <nav id="main-nav">
                        
                        <div class="menu-items">
                            <ul>
                                <li><a href="/APVSA/job-liste.html">Jobs</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="slider">
                    <div class="search">
                            <h1>Login / Registrierung</h1>
                            <h3>Stellenanzeigen aufgeben<h3>                   
                        </div>

                </div>
<body>

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
        echo "<p>Du hast Deine Firma erfolgreich angelegt.<br>
        <a href='#'>Zurück zur Liste</a>
        </p>";
    }
    // Formular
    ?>
    <div class="login-form inner-wrapper">

    <form action="firma_neu.php" method="post">
        <div class="form-container">
            <div>
            <!-- Firmenbezeichnung -->
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
            <input type="text" name="strasse" placeholder = "Straße" id="strasse"value="<?php
            if (!empty($_POST["strasse"])) {
                echo htmlspecialchars($_POST["strasse"]);
            } else if (!empty($firma)) {
                echo htmlspecialchars($firma->strasse);
            }
        ?>">
        </div>
        <div>
            <!-- PLZ -->
            <input type="number" name="plz" placeholder = "PLZ" id="plz" min ="1000" max ="99999" value="<?php
            if (!empty($_POST["plz"])) {
                echo htmlspecialchars($_POST["plz"]);
            } else if (!empty($firma)) {
                echo htmlspecialchars($firma->plz);
            }
        ?>">
        </div>
        <div>
            <!-- Ort -->
            <input type="text" name="ort" placeholder = "Ort" id="ort"value="<?php
            if (!empty($_POST["ort"])) {
                echo htmlspecialchars($_POST["ort"]);
            } else if (!empty($firma)) {
                echo htmlspecialchars($firma->ort);
            }
        ?>">
        </div>
        <div>
            <!-- E-Mail -->
            <input type="text" name="email" placeholder = E-Mail Adresse id="email"value="<?php
            if (!empty($_POST["email"])) {
                echo htmlspecialchars($_POST["email"]);
            } else if (!empty($firma)) {
                echo htmlspecialchars($firma->email);
            }
        ?>">
        </div>
        <div>
            <!-- Benutzer -->
            <input type="text" name="benutzer" placeholder = "Benutzername" id="benutzer"value="<?php
            if (!empty($_POST["benutzer"])) {
                echo htmlspecialchars($_POST["benutzer"]);
            } else if (!empty($firma)) {
                echo htmlspecialchars($firma->benutzer);
            }
        ?>">
        </div>
        <div>
            <!-- Passwort -->
            <input type="passwort" name = "passwort" placeholder ="Passwort" id="passwort"value="<?php
            if (!empty($_POST["passwort"])) {
                echo htmlspecialchars($_POST["passwort"]);
            } else if (!empty($firma)) {
                echo htmlspecialchars($firma->passwort);
            }
        ?>">
        </div>
        <div class="submit-button">
            <button type="submit">Speichern</button>
        </div>
        </div>
    </form>
    </div>
<?php
include "fuss.php";