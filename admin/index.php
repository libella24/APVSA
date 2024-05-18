<?php

include "kopf.php";
//include "setup.php";
//ist_eingeloggt();

//Entfernt das Session-Cookie
//unset($_SESSION["eingeloggt"]);
?>
<style>
    .search {
    background-image: url(img/hero.jpg);
    background-size: cover;
    height: 500px;
    border-bottom: 6px solid var(--primary);

}
h1 {
    font-size: 25px;
    font-weight: 300;
    color: white;
    text-align: center;
    margin: 3rem 0 3rem;
}
</style>

<div class="search">
    <div class="search-container">
       <h1>Finde Deinen Traumjob</h1>
          <p class="subtitle">
           Bewirb Dich schon heute und starte eine bessere Zukunft
         </p>
        <button>Suche</button><!-- hier kommen mehrere Suchfelder -->         
        <div id="hero">
    </div>
</div>
<div class="row inner-wrapper">
    <img id="siegel" src="img/Jobify_Illustration.png" alt="Dame" />
</div>




<?php
include "fuss.php";
echo "Eingeloggt als: ". $_SESSION["benutzername"]; 
?>
