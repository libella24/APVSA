<?php

include "setup.php";
ist_eingeloggt();

include "kopf.php";

use WIFI\apvsa\Jobify\Class\Jobs;
   
?>
<h1>Job Liste</h1>

<?php
echo "<p><a href='job_bearbeiten.php'>Job erfassen</a></p>";

// Liste - Kopfzeile

echo "<table border='1'>";
    echo "<thread>";
        echo "<tr>";
            echo "<th>Titel</th>";
            echo "<th>Beschreibung</th>";
            echo "<th>Profil</th>";
            echo "<th>Kategorie</th>";
            echo "<th>Dienstort</th>";
            echo "<th>Stundenausmaß</th>";
            echo "<th>Gehalt</th>";
            echo "<th>Sichtbar</th>";
        echo "</tr>";
    echo "</thread>";
echo "<tbody>";

// Die Klasse "Jobs" selektiert alle Stellen
// mit foreach werden sie in eine Liste geschrieben

$jobs = new Jobs();
$all_jobs = $jobs->all_jobs(); // liest alle Jobs aus der DB aus

echo "<pre>";print_r($all_jobs);echo "</pre>"; // in $all_jobs stehen alle drinnen :-)
//$all_jobs = array, das die Klasse Jobs ausgibt
foreach ($all_jobs as $row) { // alle Jobs werden in Rows gepackt und die jeweilige Spalte wird angezeigt
    echo "<tr>";
    echo "<td>". $row->titel . "</td>";
    echo "<td>". $row->beschreibung . "</td>";
    echo "<td>". $row->profil . "</td>";
    echo "<td>". $row->get_category()-> id . "</td>";
    echo "<td>". $row->dienstort . "</td>";
    echo "<td>". $row->stunden . "</td>";
    echo "<td>". $row->gehalt . "</td>";
     // darf der Job angezeigt werden?
     $visible = "";
     if ($row->sichtbar == "ja") {
         $visible = "<a href='job_sichtbarkeit.php?id={$row->id}&sichtbar={$row->visible}'>Ausblenden</a>";
     } else {
         $visible = "<a href='job_sichtbarkeit.php?id={$row->id}&sichtbar={$row->visible}'>Einblenden</a>";
     }
     // die URL der Position wird erzeugt

    echo "<td>" . $row->visible . "( " . $visible . " )</td>";
    echo "<td>". "<a href='job_bearbeiten.php?id={$row->id}'>Bearbeiten</a>". "</td>"; // URL zum Bearbeiten des Jobs
    echo "<td>". "<a href='job_loeschen.php?id={$row->id}'>Entfernen</a>". "</td>"; // URL zum Löschen des Jobs
    echo "</tr>";

}

echo "</tbody>";
echo "</table>";

include "fuss.php";

?>