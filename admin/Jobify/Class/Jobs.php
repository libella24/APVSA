<?php

namespace WIFI\apvsa\Jobify\Class;

use WIFI\apvsa\Jobify\Mysql; 
use WIFI\apvsa\Jobify\Class\Subclass\Job; 


class Jobs {
    // Alle Jobs anzeigen (OFFEN: pro Firma)
    public function all_jobs(): array {
        $all_jobs = array();
        $db = Mysql::getInstanz();
        $ergebnis = $db->query("SELECT * FROM jobs ORDER BY id ASC");
        while($row = $ergebnis->fetch_assoc()) {
            $all_jobs[] = new Job($row);
        }
        return $all_jobs;
    }

    // OFFEN: Alle Jobs pro Firma anzeigen

    // Neue Jobs, erstellt in den letzten 7 Tagen anzeigen
    public function current_jobs():array{
        $current_jobs = array ();
        $db = Mysql::getInstanz();
        $result = $db->query("SELECT * FROM jobs WHERE created_at >= DATE_SUB(NOW(), INTERVAL 1 WEEK)");
        while($row = $result->fetch_assoc()) {
            $current_jobs[]= new Job($row);
        }
        return $current_jobs;

    }
}