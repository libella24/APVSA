<?php
include "setup.php";
ist_eingeloggt();

use WIFI\apvsa\Jobify\Validieren;
use WIFI\apvsa\Jobify\Mysql;
use WIFI\apvsa\Jobify\Class\Jobs;
use WIFI\apvsa\Jobify\Class\Subclass\Job;
use WIFI\apvsa\Jobify\Class\Categories;

echo "<h1>Job löschen</h1>";

$fahrzeug = new Job($_GET["id"]);


if(!empty($_GET["doit"])) {
    //Bestätigungslink wurde geklickt -> wirklich in DB löschen
    $job->entfernen();
    echo "<p>Der Job wurde gelöscht.</br><a href='job_liste_firma.php'><h2>>> zur Jobverwaltung</h2></a>";

} else {

    echo "<p>Sind Sie sicher, dass Sie den Job entfernen möchten?</p>";
    echo "<strong>Titel:</strong> " . $job->titel . "<br>";

    echo "<p>" . "<a href='job-liste-firma.php'>Nein, abbrechen.</a>
    <a href='job_loeschen.php?id={$job->id}&amp;doit=1'>Ja</a>" . "</p>";
}


include "fuss.php";
?>