<?php

include "setup.php";
ist_eingeloggt();
include "kopf.php";

use WIFI\apvsa\Jobify\Validieren;
use WIFI\apvsa\Jobify\Mysql;



//Entfernt das Session-Cookie
//unset($_SESSION["eingeloggt"]);

?>
<h1>Administration Job-DB</h1>
<p>Willkommen im geheimen Admin-Bereich</p>
<?php
include "fuss.php";

?>
