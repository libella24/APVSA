<?php

//Verbindung herstellen
$db_connection = mysqli_connect("localhost", "root", "", "apvsa");
mysqli_set_charset($db_connection, "utf8");

// Verbindung prüfen
// mysqli_connect_error – Gibt die Fehlerbeschreibung des letzten Verbindungsfehlers zurück, falls vorhanden.
// Die Funktion die() entspricht ​​der Funktion exit(). – ist neuer
if (!$db_connection) {
    die("Verbindung zur DB fehlgeschlagen: " . mysqli_connect_error());
} else {
    echo "Verbindung zur DB ist OK" . "<br>";
}

// Jobs, die zuletzt vor 3 M (90 Tage) oder länger bearbeitet wurden, werden gelöscht
$sql_befehl = "DELETE FROM jobs WHERE updated_at <= NOW() - INTERVAL 90 DAY AND visible = nein";

// DB Verbindung und Ausführung des SQL Befehls
if (mysqli_query($db_connection, $sql_befehl)) {
    echo "Ein Jahr alte Einträge wurden gelöscht.";
} else {
    echo "Fehler beim löschen: " . mysqli_error($db_connection);
}

// mysqli_close – schließt die vorher geöffnete Datenbankverbindung wieder
mysqli_close($db_connection);



