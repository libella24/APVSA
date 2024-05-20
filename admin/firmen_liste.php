<?php
    include "setup.php"; // DB-Zugriff ermöglichen:
    ist_eingeloggt(); // Prüfung, ob der User eingeloggt ist, wenn nein, dann wird er zur Login-Seite weitergeleitet.
    include "kopf.php";

    use WIFI\apvsa\Jobify\Class\Firmen;
    use WIFI\apvsa\Jobify\Validieren;
    use WIFI\apvsa\Jobify\Mysql;
?>

<h1>Firmenliste</h1>

<?php

echo "<p><a href='firma_bearbeiten.php'>Firma erfassen</a></p>";
    echo "<table border='1'>";

    echo "<thread>";
    echo "<tr>";
        echo "<th>Bezeichnung</th>";
        echo "<th>Straße</th>";
        echo "<th>PLZ</th>";
        echo "<th>Ort</th>";
    echo "</tr>";
    echo "</thread>";
    echo "<tbody>";

    $firmen = new Firmen();
    $alle_firmen = $firmen->alle_firmen(); // gibt "Firmen" Objekte als Array zurück

    foreach ($alle_firmen as $firma) { //bei dieser foreach Schleife brauchen wir nicht den Key, deshalb kann man den auch weglassen
        echo "<tr>";
            echo "<td>" . $firma->bezeichnung . "</td>";
            echo "<td>" . $firma->strasse . "</td>";
            echo "<td>" . $firma->plz . "</td>";
            echo "<td>" . $firma->ort . "</td>";
            echo "<td>"."<a href='firma_bearbeiten.php?id={$firma->id}'>Bearbeiten</a>"."</td>";
            echo "<td>"."<a href='firma_entfernen.php?id={$firma->id}'>Entfernen</a>"."</td>";
        echo "</tr>";

    }
    echo "</tbody>";
    echo "</table>";

?>

<?php
include "fuss.php";


?>