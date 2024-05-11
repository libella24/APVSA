<?php

namespace WIFI\apvsa\Jobify\Class;

use WIFI\apvsa\Jobify\Mysql;
use WIFI\apvsa\Jobify\Class\Subclass\Firma;

// In dieser Klasse geht es um die Liste der Fahrzeuge
// ruft die Funktion "alle_fahrzeuge" auf
// selektiert alle Einträge der Tabelle "fahrzeuge" und packt sie in ein Array
// 
class Firmen {
    public function alle_firmen(): array {
        $alle_firmen = array();
        $db = Mysql::getInstanz();
        $ergebnis = $db->query("SELECT * FROM firmen ORDER BY id ASC");
        while ($row = $ergebnis->fetch_assoc()) {
            $alle_firmen[] = new Firma($row);
        }
        return $alle_firmen;
    }
}