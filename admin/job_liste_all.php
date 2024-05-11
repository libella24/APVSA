<?php

include "setup.php";
ist_eingeloggt();

use WIFI\apvsa\Jobify\Class\Jobs;
use WIFI\apvsa\Jobify\Mysql;
   
?>
<h1>Aktuelle Jobs</h1>


<?php

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
        echo "</tr>";
    echo "</thread>";
echo "<tbody>";

// Die Klasse "Jobs" selektiert alle Stellen
// mit foreach werden sie in eine Liste geschrieben

$jobs = new Jobs();
$current_jobs = $jobs->current_jobs(); // liest alle Jobs aus der DB aus

//echo "<pre>";print_r($current_jobs);echo "</pre>"; // in $all_jobs stehen alle drinnen :-)
//$all_jobs = array, das die Klasse Jobs ausgibt
foreach ($current_jobs as $row) { // alle Jobs werden in Rows gepackt und die jeweilige Spalte wird angezeigt
    echo "<tr>";
    echo "<td>". $row->titel . "</td>";
    echo "<td>". $row->beschreibung . "</td>";
    echo "<td>". $row->profil . "</td>";
    echo "<td>". $row->get_category()-> id . "</td>";
    echo "<td>". $row->dienstort . "</td>";
    echo "<td>". $row->stunden . "</td>";
    echo "<td>". $row->gehalt . "</td>";
}

echo "</tbody>";
echo "</table>";
      

include "fuss.php";

?>