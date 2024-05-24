<?php

// Konfiguration für das Projekt
const MYSQL_HOST = "localhost";
const MYSQL_USER = "root";
const MYSQL_PASSWORT = "";
const MYSQL_DATENBANK = "apvsa";

// Setup-Code: Nur verändern wenn du weißt, was du tust.

session_start();

function ist_eingeloggt() {
    if (empty($_SESSION["eingeloggt"])) {
        // Benutzer nicht eingeloggt -> Umleiten zum Login
        header("Location: login.php");
        exit;
    }
}

function ist_admin() {
    if ($_SESSION["admin"]) {
        // Ist der eingeloggte User admin=ja, dann passt (Admin/Admin)
        exit;
    }
}



spl_autoload_register(
    function (string $klasse) {
        // Projekt-spezifisches namespace prefix
        // Wir schreiben zwei Backslashes, damit der string nicht escaped wird.
        // Also steht für WIFI\Php3\
        $prefix = "WIFI\\apvsa\\";

        // Basisverzeichnis für das Projekt
        $basis = __DIR__ . "/";

        // Wenn die Klasse das Prefix nicht verwendet, wird abgebrochen
        // (Wir sind nicht für das Laden von Dateien anderer Projekte verantwortlich)
        $laenge = strlen($prefix);
        if (substr($klasse, 0, $laenge) !== $prefix) {
            return;
        }

        // Klasse ohne Prefix
        $klasse_ohne_prefix = substr($klasse, $laenge);

        // Dateipfad erstellen
        $datei = $basis . $klasse_ohne_prefix . ".php";
        $datei = str_replace("\\", "/", $datei);

        // Wenn die Datei existiert, einbinden
        if (file_exists($datei)) {
            include $datei;
        }
    }
);