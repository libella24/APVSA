<?php

// API Endpoint
// =============

use WIFI\apvsa\Jobify\Mysql;


//"required" - Es wird unbedingt benötigt
// "include" - nur wenn es gebraucht wird
include "setup.php";

// ALLGEMEINER TEIL
// -----------------
//Response wird als JSON ausgegeben
header("Content-Type: application/json");

// Fehlerhandling
function fehler($message) {
    header("HTTP/1.1 404 Not Found");
    echo json_encode(array(
        "status" => 0, //Status wird vergeben, zwecks Fehleranalyse 
        "error" => $message
    ));
    exit;
}

//echo "<pre>"; print_r($_SERVER); echo "</pre>";

//GET-Parameter werden aus request URI herausgefiltert
$request_uri_ohne_get = explode("?", $_SERVER["REQUEST_URI"])[0];

$teile = explode("/api/", $request_uri_ohne_get, 2);
if (count($teile) < 2) {
    fehler("Nach der Version wurde keine Methode übergeben. Prüfen Sie Ihren Aufruf!");
}
$parameter = explode("/", $teile[1]);

//Leere Einträge werden aus dem Parameter-Array entfernt
foreach ($parameter as $k => $v) {
    if (empty($v)) {
        unset($parameter[$k]);
    } else {
        //alle Parameter in Kleinbuchstaben umwandeln
        $parameter[$k] = mb_strtolower($v);
    }
}

//Indizies neu zuordnen, falls mit doppelten Schrägstrichen aufgerufen wird
$parameter = array_values($parameter);

if (empty($parameter)) {
    fehler("Nach der Version wurde keine Methode übergeben. Prüfen Sie Ihren Aufruf!");
}
// Zusätzliche Überprüfung, ob mindestens ein Parameter vorhanden ist
if (!isset($parameter[0])) {
    fehler("Kein gültiger API-Endpunkt angegeben.");
}

// SPEZIFIZIERTER TEIL - je nach Anwendungsbedarf
// -----------------------------------------------

$db = Mysql::getInstanz();

if ($parameter[0] == "jobs") {

    if (!empty($parameter[1]) && ($parameter[1] != "list")) {
        //ID wurde übergeben
        $ausgabe = array(
            "status" => 1,
            "result" => array()
        );

        //Jobdaten ermitteln
        $sql_jobs_id = $db->escape($parameter[1]);
        $result = $db->query("SELECT * FROM jobs WHERE id = '{$sql_jobs_id}'");

        // Das Resultat in Kategorie reinspeichern
        $job = mysqli_fetch_assoc($result);

        // Wenn es diese Kategorie nicht gibt dann Fehler ausgeben
        if (!$job) {
            fehler("Mit dieser ID '{$parameter[1]}' wurde keine Kategorie gefunden!");
        }

        // Wenn es die Kategorie gibt dann an der Ausgabe dranhängen
        $ausgabe["result"] = $job;



        //Benutzerdaten ermitteln und an die Ausgabe anhängen
        /*$result = $db->query("SELECT id, benutzername FROM benutzer WHERE id = '{$job["benutzer_id"]}'");
        
        $ausgabe["benutzer"] = mysqli_fetch_assoc($result);*/


        echo json_encode($ausgabe); //Umwandlung eines Arrays in JSON
        exit;

    } elseif ($parameter[1] == "list") {
        //Liste aller Jobs
        $ausgabe = array(
            "status" => 1,
            "result" => array()
        );

        $result = $db->query("SELECT * FROM `jobs`");
        while($row = mysqli_fetch_assoc($result)) {
            $ausgabe["result"][] = $row;
        }


        echo json_encode($ausgabe);// Umwandlung eines Arrays in JSON
        exit;
    }


} elseif ($parameter[0] == "categories") {


    if (!empty($parameter[1]) && empty($parameter[2]) && ($parameter[1] != "list")) {
        //ID wurde übergeben
        $ausgabe = array(
            "status" => 1,
            "result" => array()
        );



        //Rezeptedaten ermitteln
        /*$sql_rezepte_id = escape($parameter[1]);
        $result = query("SELECT * FROM rezepte WHERE id = '{$sql_rezepte_id}'");*/

        //Kategoriendaten ermitteln
        $sql_kategorien_id = $db->escape($parameter[1]);
        $result = $db->query("SELECT * FROM `kategorien` WHERE id = '{$sql_kategorien_id}'");



        // Das Resultat in Kategorie reinspeichern
        $kategorie = mysqli_fetch_assoc($result);

        // Wenn es diese Kategorie nicht gibt dann Fehler ausgeben
        if (!$kategorie) {
            fehler("Mit dieser ID '{$parameter[1]}' wurde keine Kategorie gefunden!");
        }

        // Wenn es die Kategorie gibt dann an der Ausgabe dranhängen
        $ausgabe["result"] = $kategorie;

        echo json_encode($ausgabe); //Umwandlung eines Arrays in JSON
        exit;
    }

    if (!empty($parameter[2])) {

        // Liste aller Jobs zu einer gewissen Kategorie

        $ausgabe = array(
            "status" => 1,
            "result" => array()
        );

        $sql_kategorie_id = $db->escape($parameter[1]);

        $result = $db->query("SELECT * FROM `jobs` WHERE kategorie_id = '{$sql_kategorie_id}'");

        while($row = mysqli_fetch_assoc($result)) {
            $ausgabe["result"][] = $row;
        }

        echo json_encode($ausgabe); //Umwandlung eines Arrays in JSON
        exit;

    }

     else if ($parameter[1] == "list") {
        //Liste aller Kategorien
        $ausgabe = array(
            "status" => 1,
            "result" => array()
        );

        $result = $db->query("SELECT * FROM kategorien ORDER BY id ASC");
        while($row = mysqli_fetch_assoc($result)) {
            $ausgabe["result"][] = $row;
        }

        echo json_encode($ausgabe);// Umwandlung eines Arrays in JSON
        exit;
    }
} else {
    fehler("Die Methode '{$parameter[0]}' exisitert nicht.");
}


echo "Das API funktioniert!";

// http://localhost/jwe23/_php2/api/jobs
?>