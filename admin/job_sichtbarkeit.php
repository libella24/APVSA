<?php
include "setup.php";
ist_eingeloggt();
include "kopf.php";

use WIFI\apvsa\Jobify\Validieren;
use WIFI\apvsa\Jobify\Mysql;
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