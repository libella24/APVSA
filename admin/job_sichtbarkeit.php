<?php
include "setup.php";
ist_eingeloggt();

use WIFI\Jobportal\Fdb\Model\Row\Job;

$job = new Job($_GET["id"]);

if($_GET["visible"] == "ja") {
    $job->sichtbarkeit_umstellen("ja");
} else {
    echo "Hello";
    $job->sichtbarkeit_umstellen("nein");
}
header("Location: jobs_liste.php");

?>